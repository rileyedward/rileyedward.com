<script setup lang="ts">
import BlogIndexHero from '@/components/blog/blog-index-hero.vue';
import BlogPostCard from '@/components/blog/blog-post-card.vue';
import BlogSearchFilter from '@/components/blog/blog-search-filter.vue';
import AppLayout from '@/layouts/app-layout.vue';
import { BlogPost } from '@/types/models/blog-post';
import { BlogIndexPageProps as Props } from '@/types/pages/blog';
import Fuse from 'fuse.js';
import { computed, ref } from 'vue';

const props = defineProps<Props>();

const blogPosts = computed(() => {
    if (!props.blogPosts) return [];

    return props.blogPosts.map((post) => ({
        ...post,
        published_at: post.created_at,
        author: 'Riley Edward',
        category: post.category?.name,
    }));
});

const categories = computed(() => props.categories || []);

const searchQuery = ref('');
const selectedCategory = ref<number | null>(null);

const fuseOptions = {
    keys: ['title', 'content'],
    threshold: 0.4,
    includeScore: true,
};

const fuse = computed((): Fuse<BlogPost> => {
    return new Fuse(blogPosts.value, fuseOptions);
});

const filteredPosts = computed((): BlogPost[] => {
    let result = [...blogPosts.value];

    if (selectedCategory.value !== null) {
        result = result.filter((post) => post.category_id === selectedCategory.value);
    }

    if (searchQuery.value.trim()) {
        try {
            const searchResults = fuse.value.search(searchQuery.value);
            result = searchResults.map((result) => result.item);
        } catch (error) {
            console.error('Error searching posts:', error);
        }
    }

    return result;
});

const updateSearchQuery = (query: string): void => {
    searchQuery.value = query;
};

const updateSelectedCategory = (categoryId: number | null): void => {
    selectedCategory.value = categoryId;
};
</script>

<template>
    <app-layout page-title="Blog" :always-show-navbar="true">
        <blog-index-hero />

        <div class="container mx-auto px-4 py-8">
            <blog-search-filter :categories="categories" @update:searchQuery="updateSearchQuery" @update:selectedCategory="updateSelectedCategory" />

            <div v-if="filteredPosts.length > 0">
                <h2 class="mb-6 text-2xl font-bold">
                    <span v-if="filteredPosts.length === blogPosts.length">Latest Posts</span>
                    <span v-else>Search Results</span>
                </h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <blog-post-card v-for="post in filteredPosts" :key="post.id" :post="post" />
                </div>
            </div>

            <div v-else class="py-12 text-center">
                <h2 class="mb-4 text-2xl font-bold">No Posts Found</h2>
                <p class="text-gray-400">Try adjusting your search or filter criteria.</p>
            </div>
        </div>
    </app-layout>
</template>
