<template>
  <div class="card shadow-lg">
    <div class="card-header text-center bg-secondary text-light">
      Online Users
    </div>
    <div class="card-body">
      <ul v-if="users.length">
        <li v-for="user in users">
          {{ user.name }}
        </li>
      </ul>
      <p v-else>
        <em>No users online</em>
      </p>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    users: {
      type: Array,
      required: true
    }
  }
}
</script>
