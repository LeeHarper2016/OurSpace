<template>
    <div class="relative pointer-events-none w-full">
        <div v-for="particle in this.particles">
            <h1>{{ particle.user.name }}</h1>
            <p>{{ particle.body }}</p>
            <hr />
        </div>
    </div>
</template>

<script>

export default {
    props: ['particles']
}
</script>
