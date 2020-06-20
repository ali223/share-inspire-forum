<template>
	<li class="nav-item dropdown" v-if="notesList.length">
    <a 
      href="#" 
      class="nav-link dropdown-toggle active" 
      data-toggle="dropdown" 
      role="button" 
      aria-haspopup="true" 
      aria-expanded="false"
    >
      <i class="fa fa-lg fa-bell"></i>
      <span class="badge badge-light badge-pill">
        {{ notesList.length }}
      </span>
      <span class="caret"></span>
    </a>

    <div class="dropdown-menu dropdown-menu-right shadow-lg">
      <a 
        class="dropdown-item"
        :href="note.data.url"
        @click="markRead(note.id)"
        v-for="note in notesList"
      >
        {{note.data.message}}
      </a>
    </div>
  </li>
</template>

<script>
export default {
  data() {
    return {
     notesList: []
    }
  },

  created() {
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

    markRead(noteId) {
      axios.delete('/notifications/'+noteId);
    }
  }
}
</script>
