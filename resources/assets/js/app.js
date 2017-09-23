/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// Pull in some templates.
import Show from './components/Show.vue';

Vue.component('show', Show);
import Shows from './components/Shows.vue';
import ShowsAdd from './components/ShowsAdd.vue';
import ShowsProcess from './components/ShowsProcess.vue';
import ShowFull from './components/ShowFull.vue';
import Default from './components/Example.vue';

Vue.component('headnav', require('./components/Headnav.vue'));

// Vue.extend(), or just a component options object.
// We'll talk about nested routes later.
const routes = [
    {
        path: '/',
        component: Shows, // TODO redirect to shows?
    },
    {
        path: '/show',
        component: Shows,
        name: 'show_list',
    },
    {
        path: '/show/add',
        component: ShowsAdd,
        name: 'show_add',
    },
    // {
    //     path: '/show/process',
    //     component: ShowsProcess,
    //     name: 'show_process',
    // },
    {
        path: '/show/:id',
        component: ShowFull,
        name: 'show',
    },
    {path: '/schedule', component: Default},
    {path: '/history', component: Default},
    // TODO Mass update, backlock overview, search, and episode management are probably just one page.
    {path: '/manage', component: Default},
    {path: '/manage/backlog', component: Default},
    {path: '/manage/search', component: Default},
    {path: '/manage/episodes', component: Default},
];
const router = new VueRouter({
    routes // short for `routes: routes`
});

const app = new Vue({
    router
}).$mount('#app');
