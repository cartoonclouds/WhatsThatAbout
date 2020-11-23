/**
 * Lo-dash
 * https://lodash.com/docs/4.17.15
 */
window._ = require('lodash');


/**
 * jQuery
 * https://api.jquery.com/
 */
window.$ = window.jQuery = $ = require('jquery');


/**
 * Popper.js 2.5.4
 * https://popper.js.org/docs/v1/
 */
import { createPopper} from '@popperjs/core';

window.createPopper = createPopper;

/**
 * Bootstrap 5.0
 * https://v5.getbootstrap.com/docs/5.0/
 */
// window.bootstrap = require('bootstrap');


/**
 * Bootstrap-Notify - Growl message alert
 * http://bootstrap-notify.remabledesigns.com/
 */
// require('bootstrap-notify');


/**
 * Axios
 * https://github.com/axios/axios
 */
import axios from 'axios';

window.axios = axios;


/**
 * Inputmask
 * https://github.com/RobinHerbots/Inputmask
 */
import Inputmask from 'inputmask/dist/inputmask';

window.Inputmask = Inputmask;


/**
 * DataTables
 * https://yajrabox.com/docs/laravel-datatables/
 * https://datatables.yajrabox.com/starter
 * https://datatables.net/
 */
require('datatables.net');
require('datatables.net-dt');
require('datatables.net-buttons');
require('datatables.net-buttons/js/buttons.colVis.js');
require('datatables.net-buttons/js/buttons.html5.js');
require('datatables.net-buttons/js/buttons.flash.js');
require('datatables.net-buttons/js/buttons.print.js');

/**
 * VueJS 2.*
 * https://vuejs.org/v2/guide/
 */
import Vue from 'vue';

window.Vue = Vue;


/**
 * Bootbox - alert/prompt replacement
 * http://bootboxjs.com/documentation.html
 */
// import bootbox from 'bootbox';
//
// window.bootbox = bootbox;


/**
 * General Helper Functions/Mixins
 */
require('./mixins/helpers');

require('./mixins/layout');

window.animateCSS = require('./mixins/animateCSS');
