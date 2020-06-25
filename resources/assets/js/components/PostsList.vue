<template>
  <div>
    <div
      v-for="(post, index) in postsList"
      :key="post.id"
      :ref="'#post' + post.id"
    >
      <post-list-item
        :initial-post-data="post"
        @postRemoved="removeFromPostsList(index)"
        @postUpdated="updateMessage"
      >
      </post-list-item>
    </div>
    <post-creator @postAdded="addToPostsList" />
  </div>
</template>

<script>
import PostCreator from './PostCreator.vue';
import PostListItem from './PostListItem.vue';

export default {
  components: {
    PostCreator,
    PostListItem
  },

  props: {
    topicWithPosts: {
      type: Object,
      required: true
    }
  },

  data() {
    return {
      postsList: _.cloneDeep(this.topicWithPosts.posts)
    };
  },

  created() {
    Echo.channel('posts-channel')
      .listen('NewPostCreated', event => {
        this.postsList.push(event.post);
      })
      .listen('PostDeleted', event => {
        let postIndex = this.getPostIndex(event.postId);

        if (postIndex !== -1) {
          this.postsList.splice(postIndex, 1);
        }
      })
      .listen('PostUpdated', event => {
        let postIndex = this.getPostIndex(event.post.id);

        if (postIndex !== -1) {
          this.postsList[postIndex].content = event.post.content;
        }
      });
  },

  mounted() {
    this.$nextTick(() => {
      this.scrollToPost(window.location.hash);
    });
  },

  methods: {
    scrollToPost(bookmarkHash) {
      if (bookmarkHash && this.$refs.hasOwnProperty(bookmarkHash)) {
        let postDiv = this.$refs[bookmarkHash][0];
        let top = postDiv.offsetTop;
        window.scrollTo(0, top);
      }
    },

    addToPostsList(newPostdata) {
      this.postsList.push(newPostdata);
      flashMessage('Success! New Post Added', 'success');
    },

    removeFromPostsList(index) {
      this.postsList.splice(index, 1);
      flashMessage('Success! Post Deleted', 'success');
    },

    updateMessage() {
      flashMessage('Success! Post Updated', 'success');
    },

    getPostIndex(postId) {
      return this.postsList.findIndex(function(post) {
        return post.id == postId;
      });
    }
  }
};
</script>
