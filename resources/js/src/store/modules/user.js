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
            (currentUser.data.attributes.darkmode),
    },

    actions: {
        async fetchUser({ commit }) {
            const id = '038e1330-fcd8-482b-8eaa-6cfa6199c38b';

            const response = await axios.get(
                `api/v1/users/${id}`
            );

            commit('USER_SET', response.data);
        },

        async toggleDarkmode({ state, commit }) {
            const darkmode = state.currentUser.data.attributes.darkmode;
            const id = '038e1330-fcd8-482b-8eaa-6cfa6199c38b?darkmode';

            const response = await axios.patch(
                `api/v1/users/${id}`, {
                    darkmode: !darkmode
                }
            );

            commit('TOGGLE_DARKMODE', response.data);
        }
    },

    mutations: {
        USER_SET: (state, payload) => {
            state.currentUser = payload;
        },

        TOGGLE_DARKMODE: (state, payload) => {
            state.currentUser.data.attributes.darkmode = payload.data.attributes;
        }
    }
}
