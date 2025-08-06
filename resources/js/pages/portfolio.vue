<script setup lang="ts">
import PortfolioHero from '@/components/portfolio/portfolio-hero.vue';
import TechStackSection from '@/components/portfolio/tech-stack-section.vue';
import AppLayout from '@/layouts/app-layout.vue';
</script>

<template>
    <app-layout page-title="Portfolio" :always-show-navbar="true">
        <portfolio-hero />
        <tech-stack-section />
    </app-layout>
</template>
