<template>
    <v-app-bar
        app
        clipped-left
        elevate-on-scroll
    >
        <v-app-bar-nav-icon
            @click.stop="sidebarVisibleToggle"
        />

        <v-toolbar-title>
            {{ topnav.title }}
        </v-toolbar-title>

        <v-spacer/>

        <profile-topnav/>
    </v-app-bar>
</template>

<script>
    import { mapActions } from 'vuex';
    import { ProfileTopnav } from "../../components";

    export default {
        name: "layout-default-navigation-topnav",

        components: {
            ProfileTopnav,
        },

        props: {
            topnav: {
                type: Object,
            }
        },

        methods:{
            ...mapActions(['sidebarVisibleToggle'])
        }
    }
</script>
