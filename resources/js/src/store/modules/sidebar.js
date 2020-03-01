export default {
    state: {
        sidebarVisibleState: null,
        sidebarMiniState: false,
    },

    getters: {
        getSidebarVisible: (state) =>
            (state.sidebarVisibleState),

        getSidebarMini: (state) =>
            (state.sidebarMiniState),
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
        }
    }
}
