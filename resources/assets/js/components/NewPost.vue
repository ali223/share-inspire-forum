<template>
    <div class="panel panel-info text-left" v-if="signedIn">
      <div class="panel panel-heading">
        <strong>Create a New Post</strong>
      </div>
      <div class="panel-body">
        <form>
          <div class="form-group">
            <textarea id="txtcontent" name="txtcontent" class="form-control" v-model="content" required></textarea>
          </div>
          <button class="btn btn-primary" type="submit" @click.prevent="addPost">
            Add Post
          </button>
        </form>
      </div>      
    </div>
</template>

<script>
    export default {
      data: function () {
        return {
          content: ''
        }
      },
      computed: {
        signedIn: function () {
          return window.App.signedIn;
        }
      },
      methods: {
        addPost: function () {
          if(this.content == '') {
            flashMessage('Error! Please enter the post text.', 'danger');
            return;
          }
          axios.post(location.pathname, 
              {
                content: this.content,
              }
            )
          .then(response => {
              this.content = '';
              this.$emit('postAdded', response.data);
          }).catch(error => {
              flashMessage('Error Adding New Post', 'warning');
          });
        }
      }
    }
</script>
