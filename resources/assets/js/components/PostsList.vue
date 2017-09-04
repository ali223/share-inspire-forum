<template>
  <div>
    <div class="panel panel-info text-left" v-for="post in postsList">
      <div class="panel-heading">
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
              <a href="#" class="delete">Delete</a>
            </div>

      </div>
    </div>
    <new-post @postAdded="reloadPostsList"></new-post>
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
      reloadPostsList: function () {
        this.fetchPosts();
      }
    }
}
</script>