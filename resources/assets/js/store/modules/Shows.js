import axios from 'axios';

function sortHelper(list, field, descending) {
    try {
        return list.sort(function (a, b) {
            let comp_strings = [];
            [a[field], b[field]].forEach((x) => {
                // TODO Logic to converge to comparable strings.
                if (typeof x === 'undefined' || x === null) {
                    x = '';
                }
                comp_strings.push(x);
            });

            let comparison = comp_strings[0]
                .localeCompare(comp_strings[1]);
            if (comparison === 0 && field !== 'show_name') {
                comparison = a.show_name
                    .localeCompare(b.show_name);
            }
            return (descending ? comparison * -1 : comparison);
        });
    }
    catch (e) {
        console.error(e);
        return [];
    }
}

export default {
    namespaced: true,
    state: {
        list: [],
        sortField: 'show_name',
        sortDescending: false,
    },
    mutations: {
        set(state, shows) {
            state.list = shows;
        },
        push(state, show) {
            state.list.push(show);
        },
        sort(state, payload) {
            state.sortField = payload.field;
            state.sortDescending = payload.descending;
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
            return sortHelper(
                state.list.filter(show => !parseInt(show.anime)),
                state.sortField,
                state.sortDescending);
        },
        anime: state => {
            return sortHelper(
                state.list.filter(show => parseInt(show.anime)),
                state.sortField,
                state.sortDescending);
        },
    },
};