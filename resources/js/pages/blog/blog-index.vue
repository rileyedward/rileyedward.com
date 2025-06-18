<script setup lang="ts">
import BlogIndexHero from '@/components/blog/blog-index-hero.vue';
import AppLayout from '@/layouts/app-layout.vue';
</script>

<template>
    <app-layout page-title="Blog" :always-show-navbar="true">
        <blog-index-hero />

        <div class="container mx-auto px-4 py-8">
            <h2 class="mb-6 text-2xl font-bold">Latest Posts</h2>
            <p class="text-gray-400">Blog content coming soon...</p>
        </div>
    </app-layout>
</template>
