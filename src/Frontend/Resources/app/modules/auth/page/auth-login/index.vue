<template>
    <div>
        <v-card class="elevation-12" shaped>
            <v-toolbar
                    color="primary"
                    dark
                    flat
            >
                <v-tabs
                        v-model="tab"
                        fixed-tabs
                        dark
                >
                    <v-tab>
                        Login
                    </v-tab>
                    <v-tab>
                        Register
                    </v-tab>
                </v-tabs>
                <v-spacer/>
            </v-toolbar>

            <v-card-text>
                <v-tabs-items v-model="tab">
                    <v-tab-item>
                        <auth-component-login/>
                    </v-tab-item>

                    <v-tab-item>
                        <auth-component-register/>
                    </v-tab-item>
                </v-tabs-items>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
    import {
        AuthComponentLogin,
        AuthComponentRegister,
    } from "../../index";

    export default {
        name: 'auth-page-login',

        components: {
            AuthComponentLogin,
            AuthComponentRegister,
        },

        data () {
            return {
                tab: null,
            }
        },
    }
</script>