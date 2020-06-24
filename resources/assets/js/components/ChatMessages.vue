<template>
  <div class="row">
    <div class="col-md-8">
      <div class="card shadow-lg">
        <div class="text-center bg-secondary text-light py-3">
          <h4>
            Chat Messages
          </h4>
        </div>
        <div class="card-body">
          <div class="messages mb-2">
            <ul>
              <li v-for="message in messages">
                <p class="message-content">
                  <strong>{{ message.user_name }} : </strong>
                  {{ message.text }}
                  <span class="message-time">
                    {{ formattedCreatedAt(message) }}
                  </span>
                </p>
              </li>
            </ul>
          </div>
          <form @submit.prevent="sendMessage">
            <div class="form-group">
              <textarea class="form-control" v-model="newMessage" required></textarea>
            </div>
            <div class="form-group">
              <button class="btn btn-custom" type="submit">Send Message</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-lg">
        <div class="card-header text-center bg-secondary text-light">
          Online Users
        </div>
        <div class="card-body">
          <ul>
            <li v-for="user in onlineUsers">
              {{ user.name }}
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import parseISO from 'date-fns/parseISO';
import formatDistanceToNowStrict from 'date-fns/formatDistanceToNowStrict';

export default {
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

  mounted() {
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

  updated() {
    this.$el.querySelector('.messages').scrollTop =
    this.$el.querySelector('.messages').scrollHeight
  },

  methods: {
    sendMessage() {
      let message = this.newMessage;
      this.newMessage = '';

      axios.post('/chat-messages', {
        text: message,
      }).then(response => {
        let createdMessage = response.data.data;
        this.messages.push(createdMessage);
      }).catch(error => {
          flashMessage('Error sending message', 'danger');
      });
    },

    formattedCreatedAt(message) {
      let distanceToNow = formatDistanceToNowStrict(
        parseISO(message.created_at)
      );

      return `${distanceToNow} ago`;
    }
  }
}
</script>
<style scoped>
div.messages {
  height: 400px;
  overflow: scroll;
} 

div.messages ul {
  list-style-type: none;
}

span.message-time {
  float: right;
  color: #999;
}
</style>
