<template>
    <v-list-item
        @click.left="sidebarMiniToggle"
        :class="spacing"
    >
        <v-list-item-icon>
            <div v-if="getSidebarMini">
                <v-icon v-text="iconClosed"/>
            </div>
            <div v-else>
                <v-icon v-text="iconOpen"/>
            </div>
        </v-list-item-icon>

        <v-list-item-content :class="getItemContentClass">
            <v-list-item-title>
                {{ title }}
            </v-list-item-title>
        </v-list-item-content>
    </v-list-item>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "layout-default-navigation-sidebar-toggle-mini",

        props: {
            title: {
                type: String,
                default: 'Toggle menu'
            },
            iconOpen: {
                type: String,
                default: 'mdi-chevron-left'
            },
            iconClosed: {
                type: String,
                default: 'mdi-chevron-right'
            },
            muted: {
                type: Boolean,
                default: false
            },
            spacing: {
                type: String,
                default: 'my-3'
            },
        },

        methods: {
            ...mapActions(['sidebarMiniToggle'])
        },

        computed: {
            ...mapGetters(['getSidebarMini']),

            getItemContentClass() {
                if (this.muted) {
                    return 'grey--text'
                }
            },
        }
    }
</script>
