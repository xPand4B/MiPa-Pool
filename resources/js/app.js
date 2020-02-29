import './bootstrap';
import 'es6-promise/auto';

import Vue from 'vue';
import Vuex from 'vuex';
import VueRouter from "vue-router";
import routes from "./src/routes/routes";
import App from './src/App';

// configure router
const router = new VueRouter({
    mode: 'hash',
    routes,
});

// Plugins
import store from './src/store';
import vuetify from "./src/plugins/vuetify";
import GlobalComponents from "./src/globalComponents";

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
