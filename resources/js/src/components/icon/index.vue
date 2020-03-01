<template>
    <i
        v-if="name"
        :class="name"
    ></i>
</template>

<script>
    export default {
        props: {
            name: {
                type: String,
                default: null
            }
        }
    }
</script>
