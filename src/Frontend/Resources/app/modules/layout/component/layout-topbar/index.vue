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
            {{ topbar.title }}
        </v-toolbar-title>

        <v-spacer/>

        <profile-component-topbar/>
    </v-app-bar>
</template>

<script>
    import { mapActions } from 'vuex';
    import { ProfileComponentTopbar } from "../../../profile";

    export default {
        name: "layout-component-topbar",

        components: {
            ProfileComponentTopbar,
        },

        props: {
            topbar: {
                type: Object,
            },
        },

        methods:{
            ...mapActions(['sidebarVisibleToggle'])
        },
    }
</script>
