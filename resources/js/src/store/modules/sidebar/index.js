export default {
    state: {
        sidebarVisibleState: (window.innerWidth > 960),
        sidebarMiniState: false,
    },

    getters: {
        getSidebarVisible: ({ sidebarVisibleState }) =>
            (sidebarVisibleState),

        getSidebarMini: ({ sidebarMiniState }) =>
            (sidebarMiniState),
    },

    actions: {
        sidebarVisibleToggle({ commit }) {
            commit('SIDEBAR_VISIBLE_TOGGLE');
        },

        sidebarMiniToggle({ commit }) {
            commit('SIDEBAR_MINI_TOGGLE');
        },
    },

    mutations: {
        SIDEBAR_VISIBLE_TOGGLE: (state, payload) => {
            state.sidebarVisibleState = !state.sidebarVisibleState;
        },

        SIDEBAR_MINI_TOGGLE: (state, payload) => {
            state.sidebarMiniState = !state.sidebarMiniState;
        },
    }
}
