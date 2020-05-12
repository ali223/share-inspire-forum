<template>
  <li>
    <a href="#" @click.prevent="submitForm">
      Logout
    </a>

    <form ref="logoutForm" method="POST" :action="actionUrl">
      <input type="hidden" name="_token" :value="csrfToken">
      <input type="hidden" name="_method" value="DELETE">
    </form>
  </li>
</template>

<script>
export default {
  props: {
    actionUrl: {
      type: String,
      required: true
    },
    csrfToken: {
      type: String,
      required: true
    }
  },

  methods: {
    submitForm() {
      this.$refs.logoutForm.submit();
    }
  }
}
</script>
