<template>
  <div class="card shadow-lg">
    <div class="card-header text-center py-3">
      <h4>Chat Messages</h4>
    </div>
    <div class="card-body">
      <div class="messages" ref="messages">
        <chat-messages-list-item
          v-for="message in messages"
          :key="message.id"
          :message="message"
        />
      </div>
    </div>
  </div>
</template>

<script>
import ChatMessagesListItem from './ChatMessagesListItem';

export default {
  components: {
    ChatMessagesListItem
  },

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
    scrollMessagesDivToBottom() {
      this.$refs.messages.scrollTop = this.$refs.messages.scrollHeight;
    }
  }
};
</script>

<style scoped>
div.messages {
  height: 400px;
  overflow-y: scroll;
  padding-right: 5px;
}
</style>
