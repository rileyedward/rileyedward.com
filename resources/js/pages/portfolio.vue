<script setup lang="ts">
import PortfolioHero from '@/components/portfolio/portfolio-hero.vue';
import AppLayout from '@/layouts/app-layout.vue';
</script>

<template>
    <app-layout page-title="Portfolio" :always-show-navbar="true">
        <portfolio-hero />

        <!-- TODO: Replace with actual page content -->
        <div class="container mx-auto px-4 py-16">
            <div class="text-center">
                <h2 class="mb-8 text-4xl font-bold text-gray-900">Coming Soon</h2>
                <p class="text-xl text-gray-600">Portfolio projects and details will be added here.</p>
            </div>
        </div>
    </app-layout>
</template>
