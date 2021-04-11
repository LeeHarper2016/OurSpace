<template>
    <div class="relative pointer-events-none w-full">
        <ErrorMessage @delete="removeError($event)"
                       v-for="error in this.errorList.getErrors()"
                       :id="error.id"
                       :key="error.id">
            {{ error.message }}
        </ErrorMessage>
    </div>
</template>

<script>
import ErrorMessage from "./ErrorMessage";

export default {
    props: ['errors'],
    inject: ['errorList'],
    components: {ErrorMessage},
    methods: {
        removeError(id) {
            this.errorList.deleteError(id);
        }
    },
    mounted() {
        this.errors.forEach((error) => {
            this.errorList.addError(error);
        });
    }
}
</script>
