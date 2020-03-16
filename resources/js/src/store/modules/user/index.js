export default {
    state: {
        currentUser : null,
    },

    getters: {
        userIsLoaded: ({ currentUser }) => {
            return currentUser !== null;
        },

        getCurrentUserEmail: ({ currentUser }) =>
            (currentUser.data.attributes.email),

        getCurrentUserFullname: ({ currentUser }) => {
            const firstname = currentUser.data.attributes.firstname;
            const lastname = currentUser.data.attributes.lastname;

            return `${firstname} ${lastname}`;
        },

        getCurrentUserInitials: ({ currentUser }) =>
            (currentUser.data.attributes.initials),

        getCurrentUserAvatar: ({ currentUser }) =>
            (currentUser.data.attributes.avatar),

        getCurrentUserDarkmode: ({ currentUser }) =>
            (currentUser.data.attributes.preferences.darkmode),
    },

    actions: {
        async fetchUser({ commit }) {
            const id = '7aabd16d-443f-4ff5-99ab-7885db58658a';

            const response = await axios.get(
                `api/v1/users/${id}`
            );

            commit('USER_SET', response.data);
        },

        async toggleDarkmode({ state, commit }) {
            const darkmode = state.currentUser.data.attributes.preferences.darkmode;
            const id = '7aabd16d-443f-4ff5-99ab-7885db58658a';

            const response = await axios.patch(
                `api/v1/users/${id}`, {
                    darkmode: !darkmode,
                }
            );

            commit('USER_UPDATE', response.data);
        }
    },

    mutations: {
        USER_SET: (state, payload) => {
            state.currentUser = payload;
        },

        USER_UPDATE: (state, payload) => {
            state.currentUser = payload;
        },
    }
}
