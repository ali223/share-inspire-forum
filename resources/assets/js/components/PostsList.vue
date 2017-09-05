<template>
  <div>
    <div v-for="(post, index) in postsList" :key="post.id">
      <single-post 
        :initial-post-data="post" 
        @postRemoved="removeFromPostsList(index)">        
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
      },
      removeFromPostsList: function (index) {
        this.postsList.splice(index, 1);
      }
    }
}
</script>