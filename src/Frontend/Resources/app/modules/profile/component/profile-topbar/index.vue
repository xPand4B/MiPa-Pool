<template>
    <button-menu
        button-class="mr-5 elevation-5"
        offset-x
        offset-y
        button-icon
        content-flat
    >
        <template v-slot:button>
            <profile-initials v-if="true"/>
            <profile-image v-else/>
        </template>

        <template v-slot:content>
            <!-- Profile data -->
            <profile-information/>

            <v-divider/>

            <!-- Settings -->
            <settings-component-darkmode-switch justify-center/>

            <v-divider/>

            <!-- Sign Out -->
            <v-card-actions class="justify-center">
                <v-btn
                    class="ma-2"
                    large
                    outlined
                >Sign Out</v-btn>
            </v-card-actions>
        </template>
    </button-menu>
</template>

<script>
    import ProfileInitials from '../profile-initials';
    import ProfileInformation from '../profile-information';
    import ProfileImage from '../profile-image';
    import { SettingsComponentDarkmodeSwitch } from '../../../settings/index'

    export default {
        name: "profile-component-topbar",

        components: {
            ProfileInitials,
            ProfileInformation,
            ProfileImage,

            SettingsComponentDarkmodeSwitch,
        },
    }
</script>
