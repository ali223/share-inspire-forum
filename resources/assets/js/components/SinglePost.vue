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
    canUpdate: function () {
      return this.authorize(user => this.postData.user_id == user.id);
    }
  },
	methods: {
      remove: function (postId) {
        axios.delete(location.pathname + '/' + postId)
            .then(response => {
              this.$emit('postRemoved');
            })
            .catch(error => {
              flashMessage('Error Deleting the Post', 'warning');
            })

      },
      update: function (postId) {
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
            })

      }

	}
}
</script>