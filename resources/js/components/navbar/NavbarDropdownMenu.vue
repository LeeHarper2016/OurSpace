<template>
    <div class="text-black" @click="toggleHover">
        <span>
            <slot name="nav-option"></slot>
        </span>
        <transition name="slide">
            <ul class="block text-black text-left absolute w-64 space-y-2 bg-white rounded-md p-2 border border-t-none"
                v-if="userHoveredOverMenu">
                <li v-for="item in items">
                    <a :href="item.link" v-text="item.name"></a>
                </li>
            </ul>
        </transition>
    </div>
</template>

<style scoped>
.slide-enter-active, .slide-leave-active {
    transition: all 0.25s ease;
}
.slide-enter, .slide-leave-to {
    transform: translateY(-1rem);
    opacity: 0;
}

</style>

<script>
export default {
    props: ['items'],
    data() {
        return {
            userHoveredOverMenu: false
        }
    },
    methods: {
        toggleHover() {
            this.userHoveredOverMenu = !this.userHoveredOverMenu;
        }
    }
}

</script>
