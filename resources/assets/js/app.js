/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import components from './components';
import router from './router';
import store from './store';
import Vue from 'vue';

import VModal from 'vue-js-modal';
Vue.use(VModal);

import VLocalStorage from 'vue-localstorage';
Vue.use(VLocalStorage);

import {ServerTable, ClientTable} from 'vue-tables-2';
Vue.use(ServerTable, {});
Vue.use(ClientTable, {
    filterable: false,
    skin: '',
});

const app = new Vue({
    router,
    store,
    components: components,
    mounted() {
        let ShowPoller = setInterval(() => {
            this.$store.dispatch('shows/sync');
            console.log('running poller');
        }, 60000);
        // Preload show list.
        setTimeout(() => {
            // This check will show false positive if there is only one show
            // but the fetch will be cheap so not sure it matters.
            if (this.$store.state.shows.list.length <= 1) {
                this.$store.dispatch('shows/sync');
            }
        }, 1000);
        this.$store.dispatch('settings/init');
    },
}).$mount('#app');
