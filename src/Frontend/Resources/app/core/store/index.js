import Vue from 'vue';
import Vuex from 'vuex';
import sidebar from './modules/sidebar.store';
import auth from './modules/auth.store';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        sidebar,
        auth,
    },

    state: {
        //
    },

    getters: {
        //
    },

    actions: {
        //
    },

    mutations: {
        //
    },
});
