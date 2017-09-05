<template>
    <div class="panel panel-info text-left">
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
      methods: {
        addPost: function () {
          if(this.content == '') {
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
          })
        }
      }
    }
</script>
