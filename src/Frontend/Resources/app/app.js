// Base configurations
import './bootstrap';
import 'es6-promise/auto';
// Vue stuff
import Vue from 'vue';
import router from './core/Router';
import App from './core/App';
// Plugins
import store from './store';
import vuetify from './core/plugins/vuetify';
import GlobalComponents from './components/global';

Vue.use(GlobalComponents);

store.dispatch(
    'attempt', localStorage.getItem('jwt')
).then(() => {
    new Vue({
        el: '#app',
        components: { App },
        router,
        store,
        vuetify,
    }).$mount('#app');
});
