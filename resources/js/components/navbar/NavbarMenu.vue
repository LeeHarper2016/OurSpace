<template>
    <div class="flex justify-between w-full text-center text-white font-bold p-5">
        <div class="space-x-5">
            <slot name="left-menu"></slot>
        </div>
        <div class="flex space-x-5">
            <slot name="right-menu"></slot>
        </div>
    </div>
</template>

<style scoped>

</style>

<script>
export default {
    props: ['space', 'user'],
    data() {
        return {

        }
    }
}
</script>
