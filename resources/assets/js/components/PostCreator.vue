<template>
  <div class="card shadow-lg my-2" v-if="signedIn">
    <div class="card-header">
      <strong>Create a New Post</strong>
    </div>
    <div class="card-body">
      <form @submit.prevent="add">
        <div class="form-group">
          <textarea
            id="txtcontent"
            name="txtcontent"
            class="form-control"
            v-model="post.content"
            required
          ></textarea>
        </div>
        <button class="btn btn-custom" type="submit">
          Add Post
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      post: {
        content: ''
      },
      isLoading: false
    };
  },

  computed: {
    signedIn() {
      return window.App.signedIn;
    }
  },

  methods: {
    add() {
      this.$emit('add', { ...this.post });
      this.post.content = '';
    }
  }
};
</script>
