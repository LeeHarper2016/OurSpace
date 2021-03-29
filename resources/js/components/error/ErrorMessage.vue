<template>
    <div v-if="isVisible" class="bg-red-200 h-12 rounded-xl w-2/3 p-3 mr-auto ml-auto mt-3 pointer-events-auto">
        <slot></slot>
        <button @click="toggleVisibility" class="underline float-right">
            close
        </button>
    </div>
</template>

<script>
  export default {
      data() {
          return {
              isVisible: true
          }
      },
      methods: {
          toggleVisibility() {
              this.isVisible = false;
          }
      }

  }
</script>
