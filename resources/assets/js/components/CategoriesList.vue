<template>
  <div class="row" v-if="signedIn">
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
  props: {
    initialCategories: {
      type: Array,
      required: true
    }
  },

  components: { 
    NewCategory, 
    EditCategory 
  },

  data() {
    return {
      categories: _.cloneDeep(this.initialCategories),
      editing: false,
      selectedCategory: null
    }
  },

  computed: {
    signedIn() {
      return window.App.signedIn;
    }
  },

  methods: {
    addToCategoriesList(newCategoryData) {
      this.categories.push(newCategoryData);
      flashMessage('New category added successfully', 'success');
    },

    updateCategoriesList({id, name, description}) {
      this.editing = false;
      this.selectedCategory = null;

      let searchedCategory = this.categories.find(category => category.id === id);

      if (searchedCategory) {
          searchedCategory.name = name;
          searchedCategory.description = description;
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
