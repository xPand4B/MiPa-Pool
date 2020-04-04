import Vue from 'vue';
import Vuex from 'vuex';
import sidebar from './modules/sidebar.store';
import currentUser from './modules/currentUser.store';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        sidebar,
        currentUser,
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
