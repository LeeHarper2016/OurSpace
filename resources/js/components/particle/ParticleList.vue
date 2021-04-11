<template>
    <div v-if="particleList.length > 0" class="relative pointer-events-none w-full">
        <ParticleSingle v-for="particle in this.particleList" :particle="particle" :key="particle.id">
            {{ particle.body }}
        </ParticleSingle>
    </div>
    <div v-else>
        <span>There appears to be no particles currently posted to this space.</span>
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
