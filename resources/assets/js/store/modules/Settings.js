
export default {
    namespaced: true,
    state: {
        settings: {}
    },
    mutations: {
        set(state, payload) {
            state.settings[payload.key] = payload.value;
            localStorage.setItem('srlSettings', JSON.stringify(state.settings));
        },
        setAll(state, payload) {
            state.settings = payload;
        },
    },
    actions: {
        syncFromStorage({commit}) {
            let localSettings = localStorage.getItem('srlSettings');
            if (localSettings) {
                commit('setAll', JSON.parse(localSettings));
            }
        },
    },
    getters: {
        getSetting: (state) => (key) => {
            return state.settings[key];
        },
    },
};
