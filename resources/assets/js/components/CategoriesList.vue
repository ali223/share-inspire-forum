<template>
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
</template>

<script>
export default {
	data() {
		return {
			categories: []
		}
	},

	created() {
		this.getCategories();
	},

	methods: {
		getCategories() {
			axios.get('/admin/categories')
					.then(response => this.categories = response.data)
					.catch((response) => {
							flashMessage('Error retrieving categories', 'danger');
					});
		}
	}
}
</script>


