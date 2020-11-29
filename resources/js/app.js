
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
 * Setup Bootstrap-Notify
 */
$.notifyDefaults({
    newest_on_top: true,
    z_index: 2038,
    offset: {
        y: 70,
        x: 20
    },
    url_target: '_self',
    animate: {
        enter: 'animated fadeInRight',
        exit: 'animated fadeOutRight'
    },
});

window.notify = require('./mixins/notify').default;



/**
 * Setup Bootbox
 */
// window.dialog = require('./mixins/modal').default;



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

require('./components/form/image-upload');

require('./components/form/delete-button');
