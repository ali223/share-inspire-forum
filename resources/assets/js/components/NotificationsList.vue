<template>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Notifications <span class="badge">{{ notesList.length }}</span><span class="caret"></span></a>
		<ul class="dropdown-menu">
		  <li v-for="note in notesList">
		  	<a :href="note.url">{{note.message}}</a>
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

			axios.get('/shareinspire/notifications')

			.then(response => {
				
				this.notesList = [];

				let notes = response.data;

				for(let i=0; i < notes.length; i++) {
					this.notesList.push(notes[i]);
				}

			})
			;
		}
	}
}
</script>
