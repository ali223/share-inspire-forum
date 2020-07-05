<template>
  <div class="card shadow-lg">
    <div class="card-header text-center py-3">
      <h4>Chat Messages</h4>
    </div>
    <div class="card-body">
      <div class="messages" ref="messages">
        <ul>
          <li v-for="message in messages" :key="message.id">
            <div :class="[isMessageByCurrentUser(message) ? 'current-user-message-container' : 'other-user-message-container']">
              <p class="message-content">
                {{ message.text }}
              </p>
              <div class="message-sender">
                <strong>{{ getUserName(message) }}</strong>
                {{ formattedCreatedAt(message) }}
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>  
</template>

<script>
import parseISO from 'date-fns/parseISO';
import formatDistanceToNowStrict from 'date-fns/formatDistanceToNowStrict';

export default {
  props: {
    messages: {
      type: Array,
      required: true
    }
  },

  mounted() {
    this.scrollMessagesDivToBottom();
  },

  updated() {
    this.scrollMessagesDivToBottom();
  },

  methods: {
    formattedCreatedAt(message) {
      let distanceToNow = formatDistanceToNowStrict(
        parseISO(message.created_at)
      );

      return `${distanceToNow} ago`;
    },

    scrollMessagesDivToBottom() {
      this.$refs.messages.scrollTop = this.$refs.messages.scrollHeight;
    },

    isMessageByCurrentUser(message) {
      return message.user.id === window.App.user.id;
    },

    getUserName(message) {
      return this.isMessageByCurrentUser(message) ? 'You' : message.user.name;
    }
  }
}
</script>

<style scoped>
div.messages {
  height: 400px;
  overflow-y: scroll;
  padding-right: 5px;
} 

div.messages ul {
  list-style-type: none;
}

div.other-user-message-container {
  max-width: 50%;
  margin-top: 20px;
}

p.message-content {
  background: #eee;
  padding: 15px 10px;
  border-radius: 10px;
  margin-bottom: 0px;
}

div.message-sender {
  color: #999;
  margin-top: 0px;
  font-size: 0.85em;
}

div.current-user-message-container {
  max-width: 50%;
  margin-top: 20px;
  margin-left: auto;
}

div.current-user-message-container > p.message-content {
  background: #ccccff;
}

div.current-user-message-container > div.message-sender {
  text-align: right;
}
</style>
