<script setup lang="ts">
import LandingSplash from '@/components/landing/landing-splash.vue';
import AppLayout from '@/layouts/app-layout.vue';
</script>

<template>
    <app-layout page-title="Home">
        <landing-splash />

        <div style="height: 500px" />
    </app-layout>
</template>
