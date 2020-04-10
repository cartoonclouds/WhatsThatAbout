/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/**
 * Bootstrap-Notify default settings
 */
$.notifyDefaults({
    newest_on_top: true
});


/**
 * Axios default settings
 */
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.csrfToken,
    'X-Requested-With': 'XMLHttpRequest',
    'User-Agent': 'WhatsThatAbout/1.0',
    'Accept': 'application/json',
};


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


/* Auto Vue Components in ./vuejs/components
 *
 * if vue-loader >= 14 & not loading components change "pages(key)" to "pages(key).default"
 */
const files = require.context('./vuejs/components', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Load libraries
Vue.use(moment, 'moment');

// Load mixins
const CurrencyHelpers  = require('./vuejs/mixins/currency');
const MathsHelpers     = require('./vuejs/mixins/maths');
const StringHelpers    = require('./vuejs/mixins/stringManipulation');
const DateTimeHelpers  = require('./vuejs/mixins/dateTime');

Vue.use(CurrencyHelpers);
Vue.use(DateTimeHelpers);
Vue.use(MathsHelpers);
Vue.use(StringHelpers);

// Define helper properties
Object.defineProperty(Vue.prototype, '$axios', { value: window.axios });
// Object.defineProperty(Vue.prototype, '$user', { value: window.user });

// Create a global Vue instance
global.$app = new Vue({
    el: '#app',
});
