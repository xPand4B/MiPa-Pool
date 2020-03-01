<template>
    <v-row>
        <v-col cols="12">
            <v-row justify="center">
                <profile-initials
                    initials="EH"
                    initials-class="display-2"
                    :size="size"
                />
            </v-row>
        </v-col>

        <v-col cols="12" class="my-0 py-0">
            <v-row justify="center">
                <div class="headline">
                    Eric Heinzl
                </div>
            </v-row>
        </v-col>
        <v-col cols="12" class="mt-0 pt-0">
            <v-row justify="center">
                <div class="subtitle-1 grey--text">
                    e.heinzl@shopware.com
                </div>
            </v-row>
        </v-col>
    </v-row>
</template>

<script>
    import { mapGetters } from 'vuex';
    import ProfileInitials from './profile-initials';

    export default {
        name: "profile-information",

        components: {
            ProfileInitials
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
        }
    }
</script>
