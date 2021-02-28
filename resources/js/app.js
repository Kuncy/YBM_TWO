/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import store from './store/index'
import VueSweetalert2 from 'vue-sweetalert2';
import VueAxios from 'vue-axios';
import axios from 'axios';
import 'sweetalert2/dist/sweetalert2.min.css';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(VueAxios, axios);
Vue.use(VueSweetalert2);
Vue.component('searchbar', require('./components/Searchbar'));
Vue.component('product', require('./components/Product'))
Vue.component('products', require('./components/Products'))
Vue.component('products2', require('./components/Products2'))

const app = new Vue({
    el: '#app',
    store
});
