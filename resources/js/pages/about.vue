<script setup lang="ts">
import AboutWidgetsSection from '@/components/about/about-widgets-section.vue';
import AppLayout from '@/layouts/app-layout.vue';
</script>

<template>
    <app-layout page-title="About" :always-show-navbar="true">
        <section class="container mx-auto px-4 py-16">
            <h1 class="mb-4 text-3xl font-bold">About</h1>
            <p class="text-lg text-gray-300">Hero/splash section will be added here in the future.</p>
        </section>

        <about-widgets-section />

        <section class="container mx-auto px-4 py-16">
            <h2 class="mb-4 text-2xl font-bold">Timeline</h2>
            <p class="text-lg text-gray-300">Timeline component will be added here in the future.</p>
        </section>
    </app-layout>
</template>
