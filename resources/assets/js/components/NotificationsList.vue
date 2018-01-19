<template>
	<li class="dropdown" v-if="notesList.length">
		<a href="#" 
			 class="dropdown-toggle" 
			 data-toggle="dropdown" 
			 role="button" 
			 aria-haspopup="true" 
			 aria-expanded="false">

			 	<span class="glyphicon glyphicon-bell"></span>
			 	
				<span class="badge">{{ notesList.length }}</span>
				<span class="caret"></span>

		</a>

		<ul class="dropdown-menu">
		  <li v-for="note in notesList">
		  	<a :href="note.data.url"
		  		 @click="markRead(note.id)">
		  		 	{{note.data.message}}
		  	</a>
		  </li>
		</ul>

	</li>
</template>

<script>
export default {
	data() {
		return {
			notesList: []
		}	
	},
	mounted() {
	  this.getNotifications();

	  Echo.private('App.User.' + window.App.user.id)
	  .notification( () => {
	    this.getNotifications();
	  });
	},
	methods: {
		getNotifications() {

			axios.get('/notifications')
					.then(response => this.notesList = response.data);
		},
		markRead(noteId)
		{
			axios.delete('/notifications/'+noteId);
		}
	}
}
</script>
