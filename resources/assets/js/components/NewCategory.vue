<template>
  <div class="card shadow-lg" v-if="signedIn">
    <div class="card-header text-center bg-secondary text-light">
      <strong>Create a New Category</strong>
    </div>
    <div class="card-body">
      <form @submit.prevent="addCategory">
        <div class="form-group">
          <label for="name">Name</label>
          <input 
            id="name" 
            name="name" 
            class="form-control" 
            v-model="category.name" 
            required
          />
        </div>
        <div class="form-group">
          <label for="name">Description</label>
          <textarea 
            id="description" 
            name="description" 
            class="form-control" 
            v-model="category.description" 
            required></textarea>
        </div>
        <button 
          class="btn btn-custom" 
          type="submit" 
        >
          Save
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      category: {
        name: '',
        description: ''
      }
    }
  },

  methods: {
    addCategory() {
      this.$emit('add', {...this.category});
      this.category.name = '';
      this.category.description = '';
    }
  },

  computed: {
    signedIn() {
      return window.App.signedIn;
    }
  }
}
</script>
