<template>
  <div id="likes_div">
    <loading :active.sync="isLoading"></loading>

    <button 
      id="like_btn" 
      class="btn btn-link" 
      :title="likeTitle" 
      :disabled="!canLike || !signedIn"
      @click="likePost"
      v-if="!postData.is_liked"
    > 
      <i class="fa fa-lg fa-heart text-black-50"></i>
      <span title="likes">
        {{ postData.likes_count }} Likes
      </span>
    </button>

    <button 
      id="unlike_btn" 
      class="btn btn-link" 
      title="Unlike Post"
      @click="unlikePost"
      v-else
    >
      <i class="fa fa-lg fa-heart text-danger"></i>
      <span title="likes">
        {{ postData.likes_count }} Likes
      </span>          
    </button> 
  </div>
</template>

<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.min.css';

export default {
  props: ['initialPostData'],

  components: {
    Loading
  },

  data() {
    return {
      postData: this.initialPostData,
      isLoading: false
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
      this.isLoading = true;
      axios.post('/posts/' + this.postData.id + '/like')
          .then(response => {
            this.postData.is_liked = true;
            this.postData.likes_count++;
            flashMessage('Post Liked Successfully', 'success');
            this.isLoading = false;
          })
          .catch(error => {
            flashMessage('An Error occurred while trying to like the post', 'warning')
            this.isLoading = false;
          })
    },
    unlikePost() {
      this.isLoading = true;
      axios.delete('/posts/' + this.postData.id + '/like')
          .then(response => {
            this.postData.is_liked = false;
            this.postData.likes_count--;
            flashMessage('Post Unliked Successfully', 'success');
            this.isLoading = false;
          })
          .catch(error => {
            flashMessage('An Error occurred while trying to unlike the post', 'warning')
            this.isLoading = false;
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
#likes_div {
  display: inline-block;
}
</style>
