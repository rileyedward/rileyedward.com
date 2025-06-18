<script setup lang="ts">
import BlogShowHero from '@/components/blog/blog-show-hero.vue';
import AppLayout from '@/layouts/app-layout.vue';
import { BlogShowPageProps as Props } from '@/types/pages/blog';

defineProps<Props>();
</script>

<template>
    <app-layout :page-title="blogPost.title" :always-show-navbar="true">
        <blog-show-hero
            :title="blogPost.title"
            :date="blogPost.published_at"
            :author="blogPost.author"
            :category="blogPost.category"
        />

        <div class="container mx-auto px-4 py-8">
            <div class="prose prose-lg mx-auto max-w-3xl prose-invert">
                <p class="text-gray-400">Blog post content coming soon...</p>
            </div>
        </div>
    </app-layout>
</template>
