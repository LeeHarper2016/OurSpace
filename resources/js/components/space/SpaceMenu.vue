<template>
    <div>
        <input type="text"
               v-model="userSearch"
               placeholder="Search Spaces"
               class="text-black w-64 border p-1 pl-3 rounded-md" />
        <ul v-if="userIsSearching"
            class="block absolute bg-white rounded-md transform translate-y-10 p-2 border border-t-none">>
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
                return 'testing';
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
