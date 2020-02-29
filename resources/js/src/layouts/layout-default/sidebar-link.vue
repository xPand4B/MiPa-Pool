<template>
    <div>
        <v-list-item
            v-if="item"
            @click="changeRoute(item.path)"
            :active-class="getListItemActiveClass"
            :class="[listItemClass, spacing]"
            :link="link"
        >
            <v-list-item-icon :class="listItemIconClass">
                <v-icon
                    v-if="isMaterialIcon"
                    v-text="item.icon"
                    :size="item.iconSize"
                    :color="item.color"
                    :style="item.iconStyle"
                />
                <icon
                    v-else-if="isFontawesomeIcon"
                    :name="item.icon"
                    :style="item.iconStyle"
                />
            </v-list-item-icon>

            <v-list-item-content :class="getItemContentClass" >
                <v-list-item-title
                    :class="listItemTitleClass"
                >
                    {{ item.title }}
                </v-list-item-title>
            </v-list-item-content>

        </v-list-item>

        <v-divider
            v-else
            :class="spacing"
        />
    </div>
</template>

<script>
    export default {
        name: "layout-default-navigation-sidebar-link",

        props: {
            link: {
                type: Boolean,
                default: false
            },
            externalLink: {
                type: Boolean,
                default: false
            },
            muted: {
                type: Boolean,
                default: false
            },
            spacing: {
                type: String,
                default: 'my-3'
            },
            listItemClass: String,
            listItemActiveClass: {
                type: String,
                default: 'font-weight-black'
            },
            listItemIconClass: String,
            listItemContentClass: String,
            listItemTitleClass: String,
            item: {
                type: Object,
                default: {
                    title: '',
                    path: '',
                    color: '',
                    icon: '',
                    iconStyle: '',
                    iconSize: '',
                }
            },
        },

        methods: {
            changeRoute(routeName) {
                if (this.$route.name === routeName) {
                    return;
                }

                if (routeName === '' || !routeName) {
                    return;
                }

                return this.$router.push({ name: routeName });
            },
        },

        computed: {
            getListItemActiveClass() {
                return `${this.item.color} lighten-5 ${this.item.color}--text`;
            },

            getItemContentClass() {
                if (this.muted) {
                    return 'grey--text'
                }
            },

            isMaterialIcon() {
                return !!this.item.icon.includes('mdi-');
            },

            isFontawesomeIcon() {
                return !!this.item.icon.includes(' fa-');
            },
        }
    }

</script>
