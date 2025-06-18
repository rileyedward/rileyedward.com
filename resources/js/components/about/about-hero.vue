<script setup lang="ts">
import TechPattern from '@/components/background/tech-pattern.vue';
import { onMounted, ref } from 'vue';
import { aboutHeroConfig } from './about-hero.config';

const { role, description, techStack } = aboutHeroConfig;

const titleVisible = ref(false);
const roleVisible = ref(false);
const detailsVisible = ref(false);
const techVisible = ref(false);

onMounted(() => {
    setTimeout(() => {
        titleVisible.value = true;

        setTimeout(() => {
            roleVisible.value = true;

            setTimeout(() => {
                detailsVisible.value = true;

                setTimeout(() => {
                    techVisible.value = true;
                }, 400);
            }, 400);
        }, 400);
    }, 300);
});

const handleScrollDown = (): void => {
    window.scrollBy({
        top: 300,
        behavior: 'smooth',
    });
};
</script>

<template>
    <section class="relative flex min-h-[70vh] flex-col items-center justify-center overflow-hidden bg-[#111]">
        <tech-pattern />

        <div class="z-10 mx-auto max-w-4xl px-6">
            <div class="mb-6 overflow-hidden">
                <h1
                    class="text-4xl font-bold tracking-tight text-white transition-transform duration-1000 ease-out md:text-6xl"
                    :class="titleVisible ? 'translate-y-0 opacity-100' : 'translate-y-full opacity-0'"
                >
                    A bit <span class="text-purple-400">more</span> about me
                </h1>
            </div>

            <div class="mb-6 overflow-hidden">
                <div
                    class="text-2xl font-medium text-white transition-all duration-700"
                    :class="roleVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                >
                    {{ role }}
                </div>
            </div>

            <div class="mb-6 overflow-hidden">
                <div
                    class="text-lg text-gray-300 transition-all duration-700"
                    :class="detailsVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                >
                    <p class="mb-4">{{ description }}</p>
                </div>
            </div>

            <div class="overflow-hidden">
                <div class="transition-all duration-700" :class="techVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                    <div class="mb-2 text-lg font-medium text-white">My Current Stack</div>
                    <div class="flex flex-wrap gap-2">
                        <span
                            v-for="(tech, index) in techStack"
                            :key="index"
                            class="bg-opacity-30 rounded-full bg-purple-500 px-3 py-1 text-sm text-white"
                        >
                            {{ tech }}
                        </span>
                    </div>

                    <div class="mt-8">
                        <button
                            @click="handleScrollDown"
                            class="inline-flex items-center gap-2 rounded-lg border-2 border-white px-6 py-3 font-medium tracking-wide text-white shadow-md transition-all duration-300 ease-in-out hover:bg-gradient-to-r hover:from-purple-500 hover:to-cyan-400 hover:border-transparent hover:text-white"
                        >
                            Learn More
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 10.293a1 1 0 010 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
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
