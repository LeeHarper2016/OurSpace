<template>
    <div class="relative pointer-events-none w-full">
        <error-message v-for="error in this.errors" v-bind:key="error.id">
            {{ error }}
        </error-message>
    </div>
</template>

<script>
import ErrorMessage from "./ErrorMessage";


export default {
    props: ['errors'],
    components: {ErrorMessage},
}
</script>
