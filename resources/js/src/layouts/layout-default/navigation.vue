<template>
    <div>
        <layout-default-navigation-topnav
            :topnav="topnav"
        />

        <layout-default-navigation-sidebar
            :sidebar="sidebar"
        />
    </div>
</template>

<script>
    import LayoutDefaultNavigationTopnav from './topnav';
    import LayoutDefaultNavigationSidebar from "./sidebar";

    export default {
        name: 'layout-default-navigation',

        components: {
            LayoutDefaultNavigationSidebar,
            LayoutDefaultNavigationTopnav
        },

        props: {
            title: {
                type: String,
            },
            sidebar: {
                type: Object
            },
            topnav: {
                type: Object
            }
        }
    }
</script>
