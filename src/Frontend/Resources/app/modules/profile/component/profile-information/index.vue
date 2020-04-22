<template>
    <v-row>
        <v-col cols="12">
            <v-row justify="center">
                <profile-initials
                    v-if="true"
                    initials-class="display-2"
                    :size="size"
                />
                <profile-image v-else/>
            </v-row>
        </v-col>

        <v-col cols="12" class="my-0 py-0">
            <v-row justify="center">
                <div class="headline">
                    {{ fullname }}
                </div>
            </v-row>
        </v-col>
        <v-col cols="12" class="mt-0 pt-0">
            <v-row justify="center">
                <div class="subtitle-1 grey--text">
                    {{ email }}
                </div>
            </v-row>
        </v-col>
    </v-row>
</template>

<script>
    import { mapGetters } from 'vuex';
    import ProfileInitials from '../profile-initials';
    import ProfileImage from '../profile-image';

    export default {
        name: "profile-component-information",

        components: {
            ProfileInitials,
            ProfileImage
        },

        props: {
            color: {
                type: String,
                default: 'indigo'
            },
            size: {
                type: [String, Number],
                default: 96
            },
        },

        computed: {
            ...mapGetters({
                email: 'getAuthUserEmail',
                fullname: 'getAuthUserFullname'
            }),
        },
    }
</script>
