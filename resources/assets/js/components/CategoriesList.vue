<template>
  <div class="row">
    <div class="col-md-8">
      <div class="card shadow-lg">
        <div class="card-header text-center bg-secondary text-light">
          <h4>
            Categories
          </h4>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Id</th>
              <th>Category Name</th>
              <th>Category Description</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr 
              :class="{'success' : isSelected(category) }"
              v-for="category in categories"
            >
              <td>{{ category.id }}</td>
              <td>{{ category.name }}</td>
              <td>{{ category.description }}</td>
              <td>
                <button class="btn btn-custom" @click="showEditForm(category)">
                  Edit
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-4">
      <category-creator 
        @add="storeCategory"
        v-if="!editing"
      >
      </category-creator>
      <category-editor 
        v-else
        :initial-category="selectedCategory"
        @update="updateCategory"
        @cancelled="cancelEditForm"
      >
      </category-editor>
    </div>
    <loading :active.sync="isLoading"></loading>
  </div>
</template>

<script>
import CategoryCreator from './CategoryCreator.vue';
import CategoryEditor from './CategoryEditor.vue';
import Loading from 'vue-loading-overlay';

export default {
  components: { 
    CategoryCreator, 
    CategoryEditor,
    Loading
  },

  props: {
    initialCategories: {
      type: Array,
      required: true
    }
  },

  data() {
    return {
      categories: _.cloneDeep(this.initialCategories),
      editing: false,
      selectedCategory: null,
      isLoading: false
    }
  },

  methods: {
    storeCategory(category) {
      this.isLoading = true;

      axios.post('/admin/categories', category)
        .then(response => {
          this.categories.push(response.data.data);
          flashMessage('New category added successfully', 'success');
          this.isLoading = false;
      }).catch(error => {
        flashMessage('Error Adding New Category', 'warning');
        this.isLoading = false;
      });
    },

    updateCategory({id, name, description}) {
      this.isLoading = true;
      this.editing = false;

      axios.patch(`/admin/categories/${id}`, {name, description})
        .then(response => {
          let updatedCategory = response.data.data;

          this.selectedCategory.name = updatedCategory.name;
          this.selectedCategory.description = updatedCategory.description;
          this.selectedCategory = null;

          flashMessage('Category updated successfully', 'success');
          this.isLoading = false;
      }).catch(error => {
        this.selectedCategory = null;
        flashMessage('Error Updating Category', 'warning');
        this.isLoading = false;
      });
    },

    showEditForm(category) {
      this.editing = true;
      this.selectedCategory = category;
    },

    cancelEditForm() {
      this.editing = false;
      this.selectedCategory = null;
    },

    isSelected(category) {
      if (this.selectedCategory) {
        return category.id == this.selectedCategory.id;
      }

      return false;
    }
  }
}
</script>
