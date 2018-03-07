## ShareInspire Forum [![Build Status](https://travis-ci.org/ali223/share-inspire-forum.svg?branch=master)](https://travis-ci.org/ali223/share-inspire-forum)

ShareInspire Forum is a discussion forum website. It is meant to provide a
platform, where people can come together and inspire eash other by sharing
their thoughts and feelings. It is a personal project that I have built to
learn and practise Vue.js and Laravel. You can visit the website at https
://share-inspire-forum.herokuapp.com

* * *

### Features

#### User Registration and Authentication

The website allows users to signup and then login to their accounts, using
their username and password.

#### Users can create Topics, subject to Admin Approval

Users can create new topics in different categories, which display on the
pubilc website, once approved by the Site Admin user.

#### AJAX Requests for Addition, Updation and Deletion of Posts

Users can also add, edit or delete their posts to existing topics. Post
addition, updation and deletion is done via AJAX requests, so users get
immediate feedback, without the page reload.

#### Chat Room

All signed-in users can join the Chat Room to chat with other users. The Chat
Room page shows a list of all users who are there. This feature has been
implemented using Laravel Event Broadcasting, Laravel Echo, Vue.js and Pusher.

#### Real-Time update of posts, without refreshing the page.

When users add, edit or delete their posts, all other users get Real-Time
updates on their browser windows, without refreshing the page. This has been
accomplised using Laravel Event Broadcasting to broadcast server side events
to client side via Pusher.

#### Real-Time Notifications

When a new post is added to any Topic, the Topic creater/user gets a new
notification via email, and also via Notifications dropdown menu on the top
navigation bar. Notifications menu gets updated real-time, without the need to
refresh the page. This feature has been implemented using Laravel
Notifications to send notifications via email, database and broadcast (via
Pusher).

#### Admin Dashboard for Admin Users

The website also has an Admin Dashboard for the website Admin users. Admin
users can approve or disapprove topics. Approved topics are displayed on the
main website, whereas disapproved topics are not displayed.

#### Search Posts and View Latest Posts

You can also view the latest posts and also, search for the posts using
options in the top navigation bar.

#### User Profiles

Every user has a profile, which lists the topics and posts created by them.
The user profile can be viewed by clicking on the link showing username.

* * *

ShareInspire Forum has been built using the following:-

  * HTML
  * CSS
  * Bootstrap Framework
  * JavaScript
  * Vue.js
  * Pusher
  * Laravel Echo
  * PHP
  * Laravel Framework 5.4
  * MYSQL

