import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// Pull in some templates.
import Default from '../components/Page/Example.vue';
import History from '../components/Page/History.vue';
import Logs from '../components/Page/Logs.vue';
import NotFound from '../components/Page/NotFound.vue';
import Schedule from '../components/Page/Schedule.vue';
import ShowFull from '../components/Page/ShowFull.vue';
import Shows from '../components/Page/Shows.vue';
import ShowsAdd from '../components/Page/ShowsAdd.vue';
import Status from '../components/Page/Status.vue';

export default new VueRouter({
    mode: 'history',
    base: window.srl.settings.basePath,
    routes: [
        {path: '*', component: NotFound},
        {
            path: '/',
            component: Shows, // TODO redirect to shows?
            alias: '/show',
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
        {
            path: '/schedule',
            component: Schedule,
            name: 'schedule',
        },
        {
            path: '/history',
            component: History,
        },
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
        {
            path: '/tools/logs',
            component: Logs,
            name: 'tools_logs',
        },
        {
            path: '/tools/status',
            component: Status,
            name: 'tools_status',
        },
    ]
});
