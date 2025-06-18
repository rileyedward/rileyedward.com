<script setup lang="ts">
import { Props } from '@/types/components/blog/blog-post-card';
import { Link as InertiaLink } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<Props>();

const excerpt = computed((): string => {
    if (!props.post.content) return '';

    const plainText = props.post.content
        .replace(/<[^>]*>/g, '')
        .replace(/[#*_~`]/g, '')
        .replace(/\n+/g, ' ');

    return plainText.length > 150 ? plainText.substring(0, 150) + '...' : plainText;
});

const formattedDate = computed((): string => {
    if (!props.post.published_at) return '';

    try {
        const date = new Date(props.post.published_at);
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
        });
    } catch {
        return props.post.published_at;
    }
});
</script>

<template>
    <div class="overflow-hidden rounded-lg bg-[#1a1a1a] shadow-lg transition-all duration-300 hover:translate-y-[-2px] hover:shadow-purple-900/20">
        <inertia-link :href="`/blog/${props.post.slug}`" class="block h-full">
            <div class="p-6">
                <div v-if="props.post.category || props.categoryName" class="mb-3">
                    <span class="inline-block rounded-md bg-cyan-900 px-2 py-1 text-xs text-cyan-200">
                        {{ props.post.category || props.categoryName }}
                    </span>
                </div>

                <h3 class="mb-2 text-xl font-bold text-white transition-colors hover:text-purple-400">
                    {{ props.post.title }}
                </h3>

                <p class="mb-4 text-sm text-gray-400">
                    {{ excerpt }}
                </p>

                <div class="mt-auto flex items-center text-xs text-gray-500">
                    <span v-if="props.post.published_at" class="flex items-center">
                        <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                fill-rule="evenodd"
                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                        {{ formattedDate }}
                    </span>

                    <span v-if="props.post.author" class="ml-4 flex items-center">
                        <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                        {{ props.post.author }}
                    </span>
                </div>
            </div>
        </inertia-link>
    </div>
</template>
