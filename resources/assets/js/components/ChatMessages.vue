<template>
	<div class="row">
		<div class="col-md-8">
			<div class="messages">
				<ul>
					<li v-for="message in messages">
						<p>
							<strong>{{ message.user.name }} : </strong>
							{{ message.text }}
						</p>
					</li>
				</ul>
			</div>
			<form @submit.prevent="sendMessage">
				<div class="form-group">
					<textarea class="form-control" v-model="newMessage" required></textarea>
				</div>
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Send Message</button>
				</div>
			</form>
		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Online Users
				</div>
				<div class="panel-body">
					<ul>
						<li v-for="user in onlineUsers">
							{{ user.name }}
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				messages: [],
				newMessage: '',
				onlineUsers: []
			}
		},
		mounted() {
			this.getMessages();

			Echo.join('Chat.Room')
					.here(users => {
							this.onlineUsers = users;
					})
					.listen('NewChatMessage', event => {
							this.messages.push(event.message);
					})
					.joining(user => {
						this.onlineUsers.push(user);
					})
					.leaving(user => {
						let index = this.onlineUsers.findIndex( (onlineUser) => {
							return onlineUser.id == user.id;
						});

						this.onlineUsers.splice(index, 1);
					});
		},
		updated() {
			this.$el.querySelector('.messages').scrollTop =
			this.$el.querySelector('.messages').scrollHeight
		},
		methods: {
			getMessages() {
				axios.get(location.pathname)
					.then(response => {
						this.messages = response.data;
					});

			},
			sendMessage() {
				axios.post(location.pathname, {
						text: this.newMessage,
						user_id: window.App.user.id
				})
					.then(response => {
							this.getMessages();
							this.newMessage = '';
					})
					.catch(error => {
						flashMessage('Error sending message', 'danger');
					});
			}
		}
	}
</script>
<style>
div.messages {
	height: 400px;
	overflow: scroll;
}	

div.messages ul {
	list-style-type: none;
}
</style>
