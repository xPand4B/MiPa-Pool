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
                    <router-view></router-view>
                </v-col>
            </v-row>
        </v-container>
    </v-content>
</template>

<script>
    export default {
        name: 'layout-page-auth',
    }
</script>

<style>
    html{
        overflow: hidden;
    }
    /* TODO: Cache daily image as asset - automated job */
    /*.authBackground{*/
    /*    background-image: url(https://source.unsplash.com/1280x720/daily?programming);*/
    /*    background-size: cover;*/
    /*    background-position: center center;*/
    /*    background-repeat: no-repeat;*/
    /*}*/
</style>