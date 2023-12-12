<template>
	<div class="view_chat">
        <div class="chat" v-if="messages.recieverInfo">
            <div v-if="this.delmsg">
                <div class="alert alert-success alert-dismissible" style="text-align: center">
                        <a href="javascript:void(0)" class="close announcementmessages" data-dismiss="alert"
                            aria-label="close">&times;</a>
                    <strong >{{ delmsg }}</strong>
                </div>
            </div>
            <div class="chat-header">
                <div class="chat-header-user">
                    <figure class="avatar avatar-lg">
                        <img :style="{ 'background': 'url(uploads/' + messages.recieverInfo.profile_pic + ')'  }"  class="rounded-circle">
                    </figure>
                    <div>
                        <h5>{{ ( messages.recieverInfo )? messages.recieverInfo.name : 'No chat selected' }}</h5>
                        <small class="text-muted" :class="{'isOfline': (messages.recieverInfo.is_online == 0),
                    'isOnline': (messages.recieverInfo.is_online == 1) }">
                            <i v-if="messages.recieverInfo.is_online == 1">Online</i>
                            <i v-if="messages.recieverInfo.is_online == 0">Offline</i>
                        </small>
                    </div>
                </div>

                <div class="chat-header-action">
										<div class="request-btn" v-html="messages.adoptionInfo">{{ messages.adoptionInfo }}</div>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a href="#" class="btn btn-secondary" data-toggle="dropdown">
                                <i class="ti-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a :href="'userprofile/' + messages.recieverbid" data-navigation-target="contact-information" class="dropdown-item">Profile</a>
                                <a @click="deletechat(messages.recieverInfo.id)" class="dropdown-item">Delete</a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#myModal">Block</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="chat-body" :class="{ 'addedScrollY' : messages.messages.length >= 5}"> <!-- .no-message -->
                <!--
                <div class="no-message-container">
                    <i class="fa fa-comments-o"></i>
                    <p>Select a chat to read messages</p>
                </div>
                -->
                <div class="messages message-container">
                  <div class="fullwidth row vertical_align mb" :class="{'right_chat': (user.id == message.user.id),
					'left_chat': (user.id != message.user.id) }"   v-for="message in messages.messages">
					<div class="pro_img col-md-1">
						<div class="img_container" :style="{ 'background': ( user.id == message.user.id )? 'url(uploads/' + user.profile_pic + ')' : 'url(uploads/' + message.user.profile_pic + ')'  }" ></div>
					</div>
					<div class="chat_msg col-md-8 chat_message vertical_align">
						<p v-if="message.is_attachment == 1"><a :href="message.fileurl" _blank download>{{ message.message }} <i class="fa fa-file" style="font-size: 30px;margin-left: 10px"></i></a></p>
						<p v-else>{{ message.message }}</p>
					</div>
					<div class="chat_timing col-md-3">
						<span>{{ message.newdate}}</span>
					</div>
				</div>
                </div>
            </div>
            <div class="chat-footer sendmsgcontainer">
            	<div class="footer-msg">
                    <input type="text" @keyup.enter="sendMessage" v-model="newMessage" name="message" class="form-control" placeholder="Type your message..">

                    <div class="form-buttons">
                        <button :disabled="newMessage.length < 1" class="btn btn-primary btn-floating"><img src="backend/images/paper_palne.png" id="btn-chat" v-on:click="sendMessage" alt=""></button>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-zoom" role="document">
                    <div class="modal-content">
                    <form @submit="formSubmit" id="reasonForm">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="fa fa-users"></i>Block User {{ ( messages.recieverInfo )? messages.recieverInfo.name : 'No User is selected' }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="ti-close"></i>
                            </button>
                        </div>
                        <input type="hidden" name="block_id" id="block_id" class="form-control" :value="messages.recieverInfo.id" >
                        <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="form-group">
                                        <label class="col-form-label">Reason</label>
                                        <select name="reason" class="form-control" v-model="reason">
                                        <option value="">Select</option>
                                        <option value="6">don't know</option>
                                        <option value="7">hassle</option>
                                        <option value="8">annoy</option>
                                        <option value="9">other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Reason Description</label>
                                        <textarea type="text" class="form-control" name="description" v-model="description"></textarea>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>


						 <div class="modal fade" :id="'sendRequestBtn'+messages.trialInfo" role="dialog">
									 <div class="modal-dialog modal-dialog-centered modal-dialog-zoom adptreq" role="document">
											 <div class="modal-content">

													 <div class="modal-header align-items-center">
															 <h4 class="modal-title" id="myModalLabel">Adopt Request</h4>
															 <button type="button" class="close" data-dismiss="modal">
																	 <span aria-hidden="true">&times;</span>
																	 <span class="sr-only">Close</span>
															 </button>
													 </div>
													 <div class="modal-body">
															 <p class="statusMsg"></p>
															 <form class="form-horizontal form_common submitAdoptForm" id="submitAdoptForm" role="form" name="submitAdoptForm" method="POST">
																<input type="hidden"  name="trial" :value="messages.trialInfo" id="trial"/>
																 <div class="row">
																	 <div class="form-group d-flex">
																			<div class="col-md-1">
																					<input type="checkbox" class="form-control checkbox" id="agree" name="agree">
																			</div>
																			<div class="col-md-11 terms">
																						 <p v-html="messages.adopt_message">{{messages.adopt_message}}</p>
																				</div>
																			 </div>
																	 </div>
																		<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
																	 <button type="button"  @click="submitAdopt" class="btn btn-primary submitBtn" id="submit">Yes, Please</button>
															 </form>
													 </div>
													 </div>
									 </div>
							 </div>
        </div>
	</div>




</template>

<script>
 import axios from 'axios';
  export default {
        props: ['messages', 'user', 'filepath','getreasons','loading'],

        data() {
            return {
                newMessage: '',
                reason: '',
                description: '',
                //block_id:'',
                formContents: '',
                delmsg: '',
                recieverInfo: {
                	name: '',
                	id: 0,
                },
                reciever:'',
                url: window.Laravel.url + '/chat/attachments',
                accept: '.png,.jpg,.docx,.pdf,.doc,.txt',
    			headers: { 'access-token': window.Laravel.csrfToken },
    			additionalData: {
    				'_token': window.Laravel.csrfToken,
    				reciever: 0
    			},

            }
        },
        updated(){
            this.additionalData.reciever = this.messages.recieverInfo.id;
            this.$root.scrollToEnd();
        },
        methods: {
            sendMessage() {
                if( this.newMessage.trim() ){
                    this.$emit('messagesent', {
                        user: this.user,
                        message: this.newMessage
                    });
                    this.newMessage = '';
                }
            },

						submitAdopt(){

								var agree = 0;
								if ($('#agree').is(":checked")){
									agree = 1; }
								var id =$("#trial").val();
								$.ajax({
				            method: "POST",
				            url: window.Laravel.url + '/ajaxrequest/adopt-request',
				            data: {
				                // adoptee_family_role: $("#adoptee_family_role").val(),
				                agree: agree,
				                trial: $("#trial").val(),
				                _token: window.Laravel.csrfToken
				            },
				        })
				        .done(function( data ) {
							        if(data.status == 200){
							            $("#btnModal"+id).remove();
							            $(".sucessmessage").empty();
							            $(".sucessmessage").html("<h5 class='success'><i class='fa fa-check'> </i> "+data.message+"</h5>");
							            // $("#sendRequestBtn .modal-footer").empty();
							              $('#sendRequestBtn'+id).modal('toggle');
							            setInterval(function(){  $("#sendRequestBtn"+id).remove(); }, 1000);
							            //
							        }else if(data.status == 400){
							            $("#sendRequestBtn"+id+" .modal-body .terms .failure").remove();
							            $("#sendRequestBtn"+id+" .modal-body .terms").append("<p class='failure'> "+data.message+"</p>");
							            $("#sendRequestBtn"+id+" .modal-footer").empty();
							        }else{
							            $("#sendRequestBtn"+id+" .modal-body").html("<h5 class='failure'><i class='fa fa-check'> </i> "+data.message+"</h5>");
							            $("#sendRequestBtn"+id+" .modal-footer").empty();
							        }
				    });
						},
            thumbUrl (file) {
		      return file.myThumbUrlProperty
		    },
            mySaveMethod(reponse) {
		      this.$emit('fetchusers', this.additionalData.reciever);
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
            formSubmit(e) {
                e.preventDefault();
                let currentObj = this;
                let blockid = this.messages.recieverInfo.id;
                axios.post('/chat/blockreport',{
                blockid: blockid,
                reason: this.reason,
                description: this.description,
                })
                .then(function (response) {
                    $('#myModal').modal('hide');
                    this.delmsg = response.data.deletemsg

                })
                .catch(function (error) {
                    currentObj.output = error;
                });
            }
        }
    }



</script>
