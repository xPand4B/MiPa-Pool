import Vue from 'vue';
import Vuex from 'vuex';
import sidebarStore from './modules/sidebar';
import userStore from './modules/user';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        sidebarStore,
        userStore
    }
});
