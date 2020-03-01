<template>
    <v-avatar
        v-if="initials"
        :color="color"
        :size="size"
    >
        <span
            :class="['white--text', initialsClass]"
        >
            {{ initials }}
        </span>
    </v-avatar>
</template>

<script>
    export default {
        name: "profile-initials",

        props: {
            initials: null,
            initialsClass: {
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
