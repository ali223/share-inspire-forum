<template>
  <div>
    <div
      v-for="(post, index) in postsList"
      :key="post.id"
      :ref="'#post' + post.id"
    >
      <post-list-item
        :initial-post="post"
        @remove="deletePost"
        @update="updatePost"
      >
      </post-list-item>
    </div>
    <post-creator @postAdded="addToPostsList" />
    <loading :active.sync="isLoading" />
  </div>
</template>

<script>
import PostCreator from './PostCreator.vue';
import PostListItem from './PostListItem.vue';
import Loading from 'vue-loading-overlay';

export default {
  components: {
    PostCreator,
    PostListItem,
    Loading
  },

  props: {
    topicWithPosts: {
      type: Object,
      required: true
    }
  },

  data() {
    return {
      postsList: _.cloneDeep(this.topicWithPosts.posts),
      isLoading: false
    };
  },

  created() {
    Echo.channel('posts-channel')
      .listen('NewPostCreated', event => {
        this.postsList.push(event.post);
      })
      .listen('PostDeleted', event => {
        this.removePostFromListById(event.postId);
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

    deletePost({ id, topic_id }) {
      this.isLoading = true;

      axios
        .delete(`/topics/${topic_id}/posts/${id}`)
        .then(response => {
          this.removePostFromListById(id);
          flashMessage('Success! Post Deleted', 'success');
          this.isLoading = false;
        })
        .catch(error => {
          flashMessage('Error Deleting the Post', 'warning');
          this.isLoading = false;
        });
    },

    updatePost({ id, content, topic_id }) {
      this.isLoading = true;

      axios
        .patch(`/topics/${topic_id}/posts/${id}`, { content })
        .then(response => {
          this.updatePostInTheList(response.data.data);
          flashMessage('Success! Post Updated', 'success');
          this.isLoading = false;
        })
        .catch(error => {
          flashMessage('Error Updating the Post', 'warning');
          this.isLoading = false;
        });
    },

    getPostIndex(postId) {
      return this.postsList.findIndex(function(post) {
        return post.id === postId;
      });
    },

    removePostFromListById(postId) {
      let postIndex = this.getPostIndex(postId);

      if (postIndex !== -1) {
        this.postsList.splice(postIndex, 1);
      }
    },

    updatePostInTheList(updatedPost) {
      let postIndex = this.getPostIndex(updatedPost.id);

      if (postIndex !== -1) {
        this.postsList.splice(postIndex, 1, updatedPost);
      }
    }
  }
};
</script>
