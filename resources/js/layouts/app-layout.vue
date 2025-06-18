<script setup lang="ts">
import BackgroundBlur from '@/components/background/background-blur.vue';
import ContactModal from '@/components/contact/contact-modal.vue';
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

    <main class="z-10 mt-16">
        <slot />
    </main>

    <background-blur />
    <contact-modal />
</template>
