import axios from 'axios';

export default {
    namespaced: true,
    state: {
        list: [],
    },
    mutations: {
        set(state, shows) {
            state.list = shows;
        },
        push(state, show) {
            state.list.push(show);
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
        },
        find({state, commit}, id) {
            return new Promise((resolve, reject) => {
                let show = state.list.find(show => show.indexer_id === id);
                if (typeof show !== 'undefined') {
                    console.log('cached load');
                    resolve(show);
                } else {
                    axios.get('/api/show/' + id)
                        .then(response => {
                            let show = response.data;
                            commit('push', show);
                            resolve(show);
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
            return state.list;
        },
        getAnime: (state) => {
            return state.list
                .filter(show => show.anime);
        },
        getShows: (state) => {
            return state.list
                .filter(show => !show.anime);
        },
        getShowById: (state, getters) => (id) => {
            let show = state.list.find(show => show.indexer_id === id);
            return show === undefined ? {} : show;
        },
    },
};
