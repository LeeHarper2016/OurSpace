<template>
    <div>
        <input type="text"
               v-model="userSearch"
               placeholder="Search Spaces"
               class="text-black w-64 border p-1 pl-3 rounded-md" />
        <ul>
            <li v-for="space in searchList"
                v-text="space.name">
            </li>
        </ul>
    </div>
</template>

<script>

export default {
    props: ['spaces'],
    data: {
        userIsSearching: false,
        userSearch: ''
    },
    computed: {
        searchList() {
            return this.spaces.filter((space) => {
                return 'testing';
            });
        }
    },
    methods: {
        removeError(id) {
            this.errorList.deleteError(id);
        }
    },
}
</script>
