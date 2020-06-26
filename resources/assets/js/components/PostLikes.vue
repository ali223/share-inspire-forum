<template>
  <div id="likes_div">
    <button
      id="like_btn"
      class="btn btn-link"
      :title="likeTitle"
      :disabled="!canLike || !signedIn"
      @click="like"
      v-if="!post.is_liked"
    >
      <i class="fa fa-lg fa-heart text-black-50"></i>
      <span title="likes"> {{ post.likes_count }} Likes </span>
    </button>

    <button
      id="unlike_btn"
      class="btn btn-link"
      title="Unlike Post"
      @click="unlike"
      v-else
    >
      <i class="fa fa-lg fa-heart text-danger"></i>
      <span title="likes"> {{ post.likes_count }} Likes </span>
    </button>
  </div>
</template>

<script>
export default {
  props: {
    initialPost: {
      type: Object,
      required: true
    }
  },

  data() {
    return {
      post: _.cloneDeep(this.initialPost)
    };
  },

  watch: {
    'initialPost.is_liked': function(newIsLiked) {
      this.post.is_liked = newIsLiked;
    },

    'initialPost.likes_count': function(newLikesCount) {
      this.post.likes_count = newLikesCount;
    }
  },

  computed: {
    canLike() {
      return this.authorize(user => this.post.user.id !== user.id);
    },

    signedIn() {
      return window.App.signedIn;
    },

    likeTitle() {
      if (!this.signedIn) {
        return 'You must be signed in to like the post';
      }

      if (!this.canLike) {
        return 'You cannot like your own posts';
      }

      return 'Like the post';
    }
  },

  methods: {
    like() {
      this.$emit('like', { ...this.post });
    },

    unlike() {
      this.$emit('unlike', { ...this.post });
    }
  }
};
</script>

<style scoped>
#like_btn,
#unlike_btn {
  color: red;
  font-size: 14px;
  font-weight: bold;
  text-decoration: none;
}
#likes_div {
  display: inline-block;
}
</style>
