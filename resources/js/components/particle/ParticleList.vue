<template>
    <div class="relative pointer-events-none w-full">
        <ParticleSingle v-for="particle in this.particles" :particle="particle" :key="particle.id">
            {{ particle.body }}
        </ParticleSingle>
    </div>
</template>

<script>

import ParticleSingle from "./ParticleSingle";
export default {
    components: {ParticleSingle},
    props: ['particles']
}
</script>
