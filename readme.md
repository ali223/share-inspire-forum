<h2>ShareInspire Forum</h2>
<p>
	ShareInspire Forum is a discussion forum website. It is meant to provide a platform, where people can come together and inspire eash other by sharing their thoughts and feelings. It is a personal project that I have built to learn and practise Vue.js and Laravel. You can visit the website at <a href="https://share-inspire-forum.herokuapp.com">https://share-inspire-forum.herokuapp.com</a>
</p>
<hr>
<h3>Features</h3>
<ul>
	<li>
		<h4>User Registration and Authentication</h4>
		<p>
			The website allows users to signup and then login to their accounts, using their username and password.
		</p>
	</li>
	<li>
		<h4>Users can create Topics, subject to Admin Approval</h4>
		<p>
			Users can create new topics in different categories, which display on the pubilc website, once approved by the Site Admin user. 
		</p>
	</li>
	<li>
		<h4>AJAX Requests for Addition, Updation and Deletion of Posts</h4>
		<p>
			Users can also add, edit or delete their posts to existing topics. Post addition, updation and deletion is done via AJAX requests, so users get immediate feedback, without the page reload.
		</p>
	</li>
	<li>
		<h4>Chat Room</h4>
		<p>
			All signed-in users can join the Chat Room to chat with other users. The Chat Room page shows a list of all users who are there. This feature has been implemented using Laravel Event Broadcasting, Laravel Echo, Vue.js and Pusher.
		</p>
	</li>
	<li>
		<h4>Real-Time update of posts, without refreshing the page.</h4>
		<p>
			When users add, edit or delete their posts, all other users get Real-Time updates on their browser windows, without refreshing the page. This has been accomplised using Laravel Event Broadcasting to broadcast server side events to client side via Pusher.
		</p>
	</li>
	<li>
		<h4>Real-Time Notifications</h4>
		<p>
			When a new post is added to any Topic, the Topic creater/user gets a new notification via email, and also via Notifications dropdown menu on the top navigation bar. Notifications menu gets updated real-time, without the need to refresh the page. This feature has been implemented using Laravel Notifications to send notifications via email, database and broadcast (via Pusher).
		</p>
	</li>
	<li>
		<h4>Admin Dashboard for Admin Users</h4>
		<p>
			The website also has an Admin Dashboard for the website Admin users. Admin users can approve or disapprove topics. Approved topics are displayed on the main website, whereas disapproved topics are not displayed.
		</p>
	</li>
	<li>
		<h4>Search Posts and View Latest Posts</h4>
		<p>
		You can also view the latest posts and also, search for the posts using options in the top navigation bar.
		</p>
	</li>
	<li>
		<h4>User Profiles</h4>
		<p>
			Every user has a profile, which lists the topics and posts created by them. The user profile can be viewed by clicking on the link showing username.
		</p>
	</li>
</ul>
<hr>
<p>ShareInspire Forum has been built using the following:-
</p>
<ul>
	<li>HTML</li>
	<li>CSS</li>
	<li>Bootstrap Framework</li>
	<li>JavaScript</li>
	<li>Vue.js</li>
	<li>Pusher</li>
	<li>Laravel Echo</li>
	<li>PHP</li>
	<li>Laravel Framework 5.4</li>
	<li>MYSQL</li>
</ul>
