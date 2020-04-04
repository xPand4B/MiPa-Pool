<template>
    <v-navigation-drawer
            :value="sidebarVisible"
            :mini-variant.sync="sidebarMini"
            clipped
            app
    >
        <!-- Create Button -->
        <!--        <v-list rounded>-->
        <!--            <sidebar-link-->
        <!--                list-item-class="font-weight-black elevation-5"-->
        <!--                list-item-icon-class="justify-center"-->
        <!--                list-item-title-class="purple&#45;&#45;text"-->
        <!--                :item="{-->
        <!--                    title: 'Create',-->
        <!--                    icon: 'mdi-plus',-->
        <!--                    color: 'purple'-->
        <!--                }"-->
        <!--            />-->
        <!--        </v-list>-->

        <!-- Menu Link -->
        <v-list
                dense
                shaped
        >
            <!--            <v-divider/>-->

            <v-list-item-group
                    v-model="activeSidebarItem"
                    color="indigo"
                    mandatory
            >
                <layout-component-sidebar-link
                        v-for="(item, i) in sidebar.items"
                        :key="i"
                        :item="item"
                />
            </v-list-item-group>
        </v-list>

        <!-- Bottom Links -->
        <template v-slot:append>
            <v-list>
            </v-list>

            <v-list dense>
                <layout-component-sidebar-toggle-mini muted/>

                <layout-component-sidebar-link
                        v-for="(item, i) in sidebar.appendItems"
                        :key="i"
                        :item="item"
                        external-link
                        muted
                />
            </v-list>
        </template>

    </v-navigation-drawer>
</template>

<script>
    import { mapGetters } from 'vuex';
    import LayoutComponentSidebarLink from './sidebar-link';
    import LayoutComponentSidebarToggleMini from './sidebar-toggle-mini';

    export default {
        name: 'layout-component-sidebar',

        components: {
            LayoutComponentSidebarLink,
            LayoutComponentSidebarToggleMini,
        },

        props: {
            sidebar: Object,
        },

        data: () => ({
            activeSidebarItem: 0,
        }),

        computed: {
            ...mapGetters({
                sidebarVisible: 'getSidebarVisible',
                sidebarMini: 'getSidebarMini'
            }),
        },
    }
</script>
