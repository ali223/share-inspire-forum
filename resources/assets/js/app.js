
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');

Vue.prototype.authorize = function (handler) {

	let user = window.App.user;

	return user ? handler(user) : false;

};

require('./bootstrap');



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('posts-list', require('./components/PostsList.vue'));
Vue.component('notifications-list', require('./components/NotificationsList.vue'));
Vue.component('flash-message', require('./components/FlashMessage.vue'));
Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('categories-list', require('./components/CategoriesList.vue'));

const app = new Vue({
    el: '#app'
});
