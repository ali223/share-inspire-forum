<template>
    <div class="panel panel-default text-left" v-if="signedIn">
      <div class="panel panel-heading">
        <strong>Create a New Category</strong>
      </div>
      <div class="panel-body">
        <form>
          <div class="form-group">
            <label for="name">Name</label>
            <input id="name" name="name" class="form-control" v-model="name" required>
          </div>

          <div class="form-group">
            <label for="name">Description</label>
            <textarea id="description" name="description" class="form-control" v-model="description" required></textarea>
          </div>
          <button class="btn btn-primary" type="submit" @click.prevent="addCategory">
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
          name: null,
          description: null
        }
      },
      computed: {
        signedIn() {
          return window.App.signedIn;
        }
      },
      methods: {
        addCategory() {
          if (!this.name) {
            flashMessage('Error! Please enter the category name.', 'danger');
            return;
          }

          if (!this.description) {
            flashMessage('Error! Please enter the category description', 'danger');
            return;
          }

          axios.post(location.pathname, 
              {
                name: this.name,
                description: this.description
              }
            )
          .then(response => {
              this.name = null;
              this.description = null;
              this.$emit('categoryAdded', response.data);
          }).catch(error => {
              flashMessage('Error Adding New Category', 'warning');
          });
        }
      }
    }
</script>
