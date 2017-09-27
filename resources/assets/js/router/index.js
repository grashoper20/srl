import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// Pull in some templates.
import Shows from '../components/Shows.vue';
import ShowsAdd from '../components/ShowsAdd.vue';
import ShowFull from '../components/ShowFull.vue';
import Default from '../components/Example.vue';

export default new VueRouter({
    routes: [
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
        {
            path: '/show/:id',
            component: ShowFull,
            name: 'show',
        },
        {path: '/schedule', component: Default},
        {path: '/history', component: Default},
        // TODO Mass update, backlog overview, search, and episode management are probably just one page.
        {
            path: '/manage',
            component: Default,
            name: 'manage_update',
        },
        {
            path: '/manage/process',
            component: Default,
            name: 'manage_process',
        },
        {
            path: '/manage/backlog',
            component: Default,
            name: 'manage_backlog',
        },
        {
            path: '/manage/search',
            component: Default,
            name: 'manage_search',
        },
        {
            path: '/manage/episodes',
            component: Default,
            name: 'manage_episodes',
        },
    ]
});
