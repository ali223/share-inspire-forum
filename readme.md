<h2>ShareInspire Forum</h2>
<p>
	ShareInspire Forum is a discussion forum website. It is meant to provide a platform, where people can come together and inspire eash other by sharing their thoughts and feelings. It is a personal project that I have built to learn and practise Vue.js and Laravel. You can visit the website at <a href="http://share-inspire-forum.herokuapp.com">http://share-inspire-forum.herokuapp.com</a>
</p>
<hr>
<h3>Features</h3>
<ul>
	<li>
		The website allows users to signup and then login to their accounts, using their username and password.
	</li>
	<li>
		Users can create new topics in different categories, which display on the pubilc website, once approved by the Site Admin user. 
	</li>
	<li>
		Users can also add, edit or delete their posts to existing topics. Post addition, updation and deletion is done via AJAX requests, so users get immediate feedback, without the page reload.
	</li>
	<li>
		When users add, edit or delete their posts, all other users get Real-Time update on their browser windows, without refreshing the page. This has been accomplised using Laravel Event Broadcasting to broadcast server side events to client side via Pusher.
	</li>
	<li>
		The website also has an Admin Dashboard for the website Admin users. Admin users can approve or disapprove topics. Approved topics are displayed on the main website, whereas disapproved topics are not displayed.
	</li>
	<li>
		You can also view the latest posts and also, search for the posts using options in the top navigation bar.
	</li>
	<li>
		Every user has a profile, which lists the topics and posts created by them. The user profile can be viewed by clicking on the link showing username.
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
