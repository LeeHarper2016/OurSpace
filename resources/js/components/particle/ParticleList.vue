<template>
    <div class="relative pointer-events-none w-full">
        <ParticleSingle v-for="particle in this.particleList" :particle="particle" :key="particle.id">
            {{ particle.body }}
        </ParticleSingle>
    </div>
</template>

<script>

import ParticleSingle from "./ParticleSingle";
export default {
    components: {ParticleSingle},
    props: ['particles'],
    data() {
        return {
            particleList: []
        }
    },
    mounted() {
        this.particleList = this.particles;

        this.$root.$on('newParticle', newParticle => {
            this.particleList.unshift(newParticle.data.particle);
        });
    }
}
</script>
