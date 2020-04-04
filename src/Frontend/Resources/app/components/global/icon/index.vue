<template>
    <i
        v-if="name"
        :class="name"
    ></i>
</template>

<script>
    export default {
        name: 'icon',

        props: {
            name: {
                type: String,
                default: null
            },
        },
    }
</script>
