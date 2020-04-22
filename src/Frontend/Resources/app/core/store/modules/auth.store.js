export default {
    state: {
        token: localStorage.getItem('user-token'),
        user : null,
    },

    getters: {
        userIsLoaded({ user }) {
            return user !== null;
        },

        getAuthUserEmail({ user }) {
            return user.data.attributes.email;
        },

        getAuthUserFullname({ user }) {
            const firstname = user.data.attributes.firstname;
            const lastname = user.data.attributes.lastname;

            return `${firstname} ${lastname}`;
        },

        getAuthUserInitials({ user }) {
            return user.data.attributes.initials;
        },

        getAuthUserAvatar({ user }) {
            return user.data.attributes.avatar;
        },

        getAuthUserDarkmode({ user }) {
            return user.data.attributes.preferences.darkmode;
        },
    },

    actions: {
        setToken({ commit }, token) {
            commit('TOKEN_SET', token);
        },

        async fetchUser({ state, commit }) {
            const response = await axios.get(
                'api/v1/auth/me', {
                    headers: { Authorization: `Bearer ${state.token}` }
                }
            );

            commit('USER_SET', response.data);
        },

        async logoutUser({ state, commit }) {
            await axios.get('/api/v1/auth/logout',
                {
                    headers: { Authorization: `Bearer ${state.token}` }
                }
            );

            commit('USER_LOGOUT');
        },

        async toggleDarkmode({ state, commit }) {
            const id = state.user.data.id;
            const darkmode = state.user.data.attributes.preferences.darkmode;

            const response = await axios.patch(
                `api/v1/users/${id}`, {
                    headers: { Authorization: `Bearer ${state.token}` }
                },
                {
                    darkmode: !darkmode,
                },
            );

            commit('USER_UPDATE', response.data);
        },
    },

    mutations: {
        TOKEN_SET(state, payload) {
            localStorage.setItem('user-token', payload);
            state.token = payload;
        },

        USER_SET(state, payload) {
            state.user = payload;
        },

        USER_UPDATE(state, payload) {
            state.user = payload;
        },

        USER_LOGOUT(state) {
            localStorage.removeItem('user-token');
            state.token = null;
            state.user = null;
        },
    }
}
