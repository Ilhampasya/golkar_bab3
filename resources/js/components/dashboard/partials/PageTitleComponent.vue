<template>
    <h2 class="text-base --page-title lg:text-xl font-bold text-white uppercase rounded-lg focus:outline-none focus:shadow-outline mb-5" v-text="name"></h2>
</template>
<script>
export default {
    props: ['name']
}
</script>

<style lang="scss" scoped>
    .--page-title {
        @apply relative;
        &::after {
            @apply bg-primary;
            content: '';
            display: block;
            height: 4px;
            margin: 8px 0 0;
            width: 60px;
        }
        @media screen and (max-width: 640px) {
            &::after {
                height: 3px;
            }
        }
    }
</style>