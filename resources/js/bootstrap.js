
/**
 * Lo-dash
 */
import _ from 'lodash';

window._ = _;


/**
 * Popper.js
 */
import Popper from 'popper.js';

window.Popper = Popper;


/**
 * jQuery
 */
import jquery from 'jquery';

window.$ = window.jQuery = jquery;


/**
 * Bootstrap
 */
window.bootstrap = require('bootstrap');


/**
 * Bootstrap-Notify - Growl message alert
 * http://bootstrap-notify.remabledesigns.com/
 */
require('bootstrap-notify');


/**
 * Axios
 */
import axios from 'axios';

window.axios = axios;


/**
 * Inputmask
 */
import Inputmask from 'inputmask/dist/inputmask';

window.Inputmask = Inputmask;


/**
 * VueJS 2.* -
 */
import Vue from 'vue';

window.Vue = Vue;


/**
 * Select2
 * https://select2.org/
 *
 * The jQuery replacement for select boxes. Select2 gives you a customizable select box with support
 * for searching, tagging, remote data sets, infinite scrolling, and many other highly used options.
 */
// require('select2');

require('select2/dist/js/select2.full');

/**
 * Bootbox - alert/prompt replacement
 * http://bootboxjs.com/
 */
import bootbox from 'bootbox';

window.bootbox = bootbox;


/**
 * General Helper Functions/Mixins
 */
require('./mixins/helpers');

require('./mixins/layout');

window.animateCSS = require('./mixins/animateCSS');
