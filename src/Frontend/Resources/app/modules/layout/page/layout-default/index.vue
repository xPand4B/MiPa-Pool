<template>
    <div>
        <layout-component-topbar :topbar="topbar"/>
        <layout-component-sidebar :sidebar="sidebar"/>

        <v-content>
            <v-container
                    class="fill-height"
                    fluid
            >
                <v-row>
                    <v-container>
                        <router-view></router-view>
                    </v-container>
                </v-row>
            </v-container>
        </v-content>

        <layout-component-footer/>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import {
        LayoutComponentTopbar,
        LayoutComponentSidebar,
        LayoutComponentFooter,
    } from '../../index';

    export default {
        name: 'layout-page-default',

        components: {
            LayoutComponentTopbar,
            LayoutComponentSidebar,
            LayoutComponentFooter,
        },

        beforeCreate() {
            // TODO: Get darkmode from cookie/local storage?
            // this.$vuetify.theme.dark = this.darkmode;
            this.$store.dispatch('fetchUser').then(() => {
                this.$vuetify.theme.dark = this.darkmode;
            });
        },

        data: () => ({
            sidebar: {
                avatarBackground: 'indigo',
                activeClass: 'indigo',
                items: [
                    { title: 'Home', path: 'order.index', icon: 'mdi-home', color: 'red' },
                    null,
                    { title: 'Orders', path: 'order.index', icon: 'mdi-cart', color: 'green' },
                    { title: 'Menus', path: 'profile.index', icon: 'mdi-food', color: 'orange' },
                ],
                appendItems: [
                    {
                        title: 'Support me',
                        path: null,
                        to: 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=F8EMZ2C75K4TA',
                        icon: 'fab fa-paypal',
                        iconStyle: 'color: #3A7BBF'
                    },
                    {
                        title: '©2020 by Eric Heinzl',
                        path: 'https://xpand4b.de',
                        icon: 'fas fa-heart',
                        iconStyle: 'color: #C62828'
                    },
                ],
            },

            topbar: {
                title: 'MiPa-Pool',
            },
        }),

        computed: {
            ...mapGetters({
                darkmode: 'getAuthUserDarkmode'
            }),
        },
    }
</script>
