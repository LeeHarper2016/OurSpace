<template>
    <div>
        <div class="relative pointer-events-none w-full">
            <div class="p-5">
                <img :src="'/' + particle.user.avatar" class="w-20 h-20 rounded-full inline" />
                <h1 class="text-2xl font-bold inline">{{ particle.user.name }}</h1>
                <br />
                <p class="inline">
                    <slot></slot>
                </p>
                <small class="block mt-3">Created at {{ new Date(particle.created_at) }}</small>
                <hr />
            </div>
        </div>
    </div>

</template>

<script>

export default {
    props: ['particle']
}
</script>
