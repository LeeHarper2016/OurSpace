<template>
    <transition name="fade">
        <div v-if="isVisible"
             class="bg-red-200 h-12 rounded-xl w-2/3 p-3 mr-auto ml-auto mt-3 pointer-events-auto">
            <slot></slot>
            <button @click="closeError"
                    class="underline float-right">
                close
            </button>
        </div>
    </transition>
</template>

<script>
  export default {
      props: ['id'],
      data() {
          return {
              isVisible: true
          }
      },
      methods: {
          closeError() {
              this.isVisible = false;
              this.$emit('delete', this.id);
          }
      }

  }
</script>

<style scoped>

.fade-enter-active, .fade-leave-active {
    transition: opacity 0.75s;
}
.fade-enter, .fade-leave-to {
    opacity: 0;
}
</style>
