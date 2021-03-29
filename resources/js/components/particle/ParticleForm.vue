<template>
    <div class="p-5">
        <form @submit.prevent="onSubmit" class="space-y-3 mr-auto ml-auto">
            <textarea v-model="body" rows="5" name="body" class="block border border-black w-3/4 p-2.5"></textarea>
            <button type="submit" class="p-3 w-20 bg-indigo-300 rounded-lg">Post</button>
        </form>
    </div>
</template>

<script>

export default {
    props: ['space'],
    data() {
        return {
            body: ''
        }
    },
    methods: {
        onSubmit() {
            axios.post("/spaces/" + this.space +  "/particles", { body: this.body })
        }
    }
}
</script>
