
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');


/**
 * jQuery Setup
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': window.csrf_token,
        'Authorization': 'Bearer ' + window.remember_token,
    }
});


/**
 * Axios Setup
 *
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.csrf_token,
    'X-Requested-With': 'XMLHttpRequest',
    'User-Agent': 'WhatsThatAbout/1.0',
    'Accept': 'application/json',
    'Authorization': 'Bearer ' + window.remember_token
};


/**
 * Setup VueJS
 */

// Defined Window-contexted helper properties
window.EventBus = new Vue();

// Define Vue-contexted helper properties
Object.defineProperty(Vue.prototype, '$axios', { value: window.axios });
Object.defineProperty(Vue.prototype, '$bus', { value: window.EventBus });

// window.Vue.prototype.authorize = function (handler) {
//     // Additional admin privileges here.
//     let user = window.App.user;
//
//     return user ? handler(user) : false;
// };

// Register Vue components
const files = require.context('./components', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0].toLowerCase(), files(key).default))


/**
 * Setup Bootstrap-Notify
 */
// $.notifyDefaults({
//     newest_on_top: true,
//     z_index: 2038,
//     offset: {
//         y: 70,
//         x: 20
//     },
//     url_target: '_self',
//     animate: {
//         enter: 'animated fadeInRight',
//         exit: 'animated fadeOutRight'
//     },
// });
//
// window.notify = require('./mixins/notify').default;


/**
 * Setup Inputmask
 */
Inputmask().mask(document.querySelectorAll('input'));


/**
 * Setup Bootbox
 */
// window.dialog = require('./mixins/modal').default;

// (window.) alert
// window.alert = bootbox.alert;
//
// // (window.) confirm
// window.confirm = bootbox.confirm;
//
// // (window.) prompt
// window.prompt = bootbox.prompt;


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

