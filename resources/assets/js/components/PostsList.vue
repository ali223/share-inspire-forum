<template>
  <div>
    <div v-for="(post, index) in postsList" :key="post.id">
      <single-post 
        :initial-post-data="post" 
        @postRemoved="removeFromPostsList(index)"
        @postUpdated="updateMessage"> 
      </single-post>
    </div>
    <new-post @postAdded="addToPostsList"></new-post>
  </div>
</template>

<script>

import NewPost from './NewPost.vue';
import SinglePost from './SinglePost.vue';

export default {
    props: ['topicId'],

    components: {NewPost, SinglePost},

    data: function () {
      return {
        postsList: []
      }
    },

    mounted: function () {
      this.fetchPosts();

      Echo.channel('posts-channel')
          .listen('NewPostCreated', event => {
              this.postsList.push(event.post);
          })
          .listen('PostDeleted', event => {
              this.fetchPosts();
          });

    },

    methods: {
      fetchPosts() {
        axios.get(location.pathname)
            .then(response => {
               this.postsList = response.data.posts;
            });
      },
      addToPostsList: function (newPostdata) {
        this.postsList.push(newPostdata);
        flashMessage('Success! New Post Added', 'success');
      },
      removeFromPostsList: function (index) {
        this.postsList.splice(index, 1);
        flashMessage('Success! Post Deleted', 'success');
      },
      updateMessage: function () {
        flashMessage('Success! Post Updated', 'success')
      }
    }
}
</script>