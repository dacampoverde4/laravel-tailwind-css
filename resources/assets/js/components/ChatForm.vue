<template>
    <div class="fullwidth vertical_align mtop70">
    	<div class="type_message vertical_align">
    		<div class="col-md-10">
    		    <textarea @keyup.enter="sendMessage" v-model="newMessage" name="message" placeholder="Type your message.."></textarea>
    		</div>
    		<div class="col-md-2"  id="btn-chat" @click="sendMessage">
    			<img src="backend/images/attachment.png" alt="">
    			<button class="send"><img src="backend/images/paper_palne.png"  alt=""></button>
    		</div>
    	</div>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
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
            }
        }    
    }
</script>