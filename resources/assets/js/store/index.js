import Vue from 'vue'
import Vuex from 'vuex'
import Shows from './modules/Shows';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
  modules: {
    shows: Shows,
  },
  actions: {
  },
  strict: debug,
})
