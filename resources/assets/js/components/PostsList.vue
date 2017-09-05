<template>
  <div>
    <div class="panel panel-info text-left" v-for="(post, index) in postsList">
      <div class="panel-heading">
        <h3>{{post.id}}</h3>
        <strong>
        Posted By
          <a :href="'/profiles/' + post.user_id">
              {{ post.user.name }} 
          </a>
          on 
          {{ post.created_at }}
        </strong>
      </div>
      <div class="panel-body">
          
          <p>{{ post.content }}</p>

            <div class="interaction">
              <a href="#" class="edit">Edit</a> |
              <a href="#" class="delete" @click.prevent="remove(post.id, index)">Delete</a>
            </div>

      </div>
    </div>
    <new-post @postAdded="addToPostsList"></new-post>
  </div>
</template>
<script>
import NewPost from './NewPost.vue';

export default {
    props: ['topicId'],

    components: {NewPost},

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
      remove: function (postId, index) {
        axios.delete(location.pathname + '/' + postId)
            .then(response => {
              this.postsList.splice(index, 1);
            })
      }
    }
}
</script>