<script setup lang="ts">
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
</template>
