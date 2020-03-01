export default {
    state: {
        currentUser : null
    },

    getters: {
        getCurrentUser: ({ currentUser }) =>
            (currentUser),

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
    },

    actions: {
        async fetchUser({ commit }) {
            const id = '08a04949-e402-461c-abc9-c1f0a9e74b60';

            const response = await axios.get(
                'api/v1/users/'+id
            );

            commit('USER_SET', response.data);
        }
    },

    mutations: {
        USER_SET: (state, payload) => {
            state.currentUser = payload;
        }
    }
}
