<template>
  <div class="card shadow-lg mt-2 mb-4" v-if="signedIn">
    <div class="card-header">
      <strong>Create a New Post</strong>
    </div>
    <div class="card-body">
      <loading :active.sync="isLoading"></loading>      
      <form>
        <div class="form-group">
          <textarea 
            id="txtcontent" 
            name="txtcontent" 
            class="form-control" 
            v-model="content" 
            required
          ></textarea>
        </div>
        <button 
          class="btn btn-custom" 
          type="submit" 
          @click.prevent="addPost"
        >
          Add Post
        </button>
      </form>      
    </div>      
  </div>
</template>

<script>
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.min.css';

export default {
  components: {
    Loading
  },
  data() {
    return {
      content: '',
      isLoading: false
    }
  },
  computed: {
    signedIn() {
      return window.App.signedIn;
    }
  },
  methods: {
    addPost() {
      if(this.content == '') {
        flashMessage('Error! Please enter the post text.', 'danger');
        return;
      }
      this.isLoading = true;
      axios.post(location.pathname, 
          {
            content: this.content,
          }
        )
      .then(response => {
          this.content = '';
          this.$emit('postAdded', response.data);
          this.isLoading = false;
      }).catch(error => {
          flashMessage('Error Adding New Post', 'warning');
          this.isLoading = false;
      });
    }
  }
}
</script>
