import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

// Pull in some templates.
import Shows from '../components/Shows.vue';
import ShowsAdd from '../components/ShowsAdd.vue';
import ShowsProcess from '../components/ShowsProcess.vue';
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
            path: '/show/process',
            component: ShowsProcess,
            name: 'show_process',
        },
        {
            path: '/show/:id',
            component: ShowFull,
            name: 'show',
        },
        {path: '/schedule', component: Default},
        {path: '/history', component: Default},
        // TODO Mass update, backlog overview, search, and episode management are probably just one page.
        {path: '/manage', component: Default},
        {path: '/manage/backlog', component: Default},
        {path: '/manage/search', component: Default},
        {path: '/manage/episodes', component: Default},
    ]
});
