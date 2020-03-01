export default {
    state: {
        sidebarVisibleState: {
            type: Boolean,
            default: true
        },
        sidebarMiniState: {
            type: Boolean,
            default: false
        },
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
        SIDEBAR_VISIBLE_TOGGLE: (state) => {
            state.sidebarVisibleState = !state.sidebarVisibleState;
        },

        SIDEBAR_MINI_TOGGLE: (state) => {
            state.sidebarMiniState = !state.sidebarMiniState;
        }
    }
}
