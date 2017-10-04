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
        this.$store.dispatch('settings/syncFromStorage');
    }
}).$mount('#app');
