<script setup lang="ts">
import BackgroundBlur from '@/components/background/background-blur.vue';
import Navbar from '@/components/navigation/navbar.vue';
import { Props } from '@/types/layouts/app-layout';
import { Head as InertiaHead } from '@inertiajs/vue3';

withDefaults(defineProps<Props>(), {
    pageTitle: 'Riley Edward',
    alwaysShowNavbar: false,
});
</script>

<template>
    <inertia-head :title="pageTitle" />

    <navbar :always-show-navbar="alwaysShowNavbar" />

    <main>
        <slot />
    </main>

    <div class="absolute inset-0 z-0">
        <div class="bg-grid-white/[0.05] absolute inset-0 bg-[#111] opacity-90"></div>

        <background-blur />
    </div>
</template>
