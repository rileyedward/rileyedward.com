<script setup lang="ts">
import { Props } from '@/types/components/navbar';
import { onMounted, onUnmounted, ref } from 'vue';

const props = defineProps<Props>();

const isVisible = ref(false);
const lastScrollY = ref(0);
const isMobileMenuOpen = ref(false);

const handleScroll = () => {
    const currentScrollY = window.scrollY;

    if (props.alwaysShowNavbar) {
        isVisible.value = true;
    } else {
        isVisible.value = currentScrollY > 100;
    }

    if (isMobileMenuOpen.value && Math.abs(currentScrollY - lastScrollY.value) > 10) {
        isMobileMenuOpen.value = false;
    }

    lastScrollY.value = currentScrollY;
};

const toggleMobileMenu = () => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value;
};

const closeMobileMenu = () => {
    isMobileMenuOpen.value = false;
};

const handleClickOutside = (event: MouseEvent) => {
    const navElement = document.querySelector('nav');
    if (isMobileMenuOpen.value && navElement && !navElement.contains(event.target as Node)) {
        isMobileMenuOpen.value = false;
    }
};

onMounted(() => {
    if (props.alwaysShowNavbar) {
        isVisible.value = true;
    } else {
        handleScroll();
    }

    window.addEventListener('scroll', handleScroll);
    document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
    document.removeEventListener('click', handleClickOutside);
});
</script>

<template>
    <nav
        class="fixed top-0 right-0 left-0 z-50 transition-all duration-300 ease-in-out"
        :class="
            isVisible
                ? 'translate-y-0 border-b border-gray-800/50 bg-[#111]/95 opacity-100 shadow-md backdrop-blur-md'
                : '-translate-y-full opacity-0'
        "
    >
        <div class="container mx-auto flex items-center justify-between px-4 py-4">
            <div class="text-xl font-bold">
                <a :href="route('home')" class="transition-colors duration-300 hover:text-purple-400">Riley Edward.</a>
            </div>

            <div class="hidden md:flex md:space-x-12">
                <a :href="route('about.index')" class="transition-colors duration-300 hover:text-cyan-400">About</a>
                <a href="https://github.com/rileyedward" target="_blank" class="transition-colors duration-300 hover:text-cyan-400">Portfolio</a>
                <a :href="route('blog.index')" class="transition-colors duration-300 hover:text-cyan-400">Blog</a>
            </div>

            <button
                @click="toggleMobileMenu"
                class="flex h-8 w-8 flex-col items-center justify-center space-y-1.5 md:hidden"
                aria-label="Toggle mobile menu"
            >
                <span
                    class="block h-0.5 w-6 bg-white transition-transform duration-300"
                    :class="{ 'translate-y-2 rotate-45': isMobileMenuOpen }"
                ></span>
                <span class="block h-0.5 w-6 bg-white transition-opacity duration-300" :class="{ 'opacity-0': isMobileMenuOpen }"></span>
                <span
                    class="block h-0.5 w-6 bg-white transition-transform duration-300"
                    :class="{ '-translate-y-2 -rotate-45': isMobileMenuOpen }"
                ></span>
            </button>
        </div>

        <div
            class="overflow-hidden border-t border-gray-800 bg-[#111]/98 backdrop-blur-md transition-all duration-300 ease-in-out md:hidden"
            :class="isMobileMenuOpen ? 'max-h-screen py-4 shadow-lg' : 'max-h-0'"
        >
            <div class="container mx-auto flex flex-col px-4">
                <a
                    :href="route('about.index')"
                    class="border-b border-gray-800/30 py-4 text-lg font-medium transition-colors duration-300 hover:text-cyan-400 active:bg-gray-800/20"
                    @click="closeMobileMenu"
                    >About</a
                >
                <a
                    href="https://github.com/rileyedward"
                    target="_blank"
                    class="border-b border-gray-800/30 py-4 text-lg font-medium transition-colors duration-300 hover:text-cyan-400 active:bg-gray-800/20"
                    @click="closeMobileMenu"
                    >Portfolio</a
                >
                <a
                    :href="route('blog.index')"
                    class="py-4 text-lg font-medium transition-colors duration-300 hover:text-cyan-400 active:bg-gray-800/20"
                    @click="closeMobileMenu"
                    >Blog</a
                >
            </div>
        </div>
    </nav>
</template>
