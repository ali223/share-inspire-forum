<template>
  <div :class="messageContainerClass">
    <p class="message-content">
      {{ message.text }}
    </p>
    <div class="message-sender">
      <strong>{{ userName }}</strong>
      {{ formattedCreatedAt }}
    </div>
  </div>
</template>

<script>
import parseISO from 'date-fns/parseISO';
import formatDistanceToNowStrict from 'date-fns/formatDistanceToNowStrict';

export default {
  props: {
    message: {
      type: Object,
      required: true
    }
  },

  computed: {
    messageContainerClass() {
      return [
        this.isMessageByCurrentUser
          ? 'current-user-message-container'
          : 'other-user-message-container'
      ];
    },

    isMessageByCurrentUser() {
      return this.message.user.id === window.App.user.id;
    },

    userName() {
      return this.isMessageByCurrentUser 
              ? 'You' 
              : this.message.user.name;
    },

    formattedCreatedAt(message) {
      let distanceToNow = formatDistanceToNowStrict(
        parseISO(this.message.created_at)
      );

      return `${distanceToNow} ago`;
    }
  }
};
</script>

<style scoped>
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
