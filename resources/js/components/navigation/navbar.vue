<script setup lang="ts">
import { Props } from '@/types/components/navbar';
import { onMounted, onUnmounted, ref } from 'vue';

const props = defineProps<Props>();

const isVisible = ref(false);
const lastScrollY = ref(0);

const handleScroll = () => {
    const currentScrollY = window.scrollY;

    if (props.alwaysShowNavbar) {
        isVisible.value = true;
    } else {
        isVisible.value = currentScrollY > 100;
    }

    lastScrollY.value = currentScrollY;
};

onMounted(() => {
    if (props.alwaysShowNavbar) {
        isVisible.value = true;
    } else {
        handleScroll();
    }

    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <nav
        class="fixed top-0 right-0 left-0 z-50 transition-all duration-300 ease-in-out"
        :class="isVisible ? 'translate-y-0 bg-[#111]/90 opacity-100 shadow-md backdrop-blur-sm' : '-translate-y-full opacity-0'"
    >
        <div class="container mx-auto flex items-center justify-between px-4 py-4">
            <div class="text-xl font-bold">
                <a :href="route('home')" class="transition-colors duration-300 hover:text-purple-400">Riley Edward</a>
            </div>

            <div class="flex space-x-12">
                <a :href="route('about.index')" class="transition-colors duration-300 hover:text-cyan-400">About</a>
                <a href="https://github.com/rileyedward" target="_blank" class="transition-colors duration-300 hover:text-cyan-400">Portfolio</a>
                <a :href="route('blog.index')" class="transition-colors duration-300 hover:text-cyan-400">Blog</a>
            </div>
        </div>
    </nav>
</template>
