<template>
  <div>
    <form @submit.prevent="sendMessage">
      <div class="form-group">
        <textarea class="form-control" v-model="message" required></textarea>
      </div>
      <div class="form-group">
        <button class="btn btn-custom" type="submit">Send Message</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: ''
    }
  },

  methods: {
    sendMessage() {
      this.$emit('send', { message: this.message });
      this.message = '';
    }
  }
}
</script>
