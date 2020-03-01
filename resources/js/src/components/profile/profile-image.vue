<template>
    <v-avatar
        :color="color"
        :size="size"
    >
        <img
            :src="imgSrc"
            :alt="imgAlt"
            :title="imgTitle"
            :class="['white--text', imgClass]"
        />
    </v-avatar>
</template>

<script>
    export default {
        name: "profile-image",

        props: {
            imgSrc: {
                type: String,
                default: null
            },
            imgAlt: {
                type: String,
                default: null
            },
            imgTitle: {
                type: String,
                default: null
            },
            imgClass: {
                type: String,
                default: 'headline'
            },
            color: {
                type: String,
                default: 'indigo'
            },
            size: {
                type: [String, Number],
                default: 48
            },
        }
    }
</script>
