<template>
    <div class="panel panel-info text-left">
      <div class="panel-heading">
        <h3>{{postData.id}}</h3>
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
          
          <p>{{ postData.content }}</p>

            <div class="interaction">
              <a href="#" class="edit">Edit</a> |
              <a href="#" class="delete" @click.prevent="remove(postData.id)">Delete</a>
            </div>

      </div>
    </div>
</template>
<script>
export default {
	props: ['initialPostData'],

	data: function () {
		return {
			postData: this.initialPostData
		}
	},
	methods: {
      remove: function (postId) {
        axios.delete(location.pathname + '/' + postId)
            .then(response => {
              this.$emit('postRemoved');
            })
      }

	}
}
</script>