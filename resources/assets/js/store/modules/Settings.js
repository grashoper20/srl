import Vue from 'vue';
import * as _ from 'lodash';

const showSettingsDefaults = {
    sortField: 'show_name',
    sortDescending: 1,
    showLayout: 1,
};
const scheduleSettingsDefaults = {
    scheduleLayout: 1,
};

export default {
    namespaced: true,
    state: {
        showSettings: {},
        scheduleSettings: {},
    },
    mutations: {
        setShowSetting(state, payload) {
            state.showSettings[payload.key] = payload.value;
            Vue.localStorage.set('srlSettings', state);
        },
        setShowSettings(state, payload) {
            state.showSettings = payload;
        },
        setScheduleSetting(state, payload) {
            state.scheduleSettings[payload.key] = payload.value;
            Vue.localStorage.set('srlSettings', state);
        },
        setScheduleSettings(state, payload) {
            state.scheduleSettings = payload;
        },
    },
    actions: {
        init({commit}) {
            Vue.localStorage.addProperty('srlSettings', Object, showSettingsDefaults);
            // Ensure new properties get default values.
            let settings = _.extend({
                showSettings: showSettingsDefaults,
                scheduleSettings: scheduleSettingsDefaults,
            }, Vue.localStorage.get('srlSettings'));
            commit('setShowSettings', settings.showSettings);
            commit('setScheduleSettings', settings.scheduleSettings);
        },
    },
    getters: {
        getShowSetting: (state) => (key) => {
            return state.showSettings[key];
        },
        getScheduleSetting: (state) => (key) => {
            return state.scheduleSettings[key];
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
        getScheduleLayout: (state, getters) => {
            return getters.getScheduleSetting('scheduleLayout');
        },
    },
};
