<template>
  <div class="card shadow-lg">
    <div class="card-header text-center">
      <strong>Edit Category</strong>
    </div>
    <div class="card-body">
      <form @submit.prevent="updateCategory">
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
            required
          ></textarea>
        </div>

        <button 
          type="submit"
          class="btn btn-custom"
        >
          Update
        </button>

        <button 
          type="button"
          class="btn btn-danger" 
          @click.prevent="cancel"
        >
          Cancel
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  props: { 
    initialCategory: {
      type: Object,
      required: true
    }
  },

  data() {
    return {
      category: {...this.initialCategory}
    }
  },

  watch: {
    initialCategory(newinitialCategory) {
      this.category.name = newinitialCategory.name;
      this.category.description = newinitialCategory.description;
    }
  },

  methods: {
    updateCategory() {
      this.$emit('update', {...this.category});
      this.category.name = '';
      this.category.description = '';
    },

    cancel() {
      this.category.name = '';
      this.category.description = '';
      this.$emit('cancelled');
    }
  }
}
</script>
