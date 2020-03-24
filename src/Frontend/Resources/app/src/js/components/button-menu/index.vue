<template>
    <v-menu
        v-model="showMenu"
        :close-on-content-click="false"
        :transition="transition"
        :nudge-width="nudgeWidth"
        :offset-x="offsetX"
        :offset-y="offsetY"
    >
        <!-- Topnav icon -->
        <template v-slot:activator="{ on }">
            <v-btn
                v-on="on"
                :class="buttonClass"
                :icon="buttonIcon"
            >
                <slot name="button"/>
            </v-btn>
        </template>

        <!-- Popup -->
        <v-card
            :flat="contentFlat"
            :shaped="contentShaped"
        >
            <slot name="content"/>
        </v-card>
    </v-menu>
</template>

<script>
    export default {
        name: "button-menu",

        props: {
            transition: {
                type: String,
                default: 'slide-y-transition'
            },
            nudgeWidth: {
                type: [String, Number],
                default: 200
            },
            offsetX: {
                type: Boolean,
                default: false
            },
            offsetY: {
                type: Boolean,
                default: false
            },
            buttonClass: {
                type: String,
                default: null
            },
            buttonIcon: {
                type: Boolean,
                default: false
            },
            contentFlat: {
                type: Boolean,
                default: false
            },
            contentShaped: {
                type: Boolean,
                default: false
            },
        },

        data: () => ({
            showMenu: false,
        }),
    }
</script>
