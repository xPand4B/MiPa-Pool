<template>
    <v-content class="authBackground">
        <v-container
            class="fill-height"
            fluid
        >
            <v-row
                align="center"
                justify="center"
            >
                <v-col
                    cols="12"
                    sm="8"
                    md="4"
                >
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
                                    <auth-login/>
                                </v-tab-item>
                                <v-tab-item>
                                    <auth-register/>
                                </v-tab-item>

                            </v-tabs-items>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-content>
</template>

<script>
    import AuthLogin from "../../pages/auth/Login";
    import AuthRegister from "../../pages/auth/Register";
    import LayoutDefaultFooter from '../layout-default/layout-default-footer';

    export default {

        components: {
            AuthLogin,
            AuthRegister,
            LayoutDefaultFooter,
        },

        data () {
            return {
                tab: null,
            }
        },
    }
</script>

<style>
    html{
        overflow: hidden;
    }
    .authBackground{
        background-image: url(https://source.unsplash.com/1280x720/daily?programming);
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
    }
</style>