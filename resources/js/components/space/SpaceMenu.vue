<template>
    <div>
        <input type="text"
               placeholder="Search Spaces"
               v-model="userSearch"
               class="text-black w-64 border p-1 pl-3 rounded-md" />
        <transition name="slide">
            <transition-group name="fade"
                tag="ul"
                class="block text-black text-left absolute w-64 space-y-2 bg-white rounded-md p-2 border border-t-none"
                v-if="userIsSearching">
                <li v-for="space in searchList" :key="space.id">
                    <a :href="spaceUrl(space.id)">
                        <img :src="space.icon_picture_path"
                            width="32"
                            height="32"
                            class="rounded-full inline" />
                        <span v-text="space.name"
                            class="inline"></span>
                    </a>
                </li>
                <li v-if="searchList.length === 0" :key="-1">No spaces found...</li>
            </transition-group>
        </transition>
    </div>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.25s ease;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}
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
    props: ['spaces'],
    data() {
        return {
            userIsSearching: false,
            userSearch: ''
        }
    },
    computed: {
        searchList() {
            return this.spaces.filter((space) => {
                if (space.name.search(this.userSearch) !== -1) {
                    return true;
                } else {
                    return false;
                }
            });
        }
    },
    methods: {
        spaceUrl(id) {
            return '/spaces/' + id;
        }
    },
    watch: {
        userSearch() {
            if (this.userSearch === '') {
                this.userIsSearching = false;
            } else {
                this.userIsSearching = true;
            }
        }
    }
}
</script>
