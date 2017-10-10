import Vue from 'vue';
import * as _ from 'lodash';

const showSettingsDefaults = {
    sortField: 'show_name',
    sortDescending: 1,
    showLayout: 1,
};

export default {
    namespaced: true,
    state: {
        showSettings: {}
    },
    mutations: {
        setShowSetting(state, payload) {
            state.showSettings[payload.key] = payload.value;
            Vue.localStorage.set('srlSettings', state.showSettings);
        },
        setShowSettings(state, payload) {
            state.showSettings = payload;
        },
    },
    actions: {
        init({commit}) {
            Vue.localStorage.addProperty('srlSettings', Object, showSettingsDefaults);
            // Ensure new properties get default values.
            let settings = _.extend(showSettingsDefaults, Vue.localStorage.get('srlSettings'));
            commit('setShowSettings', settings);
        },
    },
    getters: {
        getShowSetting: (state) => (key) => {
            return state.showSettings[key];
        },
        getShowSortField: (state, getters) => {
            return getters.getShowSetting('sortField');
        },
        getShowSortDescending: (state, getters) => {
            return getters.getShowSetting('sortDescending');
        },
        getShowLayout: (state, getters) => {
            return getters.getShowSetting('showLayout');
        },
    },
};
