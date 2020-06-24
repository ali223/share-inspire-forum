<template>
  <div class="row">
    <div class="col-md-8">
      <chat-messages-list :messages="messages">
      </chat-messages-list>

      <chat-message-editor @send="sendMessage">
      </chat-message-editor>
    </div>
    <div class="col-md-4">
      <chat-online-users-list :users="onlineUsers">
      </chat-online-users-list>
    </div>
  </div>
</template>

<script>
import ChatMessagesList from './ChatMessagesList';
import ChatOnlineUsersList from './ChatOnlineUsersList';
import ChatMessageEditor from './ChatMessageEditor';

export default {
  components: {
    ChatMessagesList,
    ChatOnlineUsersList,
    ChatMessageEditor
  },

  props: {
    initialMessages: {
      type: Array,
      required: true
    }
  },

  data() {
    return {
      messages: _.cloneDeep(this.initialMessages),
      newMessage: '',
      onlineUsers: []
    }
  },

  created() {
    this.registerEventListenersForLaravelEcho();
  },

  methods: {
    registerEventListenersForLaravelEcho() {
      Echo.join('Chat.Room')
        .here(users => {
          this.onlineUsers = users;
        })
        .listen('NewChatMessage', message => {
          this.messages.push(message);
        })
        .joining(user => {
          this.onlineUsers.push(user);
        })
        .leaving(user => {
          let index = this.onlineUsers.findIndex( (onlineUser) => {
            return onlineUser.id == user.id;
          });

          this.onlineUsers.splice(index, 1);
        });
    },

    sendMessage({message}) {
      axios.post('/chat-messages', { 
        text: message
      }).then(response => {
        let createdMessage = response.data.data;
        this.messages.push(createdMessage);
      }).catch(error => {
        flashMessage('Error sending message', 'danger');
      });
    }
  }
}
</script>
