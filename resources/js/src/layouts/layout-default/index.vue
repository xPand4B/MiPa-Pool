<template>
    <div>
        <layout-default-navigation
            :topnav="topnav"
            :sidebar="sidebar"
        />
        <layout-default-content/>

        <layout-default-footer/>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    import LayoutDefaultContent from './content';
    import LayoutDefaultNavigation from './navigation';
    import LayoutDefaultFooter from './footer';

    export default {
        name: 'layout-default',

        components: {
            LayoutDefaultContent,
            LayoutDefaultNavigation,
            LayoutDefaultFooter,
        },

        beforeCreate() {
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
                    { title: 'Menus', path: 'user.index', icon: 'mdi-food', color: 'orange' },
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

            topnav: {
                title: 'MiPa-Pool',
            },
        }),

        computed: {
            ...mapGetters({
                darkmode: 'getCurrentUserDarkmode'
            }),
        },
    }
</script>
