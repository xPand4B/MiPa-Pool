import router from '../../core/Router';
import vuetify from '../../core/plugins/vuetify';

const tokenStorageName = 'jwt';

const routes = {
    login:  'api/v1/auth/login',
    logout: 'api/v1/auth/logout',
    me:     'api/v1/auth/me',
};

const pages = {
    home: 'order.index',
    login: 'auth.login',
};

export default {
    state: {
        token: localStorage.getItem(tokenStorageName),
        user : null,
    },

    getters: {
        isAuthenticated (state) {
            return !!(state.token && state.user);
        },

        getAuthUserAttributes({ user }) {
            return user.data.attributes;
        },

        userIsLoaded({ user }) {
            return user !== null;
        },
    },

    actions: {
        async login({ commit, dispatch }, credentials) {
            let response = await axios.post(
                routes.login, credentials
            );

            let token = response.data.data.attributes.access_token;

            dispatch('attempt', token);

            await router.push({
                name: pages.home
            });
        },

        async attempt({ state, commit, dispatch }, token) {
            if (token) {
                commit('USER_TOKEN_SET', token);
            }

            if (! state.token || state.token === 'null') {
                return;
            }

            dispatch('fetchMe');
        },

        async fetchMe({ state, commit }) {
            // user already set
            if (state.user !== null) {
                return;
            }

            axios.defaults.headers.common['Authorization'] = `Bearer ${state.token}`;

            try {
                let response = await axios.get(routes.me);

                let user = response.data;

                commit('USER_SET', user);

                vuetify.framework.theme.dark = user.data.attributes.preferences.darkmode;

            } catch (e) {
                commit('USER_TOKEN_SET', null);
                commit('USER_SET', null);

                await router.push({
                    name: pages.login
                });
            }
        },

        async logout({ commit }) {
            await axios.get(routes.logout);

            vuetify.framework.theme.dark = false;
            axios.defaults.headers.common['Authorization'] = null;

            await router.push({
                name: pages.login
            });

            commit('USER_LOGOUT');
        },

        async toggleDarkmode({ state, commit }) {
            let darkmode = state.user.data.attributes.preferences.darkmode;

            let response = await axios.patch(routes.me, {
                headers: { Authorization: `Bearer ${state.token}` },
                darkmode: !darkmode,
            });

            commit('USER_UPDATE', response.data);
        },
    },

    mutations: {
        USER_TOKEN_SET(state, payload) {
            localStorage.setItem(tokenStorageName, payload);
            state.token = payload;
        },

        USER_SET(state, payload) {
            state.user = payload;
        },

        USER_UPDATE(state, payload) {
            state.user = payload;
        },

        USER_LOGOUT(state) {
            localStorage.removeItem(tokenStorageName);
            state.token = null;
            state.user = null;
        },
    }
}
