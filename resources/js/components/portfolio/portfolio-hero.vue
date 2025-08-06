<script setup lang="ts">
import PortfolioPattern from '@/components/background/portfolio-pattern.vue';
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
        <portfolio-pattern />

        <div class="z-10 px-6 text-center">
            <div class="mb-4 overflow-hidden">
                <h1
                    class="text-4xl font-bold tracking-tight text-white transition-transform duration-1000 ease-out md:text-6xl"
                    :class="titleVisible ? 'translate-y-0 opacity-100' : 'translate-y-full opacity-0'"
                >
                    My <span class="text-purple-400">Portfolio</span>
                </h1>
            </div>

            <div class="mb-8 overflow-hidden">
                <div
                    class="relative text-xl font-light text-gray-300 transition-opacity duration-1000 md:text-2xl"
                    :class="subtitleVisible ? 'opacity-100' : 'opacity-0'"
                >
                    <span>Showcasing my projects, skills, and creative journey</span>
                </div>
            </div>

            <div class="transition-all duration-1000 ease-out" :class="ctaVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                <button
                    @click="handleScrollDown"
                    class="inline-flex items-center gap-2 rounded-lg border-2 border-white bg-transparent px-6 py-3 font-semibold tracking-wide text-white shadow-lg transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:border-white hover:bg-white hover:text-gray-900 hover:shadow-xl"
                >
                    View Projects
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            fill-rule="evenodd"
                            d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z"
                            clip-rule="evenodd"
                        />
                    </svg>
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
