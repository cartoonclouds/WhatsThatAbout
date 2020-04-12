/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/**
 * Include bootstrap material design
 */
$(document).ready(function() { $('body').bootstrapMaterialDesign(); });


/**
 * Bootstrap-Notify default settings
 */
$.notifyDefaults({
    newest_on_top: true
});

/**
 * Initialise Inputmask
 */
Inputmask().mask(document.querySelectorAll('input'));


/**
 * Axios default settings
 */
window.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.csrfToken,
    'X-Requested-With': 'XMLHttpRequest',
    'User-Agent': 'WhatsThatAbout/1.0',
    'Accept': 'application/json',
};


global.animateCSS = function(element, animationName, callback) {
    const node = document.querySelector(element)
    node.classList.add('animated', animationName)

    function handleAnimationEnd() {
        node.classList.remove('animated', animationName)
        node.removeEventListener('animationend', handleAnimationEnd)

        if (typeof callback === 'function') callback()
    }

    node.addEventListener('animationend', handleAnimationEnd)
}



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
import Clipboard from 'v-clipboard'
import VueHotkey from 'v-hotkey'

Vue.use(Clipboard);
Vue.use(VueHotkey);
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

// Create a global Vue instance
global.$Vue = new Vue({
    el: '#app',
});

import WTAApp from './api';

global.WTAApp = WTAApp;
