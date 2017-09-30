import axios from 'axios';

export default {
    namespaced: true,
    state: {
        list: [],
        stats: [],
    },
    mutations: {
        set(state, shows) {
            state.list = shows;
        },
        push(state, show) {
            state.list.push(show);
        },
        setStats(state, stats) {
            state.stats = stats;
        },
        pushStat(state, stat) {
            state.stats[stat.indexer_id] = stat;
        },
    },
    actions: {
        sync({commit}) {
            axios.get('/api/show')
                .then(response => {
                    commit('set', response.data);
                })
                .catch(e => {
                    console.error(e);
                });
            axios.get('/api/stats')
                .then(response => {
                    commit('setStats', response.data);
                })
                .catch(e => {
                    console.error(e);
                });
        },
        find({state, commit}, id) {
            return new Promise((resolve, reject) => {
                let show = state.list.find(show => show.indexer_id == id);
                if (typeof show !== 'undefined') {
                    console.log('cached load');
                    resolve(show);
                } else {
                    axios.get('/api/show/' + id)
                        .then(response => {
                            let show = response.data;
                            commit('push', show);
                            axios.get('/api/show/' + id)
                                .then(response => {
                                    show.stats = response.data;
                                    commit('pushStat', response.data);
                                    resolve(show);
                                });
                        })
                        .catch(e => {
                            console.error(e);
                            reject(e);
                        });
                }
            });
        },
    },
    getters: {
        getAllShows: (state) => {
            console.log('loading shows');
            let shows = state.list,
                stat_index = [];
            // Build a temporary sparse array indexing stats.
            state.stats.forEach((stat, index) => {
                stat_index[stat.indexer_id] = index
            });

            shows.forEach(show => {
                show.stats = state.stats[stat_index[show.indexer_id]];
            });
            return shows;
        },
        getAnime: (state, getters) => {
            return getters.getAllShows
                .filter(show => !!parseInt(show.anime));
        },
        getShows: (state, getters) => {
            return getters.getAllShows
                .filter(show => !parseInt(show.anime));
        },
        getShowById: (state, getters) => (id) => {
            let show = state.list.find(show => show.indexer_id == id);
            if (show === undefined) return {};
            show.stats = state.stats[id];
            return show;
        },
    },
};
