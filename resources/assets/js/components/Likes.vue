<template>
  <button id="like_btn" 
          class="btn btn-link" 
          :title="likeTitle" 
          :disabled="!canLike || !signedIn"
          @click="likePost"
          v-if="!postData.is_liked"> 
    <span class="glyphicon glyphicon-heart-empty"></span>
    <span title="likes">
      {{ postData.likes_count }} Likes
    </span>
  </button>

  <button id="unlike_btn" 
          class="btn btn-link" 
          title="Unlike Post"
          @click="unlikePost"
          v-else>
    <span class="glyphicon glyphicon-heart"></span>
    <span title="likes">
      {{ postData.likes_count }} Likes
    </span>          
  </button> 
</template>

<script>
export default {
  props: ['initialPostData'],

  data() {
    return {
      postData: this.initialPostData
    }
  },
  computed: {
    canLike() {
      return this.authorize(user => this.postData.user_id !== user.id);
    },
    signedIn() {
      return window.App.signedIn;
    },
    likeTitle() {
      if (! this.signedIn) {
        return 'You must be signed in to like the post';
      }

      if (! this.canLike) {
        return 'You cannot like your own posts';
      }

      return 'Like the post';
    }
  },
  methods: {
      likePost() {
        axios.post('/posts/' + this.postData.id + '/like')
            .then(response => {
              this.postData.is_liked = true;
              this.postData.likes_count++;
              flashMessage('Post Liked Successfully', 'success');
            })
            .catch(error => {
              flashMessage('An Error occurred while trying to like the post', 'warning')
            })
      },
      unlikePost() {
        axios.delete('/posts/' + this.postData.id + '/like')
            .then(response => {
              this.postData.is_liked = false;
              this.postData.likes_count--;
              flashMessage('Post Unliked Successfully', 'success');
            })
            .catch(error => {
              flashMessage('An Error occurred while trying to unlike the post', 'warning')
            })        
      }    
  }
}
</script>

<style scoped>
#like_btn, #unlike_btn {
  color: red;
  font-size: 14px;
  font-weight: bold;
  text-decoration: none;
}
</style>
