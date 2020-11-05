/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Gate from './policies/Gate';

Gate.prototype.before = function() {
    return this.user.roles.super-admin;
}

window.Gate = new Gate('User');


/**
 * Include and configure VueJS
 */

window.Vue = require('vue');

window.Vue.prototype.$gate = window.Gate;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': document.getElementsByName('csrf-token').item(0).content,
    'X-Requested-With': 'XMLHttpRequest',
    'User-Agent': 'WhatsThatAbout/1.0',
    'Accept': 'application/json',
    'Authorization': 'Bearer ' + document.getElementsByName('remember-token').item(0).content
};

/**
 * Require and setup VueJS
 */

window.Vue = require('vue');

// Define helper properties
Object.defineProperty(Vue.prototype, '$axios', { value: window.axios });

// window.Vue.prototype.authorize = function (handler) {
//     // Additional admin privileges here.
//     let user = window.App.user;
//
//     return user ? handler(user) : false;
// };

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/Comment.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('comment', require('./components/Comment.vue').default);
Vue.component('vote', require('./components/Vote.vue').default);
Vue.component('update-or-create', require('./components/UpdateOrCreate.vue').default);
Vue.component('segment', require('./components/Segment.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

app = new Vue({
    el: '#app',
});


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
