<template>
  <div class="panel panel-info text-left">
    <div class="panel-heading">
      <strong>
        Posted By
        <a :href="'/profiles/' + postData.user_id">
            {{ postData.user.name }} 
        </a>
        {{ postData.created_at | moment("from")}}
      </strong>
      <likes :initial-post-data="initialPostData"></likes>
    </div>
    <div class="panel-body">
        <loading :active.sync="isLoading"></loading>

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
import Likes from './Likes';
import Loading from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/vue-loading.min.css';

export default {
	props: ['initialPostData'],

  components: {
    Likes, Loading
  },

	data() {
		return {
			postData: this.initialPostData,
			isEditing: false,
      isLoading: false
		}
	},
  computed: {
    canUpdate() {
      return this.authorize(user => this.postData.user_id === user.id);
    }
  },
	methods: {
      remove(postId) {
        this.isLoading = true;
        axios.delete(location.pathname + '/' + postId)
            .then(response => {
              this.$emit('postRemoved');
              this.isLoading = false;
            })
            .catch(error => {
              flashMessage('Error Deleting the Post', 'warning');
              this.isLoading = false;
            })

      },
      update(postId) {
        if(this.content == '') {
          return;
        }
        this.isLoading = true;
        axios.put(location.pathname + '/' + postId, {
        			content: this.postData.content
        		})
            .then(response => {
            	this.isEditing = false;
              this.$emit('postUpdated', this.postData.content);
              this.isLoading = false;
            })
            .catch(error => {
              flashMessage('Error Updating the Post', 'warning');
              this.isLoading = false;
            });
      }
	}
}
</script>
