<script setup lang="ts">
import BlogContent from '@/components/blog/blog-content.vue';
import BlogShowHero from '@/components/blog/blog-show-hero.vue';
import AppLayout from '@/layouts/app-layout.vue';
import { BlogShowPageProps as Props } from '@/types/pages/blog';

defineProps<Props>();
</script>

<template>
    <app-layout :page-title="blogPost.title" :always-show-navbar="true">
        <blog-show-hero :title="blogPost.title" :date="blogPost.published_at" :author="blogPost.author" :category="blogPost.category" />

        <div class="mx-auto px-4 py-8">
            <blog-content :content="blogPost.content" />
        </div>
    </app-layout>
</template>
