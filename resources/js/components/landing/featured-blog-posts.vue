<script setup lang="ts">
import type { Props } from '@/types/components/landing/featured-blog-posts';
import { Link as InertiaLink } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps<Props>();
const currentIndex = ref(0);

const currentPost = computed(() => props.blogPosts[currentIndex.value]);

const nextPost = (): void => {
    currentIndex.value = (currentIndex.value + 1) % props.blogPosts.length;
};

const prevPost = (): void => {
    currentIndex.value = currentIndex.value === 0 ? props.blogPosts.length - 1 : currentIndex.value - 1;
};

const goToPost = (index: number): void => {
    currentIndex.value = index;
};

const excerpt = computed((): string => {
    if (!currentPost.value?.content) return '';

    const plainText = currentPost.value.content
        .replace(/<[^>]*>/g, '')
        .replace(/[#*_~`]/g, '')
        .replace(/\n+/g, ' ');

    return plainText.length > 200 ? plainText.substring(0, 200) + '...' : plainText;
});
</script>

<template>
    <section v-if="props.blogPosts.length > 0" class="px-6 py-16">
        <div class="container mx-auto max-w-6xl">
            <div class="mb-12 text-center">
                <h2 class="mb-4 text-3xl font-bold text-white md:text-4xl">Recent <span class="text-purple-400">Blog Posts</span></h2>
            </div>

            <div class="relative">
                <div class="relative overflow-hidden rounded-lg bg-[#1a1a1a] shadow-2xl">
                    <div class="flex transition-transform duration-500 ease-in-out" :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
                        <div v-for="(post, index) in props.blogPosts" :key="post.id" class="w-full flex-shrink-0">
                            <div class="p-8 lg:p-12">
                                <div v-if="post.category" class="mb-4">
                                    <span class="inline-block rounded-md bg-cyan-900 px-3 py-1 text-sm font-medium text-cyan-200">
                                        {{ typeof post.category === 'string' ? post.category : post.category.name }}
                                    </span>
                                </div>

                                <h3 class="mb-4 text-2xl font-bold text-white lg:text-3xl">
                                    {{ post.title }}
                                </h3>

                                <p class="mb-8 leading-relaxed text-gray-300">
                                    {{ excerpt }}
                                </p>

                                <inertia-link
                                    :href="`/blog/${post.slug}`"
                                    class="inline-flex items-center gap-2 rounded-lg bg-purple-600 px-6 py-3 font-semibold text-white transition-all duration-300 hover:bg-purple-500 hover:shadow-lg"
                                >
                                    Read More
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </inertia-link>
                            </div>
                        </div>
                    </div>
                </div>

                <button
                    v-if="props.blogPosts.length > 1"
                    @click="prevPost"
                    class="absolute top-1/2 left-4 -translate-y-1/2 transform rounded-full bg-black/50 p-2 text-white transition-all duration-200 hover:scale-110 hover:bg-black/70"
                    aria-label="Previous post"
                >
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <button
                    v-if="props.blogPosts.length > 1"
                    @click="nextPost"
                    class="absolute top-1/2 right-4 -translate-y-1/2 transform rounded-full bg-black/50 p-2 text-white transition-all duration-200 hover:scale-110 hover:bg-black/70"
                    aria-label="Next post"
                >
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <div v-if="props.blogPosts.length > 1" class="mt-8 flex justify-center space-x-2">
                <button
                    v-for="(post, index) in props.blogPosts"
                    :key="post.id"
                    @click="goToPost(index)"
                    class="h-2 w-2 rounded-full transition-all duration-300"
                    :class="index === currentIndex ? 'w-8 bg-purple-400' : 'bg-gray-600 hover:bg-gray-500'"
                    :aria-label="`Go to post ${index + 1}`"
                ></button>
            </div>

            <div class="mt-12 text-center">
                <inertia-link
                    :href="route('blog.index')"
                    class="inline-flex items-center gap-2 rounded-lg border-2 border-purple-400 bg-transparent px-6 py-3 font-semibold text-purple-400 transition-all duration-300 hover:bg-purple-400 hover:text-white"
                >
                    View All Posts
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </inertia-link>
            </div>
        </div>
    </section>
</template>
