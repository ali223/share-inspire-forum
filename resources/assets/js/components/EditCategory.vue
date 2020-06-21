<template>
  <div class="card shadow-lg" v-if="signedIn">
    <div class="card-header text-center bg-secondary text-light">
      <strong>Edit Category</strong>
    </div>
    <div class="card-body">
      <form>
        <div class="form-group">
          <label for="name">Name</label>
          <input 
            id="name" 
            name="name" 
            class="form-control" 
            v-model="name" 
            required
          />
        </div>

        <div class="form-group">
          <label for="name">Description</label>
          <textarea 
            id="description" 
            name="description" 
            class="form-control" 
            v-model="description" 
            required
          ></textarea>
        </div>

        <button 
          class="btn btn-custom" 
          type="submit"
          @click.prevent="updateCategory"
        >
          Update
        </button>

        <button 
          class="btn btn-danger" 
          type="submit"
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
  props: [ 'categoryData' ],

  data() {
    return {
      id: this.categoryData.id,
      name: this.categoryData.name,
      description: this.categoryData.description
    }
  },

  watch: {
    categoryData(newCategoryData) {
      this.name = newCategoryData.name;
      this.description = newCategoryData.description;
    }
  },

  computed: {
    signedIn() {
      return window.App.signedIn;
    }
  },

  methods: {
    updateCategory() {
      if (!this.name) {
        flashMessage('Error! Please enter the category name.', 'danger');
        return;
      }

      if (!this.description) {
        flashMessage('Error! Please enter the category description', 'danger');
        return;
      }

      axios.patch(
        location.pathname + '/' + this.id,
        {
          name: this.name,
          description: this.description
        }
      ).then(response => {
        this.name = null;
        this.description = null;

        this.$emit('categoryUpdated', response.data);
        flashMessage('Category updated successfully', 'success');
      }).catch(error => {
        flashMessage('Error Updating Category', 'warning');
      });
    },

    cancel() {
      this.name = null;
      this.description = null;
      this.$emit('cancelled');
    }
  }
}
</script>
