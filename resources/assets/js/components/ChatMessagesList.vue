<template>
  <div class="card shadow-lg">
    <div class="card-header text-center py-3">
      <h4>Chat Messages</h4>
    </div>
    <div class="card-body">
      <div class="messages" ref="messages">
        <ul>
          <li v-for="message in messages" :key="message.id">
            <p class="message-content">
              <strong>{{ message.user.name }} : </strong>
              {{ message.text }}
              <span class="message-time">
                {{ formattedCreatedAt(message) }}
              </span>
            </p>
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

span.message-time {
  float: right;
  color: #999;
}
</style>
