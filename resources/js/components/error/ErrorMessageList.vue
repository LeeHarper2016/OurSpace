<template>
    <div class="relative pointer-events-none w-full">
        <error-message v-for="error in this.errorList.getErrors()" v-bind:key="error.id">
            {{ error.message }}
        </error-message>
    </div>
</template>

<script>
import ErrorMessage from "./ErrorMessage";


export default {
    props: ['errors'],
    inject: ['errorList'],
    components: {ErrorMessage},
    mounted() {
        this.errors.forEach((error) => {
            this.errorList.addError(error);
        });
    }
}
</script>
