import './bootstrap';
import 'es6-promise/auto';

import Vue from 'vue';
import Vuex from 'vuex';
import VueRouter from "vue-router";
import routes from "./js/routes/routes";
import App from './js/App';

// configure router
const router = new VueRouter({
    mode: 'hash',
    routes,
});

// Plugins
import store from './js/store';
import vuetify from "./js/plugins/vuetify";
import GlobalComponents from "./js/globalComponents";

Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(GlobalComponents);

const vm = new Vue({
    el: '#app',
    components: { App },
    router,
    store,
    vuetify,
}).$mount('#app');
