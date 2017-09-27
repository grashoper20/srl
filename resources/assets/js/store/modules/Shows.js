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
        }
    },
    actions: {
        sync({commit}) {
            axios.get('/api/show')
                .then(response => {
                    commit('set', response.data);
                })
                .catch(e => {
                    // this.errors.push(e);
                })
        },
        find({state, commit}, id) {
            return new Promise((resolve, reject) => {
                let show = state.list.find(show => show.show_id == id);
                if (typeof show !== 'undefined') {
                    console.log('optimistically loaded from full list.');
                    resolve(show);
                    return;
                }
                axios.get('/api/show/' + id)
                    .then(response => {
                        commit('push', response.data);
                        resolve(response.data);
                    })
                    .catch(e => {
                        console.error(e);
                        reject(e);
                    });
            });
        },
    },
    getters: {
        shows: state => {
            return state.list.filter(show => !parseInt(show.anime));
        },
        anime: state => {
            return state.list.filter(show => parseInt(show.anime));
        },
    },
};