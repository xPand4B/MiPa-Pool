<template>
    <v-layout :justify-center="justifyCenter">
        <v-list>
            <v-list-item>
                <v-list-item-action>
                    <v-switch
                        v-model="$vuetify.theme.dark"
                        @change="toggleDarkMode"
                        :color="switchColor"
                    />
                </v-list-item-action>
                <v-list-item-title>{{ title }}</v-list-item-title>
            </v-list-item>
        </v-list>
    </v-layout>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {
        name: "darkmode-switch",

        props: {
            title: {
                type: String,
                default: 'Dark Theme'
            },
            switchColor: {
                type: String,
                default: 'purple'
            },
            justifyCenter: {
                type: Boolean,
                default: false
            }
        },

        methods: {
            ...mapActions(['toggleDarkmode']),

            toggleDarkMode() {
                this.$store.dispatch('toggleDarkmode');
            },
        },
    }
</script>
