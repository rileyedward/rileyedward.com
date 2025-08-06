<script setup lang="ts">
import FeaturedBlogPosts from '@/components/landing/featured-blog-posts.vue';
import LandingSplash from '@/components/landing/landing-splash.vue';
import TechStackBanner from '@/components/landing/tech-stack-banner.vue';
import AppLayout from '@/layouts/app-layout.vue';
import type { HomePageProps as Props } from '@/types/pages/home';

defineProps<Props>();
</script>

<template>
    <app-layout page-title="Home">
        <landing-splash />
        
        <tech-stack-banner />

        <featured-blog-posts :blog-posts="recentBlogPosts" />
    </app-layout>
</template>
