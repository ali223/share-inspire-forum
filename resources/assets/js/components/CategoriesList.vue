<template>
<div class="container margin-top" v-if="signedIn">
  <div class="row">
    <div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
				  <h3>Categories</h3>
				</div>

				<div class="panel-body">
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
							<tr v-for="category in categories">
								<td>{{ category.id }}</td>
								<td>{{ category.name }}</td>
								<td>{{ category.description }}</td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<new-category @categoryAdded="addToCategoriesList"></new-category>
		</div>
	</div>
</div>
</template>

<script>

import NewCategory from './NewCategory.vue';

export default {
	components: { NewCategory },

	data() {
		return {
			categories: []
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
		}
	}
}
</script>


