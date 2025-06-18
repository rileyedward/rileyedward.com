<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { Props } from '@/types/components/blog/blog-post-hero';

withDefaults(defineProps<Props>(), {
    date: '',
    author: '',
    category: ''
});

const titleVisible = ref(false);
const metaVisible = ref(false);
const ctaVisible = ref(false);

onMounted(() => {
    setTimeout(() => {
        titleVisible.value = true;

        setTimeout(() => {
            metaVisible.value = true;

            setTimeout(() => {
                ctaVisible.value = true;
            }, 600);
        }, 600);
    }, 300);
});

const handleScrollDown = (): void => {
    window.scrollBy({
        top: 200,
        behavior: 'smooth',
    });
};
</script>

<template>
    <section class="relative flex min-h-[40vh] flex-col items-center justify-center overflow-hidden bg-gradient-to-br from-gray-900 to-gray-800">
        <!-- SVG Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>

        <div class="z-10 px-6 text-center">
            <div class="mb-4 overflow-hidden">
                <h1
                    class="text-4xl font-bold tracking-tight transition-transform duration-1000 ease-out md:text-6xl"
                    :class="titleVisible ? 'translate-y-0 opacity-100' : 'translate-y-full opacity-0'"
                >
                    {{ title }}
                </h1>
            </div>

            <div v-if="date || author || category" class="mb-8 overflow-hidden">
                <div
                    class="relative text-xl font-light text-gray-300 transition-opacity duration-1000 md:text-2xl"
                    :class="metaVisible ? 'opacity-100' : 'opacity-0'"
                >
                    <div class="flex flex-wrap items-center justify-center gap-4 text-sm text-gray-400">
                        <span v-if="date" class="flex items-center">
                            <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                            {{ date }}
                        </span>
                        <span v-if="author" class="flex items-center">
                            <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            {{ author }}
                        </span>
                        <span v-if="category" class="flex items-center">
                            <svg class="mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                            </svg>
                            {{ category }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="transition-all duration-1000 ease-out" :class="ctaVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                <button
                    @click="handleScrollDown"
                    class="inline-block border-2 border-white px-6 py-3 font-medium tracking-wide transition-colors duration-300 ease-in-out hover:bg-white hover:text-[#111]"
                >
                    Read Article
                </button>
            </div>
        </div>

        <div class="absolute right-0 bottom-8 left-0 z-10 flex justify-center opacity-50">
            <div class="flex space-x-2">
                <div class="h-1 w-16 bg-purple-500"></div>
                <div class="h-1 w-4 bg-white"></div>
                <div class="h-1 w-8 bg-cyan-400"></div>
            </div>
        </div>
    </section>
</template>
