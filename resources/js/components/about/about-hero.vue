<script setup lang="ts">
import TechPattern from '@/components/background/tech-pattern.vue';
import { aboutHeroConfig } from './about-hero.config';
import { onMounted, ref } from 'vue';

const { role, description, personalProjects, techStack } = aboutHeroConfig;

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

        <div class="z-10 px-6 max-w-4xl mx-auto">
            <div class="mb-6 overflow-hidden">
                <h1
                    class="text-4xl font-bold tracking-tight text-white transition-transform duration-1000 ease-out md:text-6xl"
                    :class="titleVisible ? 'translate-y-0 opacity-100' : 'translate-y-full opacity-0'"
                >
                    About <span class="text-purple-400">Me</span>
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

                    <div class="mb-2 font-medium">Current Projects:</div>
                    <ul class="list-disc list-inside mb-4 pl-2">
                        <li v-for="(project, index) in personalProjects" :key="index">{{ project }}</li>
                    </ul>
                </div>
            </div>

            <div class="overflow-hidden">
                <div
                    class="transition-all duration-700"
                    :class="techVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                >
                    <div class="mb-2 text-lg font-medium text-white">Tech Stack</div>
                    <div class="flex flex-wrap gap-2">
                        <span
                            v-for="(tech, index) in techStack"
                            :key="index"
                            class="px-3 py-1 bg-purple-500 bg-opacity-30 rounded-full text-sm text-white"
                        >
                            {{ tech }}
                        </span>
                    </div>

                    <div class="mt-8">
                        <button
                            @click="handleScrollDown"
                            class="inline-block border-2 border-white px-6 py-3 font-medium tracking-wide text-white transition-colors duration-300 ease-in-out hover:bg-white hover:text-[#111]"
                        >
                            Learn More
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
