<template>
        <div class="chat_list">
            <!-- Chats sidebar -->
            <div id="chats" class="sidebar active">
                <header>
                    <span>Chats</span>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="btn btn-light" href="#" title="Users List" data-toggle="modal" data-target="#newGroup">
                            <i class="fa fa-users"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-light" data-toggle="modal" title="New Chat" href="#" data-target="#staffadmin">
                            <i class="ti-comment-alt"></i>
                            </a>
                        </li>
                        <li class="list-inline-item d-lg-none d-sm-block">
                            <a href="#" class="btn btn-light sidebar-close">
                            <i class="ti-close"></i>
                            </a>
                        </li>
                    </ul>
                </header>
                <form action="">
                    <input type="text" class="form-control" placeholder="Search chat" v-model="searchQuery">
                </form>

                <div class="sidebar-body" :class="{ 'addedScrollY' : filteredResources.length >= 5}">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item open-chat" @click="getMessages(chatuser.user.id)" v-for="chatuser in filteredResources">
                            <div>
                                <figure class="avatar">
                                    <img :style="{ 'background': 'url(uploads/' + chatuser.user.profile_pic + ')'  }" class="rounded-circle">
                                </figure>
                            </div>
                            <div class="users-list-body">
                            <h5  v-html="$options.filters.highlight(chatuser.user.name , searchQuery)">{{ chatuser.user.name }} </h5>
                             <span class="snglchatcnt" v-if="chatuser.seen > 0">{{ chatuser.seen }}</span>
                               <p v-html="$options.filters.highlight(chatuser.message.message , searchQuery)"> {{ chatuser.message.message}}</p>
                                 <!--<h5>{{ chatuser.user.name }}</h5>-->
                                 <!--<p>{{ chatuser.message.message }}</p>-->
                                <div class="users-list-action action-toggle">
                                    <div class="dropdown">
                                        <a data-toggle="dropdown" href="#">
                                        <i class="ti-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a @click="getMessages(chatuser.user.id)" class="dropdown-item">Open</a>
                                            <a :href="'userprofile/'  + chatuser.recieverbid"
                                            data-navigation-target="contact-information" class="dropdown-item">Profile</a>
                                            <a @click="deletechat(chatuser.user.id)" class="dropdown-item">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal fade" id="newGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fa fa-users"></i> Users List
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="ti-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="matchtabs newchatuserslist pt30" :class="{ 'addedScrollY' : chatnewusers.length >= 7}">
                                <div class="container-fluid">
                                    <div class="row mtopbottom20">
                                        <div class="col-md-12 mb newuserlist" data-dismiss="modal" @click="getMessages(newuser.id)" v-for="newuser in chatnewusers">
                                            <a href="#"><div class="img_container" :style="{ 'background': 'url(uploads/' + newuser.profile_pic + ')'  }" ></div></a>
                                            <div v-if="newuser.is_online" class="online_status"></div>
                                            <div class="mtopbottom10">
                                                <h5>{{ newuser.name }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Browse Staff</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="staffadmin" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fa fa-users"></i> Staff Members
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="ti-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="stafftabs newchatuserslist pt30">
                                <div class="container-fluid">
                                    <div class="row mtopbottom20">
                                        <div class="col-md-12 mb newuserlist" data-dismiss="modal" @click="getMessages(newuser.id)" v-for="newuser in chatstaffadmins">
                                            <a href="#"><div class="img_container" :style="{ 'background': 'url(uploads/' + newuser.profile_pic + ')'  }" ></div></a>
                                            <div v-if="newuser.is_online" class="online_status"></div>
                                            <div class="mtopbottom10">
                                                <h5>{{ newuser.name }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary">Browse Staff</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>
<script>


export default {
    props: ['chatusers', 'chatnewusers','chatstaffadmins'],


    data() {
        return{
            searchQuery : '',
        }
        let urlParams = new URLSearchParams(window.location.search);
        let myParam = urlParams.get('id');
        this.searchQuery = this.searchQuery;
        if(myParam != null)
        {
            let reciever_id =  Number(myParam) //1234
            this.getMessages(reciever_id);
        }
        else{
            return {
            reciever_id: 0,
        }
        }
    },
    computed: {
    filteredResources (){
      if(this.searchQuery){
      return this.chatusers.filter((item)=>{
        return item.user.name.toLowerCase().trim().startsWith(this.searchQuery.toLowerCase().trim()) ||
        item.message.message.toLowerCase().trim().startsWith(this.searchQuery.toLowerCase().trim());
      })
      }else{
        return this.chatusers;
      }
    }
  },
    filters: {
               highlight: function(words, query){
                    var iQuery = new RegExp(query, "ig");
                    return words.toString().replace(iQuery, function(matchedTxt,a,b){
                            return ('<span style="background-color: yellow;">' + matchedTxt + '</span>');
                    });
            }
        },
    methods: {
        getMessages(reciever_id) {
            this.$emit('fetchusers', reciever_id);
        },
        deletechat(id)
            {
                axios.post('/chat/delete',{id}).then(response => {
                    this.delmsg = response.data.deletemsg
                    setTimeout(() => this.delmsg = '', 2000)
                    this.$root.fetchUsers();
                    this.$root.fetchcurrentuserId();
                });
            },
    }

  };
</script>
