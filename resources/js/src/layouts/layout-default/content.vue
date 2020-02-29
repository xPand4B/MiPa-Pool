<template>
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
</template>

<script>
    export default {
        name: 'layout-default-content',
    }
</script>
