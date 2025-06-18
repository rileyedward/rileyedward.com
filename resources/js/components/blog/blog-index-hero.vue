<script setup lang="ts">
import RetroGrid from '@/components/background/retro-grid.vue';
import { onMounted, ref } from 'vue';

const titleVisible = ref(false);
const subtitleVisible = ref(false);
const ctaVisible = ref(false);

onMounted(() => {
    setTimeout(() => {
        titleVisible.value = true;

        setTimeout(() => {
            subtitleVisible.value = true;

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
    <section class="relative flex min-h-[60vh] flex-col items-center justify-center overflow-hidden bg-[#111]">
        <retro-grid />

        <div class="z-10 px-6 text-center">
            <div class="mb-4 overflow-hidden">
                <h1
                    class="text-4xl font-bold tracking-tight text-white transition-transform duration-1000 ease-out md:text-6xl"
                    :class="titleVisible ? 'translate-y-0 opacity-100' : 'translate-y-full opacity-0'"
                >
                    Explore My <span class="text-purple-400">Blog</span>
                </h1>
            </div>

            <div class="mb-8 overflow-hidden">
                <div
                    class="relative text-xl font-light text-gray-300 transition-opacity duration-1000 md:text-2xl"
                    :class="subtitleVisible ? 'opacity-100' : 'opacity-0'"
                >
                    <span>Thoughts, stories, and ideas from my journey</span>
                </div>
            </div>

            <div class="transition-all duration-1000 ease-out" :class="ctaVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                <button
                    @click="handleScrollDown"
                    class="inline-block border-2 border-white px-6 py-3 font-medium tracking-wide text-white transition-colors duration-300 ease-in-out hover:bg-white hover:text-[#111]"
                >
                    View Posts
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
