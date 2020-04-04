<template>
    <v-avatar
        :color="color"
        :size="size"
    >
        <span
            v-if="isLoaded"
            :class="['white--text', initialsClass]"
        >{{ initials }}</span>

        <span
            v-else
            :class="['white--text', initialsClass]"
        >&nbsp;</span>

    </v-avatar>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        name: "profile-component-initials",

        props: {
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
        },

        computed: {
            ...mapGetters({
                isLoaded: 'userIsLoaded',
                initials: 'getCurrentUserInitials'
            }),
        },
    }
</script>
