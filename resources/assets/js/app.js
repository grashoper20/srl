/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import store from './store';
import router from './router';

import Vue from 'vue';
import VModal from 'vue-js-modal';

Vue.use(VModal);

const app = new Vue({
    router,
    store,
    components: {
        'headnav': require('./components/Headnav.vue'),
    },
}).$mount('#app');
