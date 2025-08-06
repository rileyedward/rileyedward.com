<script setup lang="ts">
import { Link as InertiaLink } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref } from 'vue';
import { landingSplashSubtitles } from './landing-splash.config';

const titleVisible = ref(false);
const subtitleVisible = ref(false);
const ctaVisible = ref(false);
const currentTitleIndex = ref(0);
const isChangingTitle = ref(false);
const currentTitle = ref(landingSplashSubtitles[0]);

const rotateTitle = (): void => {
    isChangingTitle.value = true;

    setTimeout(() => {
        currentTitleIndex.value = (currentTitleIndex.value + 1) % landingSplashSubtitles.length;
        currentTitle.value = landingSplashSubtitles[currentTitleIndex.value];

        isChangingTitle.value = false;
    }, 600);
};

let titleRotationInterval: number | null = null;

onMounted(() => {
    setTimeout(() => {
        titleVisible.value = true;

        setTimeout(() => {
            subtitleVisible.value = true;

            setTimeout(() => {
                ctaVisible.value = true;

                titleRotationInterval = window.setInterval(rotateTitle, 6000);
            }, 800);
        }, 800);
    }, 400);
});

onUnmounted(() => {
    if (titleRotationInterval !== null) {
        clearInterval(titleRotationInterval);
    }
});
</script>

<template>
    <section class="relative flex min-h-screen flex-col items-center justify-center overflow-hidden">
        <div class="z-10 mb-24 px-6 text-center">
            <div class="mb-4 overflow-hidden">
                <h1
                    class="text-4xl font-bold tracking-tight transition-transform duration-1000 ease-out md:text-6xl"
                    :class="titleVisible ? 'translate-y-0 opacity-100' : 'translate-y-full opacity-0'"
                >
                    Hi, I'm <span class="text-purple-400">Riley.</span>
                </h1>
            </div>

            <div class="mb-8 overflow-hidden">
                <div
                    class="relative h-10 text-xl font-light text-gray-300 transition-opacity duration-1000 md:text-2xl"
                    :class="subtitleVisible ? 'opacity-100' : 'opacity-0'"
                >
                    <span
                        class="absolute inset-0 w-full text-center transition-all duration-500 ease-in-out"
                        :class="isChangingTitle ? '-translate-y-4 transform opacity-0' : 'translate-y-0 transform opacity-100'"
                    >
                        {{ currentTitle }}
                    </span>

                    <span
                        v-if="isChangingTitle"
                        class="absolute inset-0 w-full text-center transition-all duration-500 ease-in-out"
                        :class="{ 'title-enter': isChangingTitle }"
                    >
                        {{ landingSplashSubtitles[(currentTitleIndex + 1) % landingSplashSubtitles.length] }}
                    </span>
                </div>
            </div>

            <div class="transition-all duration-1000 ease-out" :class="ctaVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'">
                <inertia-link
                    :href="route('about.index')"
                    class="inline-flex items-center gap-2 rounded-lg border-2 border-white bg-transparent px-6 py-3 font-semibold tracking-wide text-white shadow-lg transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:border-white hover:bg-white hover:text-gray-900 hover:shadow-xl"
                >
                    Get to know me
                </inertia-link>
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

<style scoped>
.title-enter {
    animation: titleEnter 600ms forwards;
}

@keyframes titleEnter {
    0% {
        opacity: 0;
        transform: translateY(8px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
    100% {
        transform: translateY(0px);
    }
}
</style>
