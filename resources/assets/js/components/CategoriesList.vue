<template>
  <div class="row" v-if="signedIn">
    <div class="col-md-8">
      <div class="card shadow-lg mt-2 mb-4">
        <div class="card-header text-center bg-secondary text-light">
          <h4>
            Categories
          </h4>
        </div>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Category Id</th>
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
      <new-category 
        @categoryAdded="addToCategoriesList"
        v-if="!editing"
      >
      </new-category>
      <edit-category 
        v-else
        :category-data="selectedCategory"
        @categoryUpdated="updateCategoriesList"
        @cancelled="cancelEditForm"
      >
      </edit-category>
    </div>
  </div>
</template>

<script>
import NewCategory from './NewCategory.vue';
import EditCategory from './EditCategory.vue';

export default {
  components: { NewCategory, EditCategory },

  data() {
    return {
      categories: [],
      editing: false,
      selectedCategory: null
    }
  },

  created() {
    this.getCategories();
  },

  computed: {
    signedIn() {
      return window.App.signedIn;
    }
  },

  methods: {
    getCategories() {
      axios.get('/admin/categories')
          .then(response => this.categories = response.data)
          .catch(error => {
              flashMessage('Error retrieving categories', 'danger');
          });
    },

    addToCategoriesList(newCategoryData) {
      this.categories.push(newCategoryData);
      flashMessage('New category added successfully', 'success');
    },

    updateCategoriesList(updatedCategoryData) {
      this.editing = false;
      this.selectedCategory = null;

      for (let category of this.categories) {
        if (category.id == updatedCategoryData.id) {
          category.name = updatedCategoryData.name;
          category.description = updatedCategoryData.description;
        }
      }
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
