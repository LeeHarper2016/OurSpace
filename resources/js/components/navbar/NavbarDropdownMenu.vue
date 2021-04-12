<template>
    <div class="text-black cursor-pointer" @mouseenter="toggleHover" @mouseleave="toggleHover">
        <span>
            <slot name="nav-option"></slot>
        </span>
        <transition name="slide">
            <ul class="block divide-gray-200 divide-y text-black text-left absolute bg-white rounded-md p-2 border border-t-none"
                :class="(this.pin_right) ? 'right-0' : ''"
                ref="hoverMenu"
                v-if="userHoveredOverMenu">
                <li v-for="item in items" class="p-1">
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
    props: ['items', 'pin_right'],
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
