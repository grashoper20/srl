import axios from 'axios';

export default {
    namespaced: true,
    state: {
        stats: [],
    },
    mutations: {
        set(state, stats) {
            state.stats = stats;
        },
        push(state, stat) {
            state.stats[stat.show_id] = stat;
        },
    },
    actions: {
        sync({commit}) {
            axios.get('/api/stats')
                .then(response => {
                    commit('set', response.data);
                })
                .catch(e => {
                    // this.errors.push(e);
                })
        },
        find({state, commit}, id) {
            return new Promise((resolve, reject) => {
                let stat = state.stats[id];
                if (typeof stat !== 'undefined') {
                    resolve(stat);
                }
                else {
                    axios.get('/api/show/' + id + '/stats')
                        .then(response => {
                            let stats = [];
                            response.data.forEach((stat) => stats[stat.show_id] = stat);
                            commit('push', stats);
                            resolve(stats);
                        })
                        .catch(e => {
                            console.error(e);
                            reject(e);
                        });
                }
            });
        },
    },
    getters: {},
};