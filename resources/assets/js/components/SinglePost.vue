<template>
    <div class="panel panel-info text-left">
      <div class="panel-heading">
        <strong>
          Posted By
          <a :href="'/profiles/' + postData.user_id">
              {{ postData.user.name }} 
          </a>
          on 
          {{ postData.created_at }}
        </strong>

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
      </div>
      <div class="panel-body">
      		<div v-if="isEditing">
      			<form>
      				<div class="form-group">
      					<textarea id="txtcontent" name="txtcontent" class="form-control" v-model="postData.content"></textarea>
      				</div>
				      <div class="interaction">
		            <a href="#" class="btn btn-primary btn-xs" @click.prevent="update(postData.id)">Update</a>

		            <a href="#" class="btn btn-danger btn-xs" @click.prevent="isEditing=false">Cancel</a>
		          </div>

      			</form>
      		</div>
          	<div v-else>
          		<p>{{ postData.content }}</p>	
					      <div class="interaction" v-if="canUpdate">
			            <a href="#" class="btn btn-primary btn-xs" @click.prevent="isEditing=true">Edit</a>

			            <a href="#" class="btn btn-danger btn-xs" @click.prevent="remove(postData.id)">Delete</a>
			          </div>
          	</div>
      </div>
    </div>
</template>
<script>
export default {
	props: ['initialPostData'],

	data: function () {
		return {
			postData: this.initialPostData,
			isEditing: false
		}
	},
  computed: {
    canUpdate() {
      return this.authorize(user => this.postData.user_id === user.id);
    },
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
      remove(postId) {
        axios.delete(location.pathname + '/' + postId)
            .then(response => {
              this.$emit('postRemoved');
            })
            .catch(error => {
              flashMessage('Error Deleting the Post', 'warning');
            })

      },
      update(postId) {
        if(this.content == '') {
          return;
        }

        axios.put(location.pathname + '/' + postId, {
        			content: this.postData.content
        		})
            .then(response => {
            	this.isEditing = false;
              this.$emit('postUpdated', this.postData.content);
            })
            .catch(error => {
              flashMessage('Error Updating the Post', 'warning');
            });
      },
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