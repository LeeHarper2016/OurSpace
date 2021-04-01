<template>
    <div>
        <input type="text"
               placeholder="Search Spaces"
               v-model="userSearch"
               @keyup="onInputChange"
               class="text-black w-64 border p-1 pl-3 rounded-md" />
        <ul v-if="userIsSearching"
            class="block text-black absolute w-64 bg-white rounded-md p-2 border border-t-none">
            <li v-for="space in searchList"
                v-text="space.name">
            </li>
        </ul>
    </div>
</template>

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
        onInputChange() {
            if (this.userSearch === '') {
                this.userIsSearching = false;
            } else {
                this.userIsSearching = true;
            }
        }
    },
}
</script>
