<script setup lang="ts">
import JavascriptIcon from '@/components/icons/javascript-icon.vue';
import LaravelIcon from '@/components/icons/laravel-icon.vue';
import MysqlIcon from '@/components/icons/mysql-icon.vue';
import PhpIcon from '@/components/icons/php-icon.vue';
import PostgresqlIcon from '@/components/icons/postgresql-icon.vue';
import ReactIcon from '@/components/icons/react-icon.vue';
import SvelteIcon from '@/components/icons/svelte-icon.vue';
import TypescriptIcon from '@/components/icons/typescript-icon.vue';
import VueIcon from '@/components/icons/vue-icon.vue';

const technologies = [
    { name: 'JavaScript', icon: JavascriptIcon },
    { name: 'TypeScript', icon: TypescriptIcon },
    { name: 'Vue.js', icon: VueIcon },
    { name: 'React', icon: ReactIcon },
    { name: 'Svelte', icon: SvelteIcon },
    { name: 'PHP', icon: PhpIcon },
    { name: 'Laravel', icon: LaravelIcon },
    { name: 'MySQL', icon: MysqlIcon },
    { name: 'PostgreSQL', icon: PostgresqlIcon },
];
</script>

<template>
    <section class="py-20 bg-[#1a1a1a]">
        <div class="container mx-auto max-w-6xl px-6">
            <div class="mb-8 text-center">
                <h2 class="mb-3 text-2xl font-bold text-white md:text-3xl">
                    My <span class="text-cyan-400">Tech</span>
                </h2>
                <p class="text-gray-300">
                    My recent favorite tools and technologies
                </p>
            </div>

            <div class="relative overflow-hidden">
                <div class="flex animate-scroll space-x-12 md:space-x-16">
                    <div v-for="tech in technologies" :key="`first-${tech.name}`" class="flex flex-shrink-0 flex-col items-center group">
                        <div class="mb-3 rounded-lg bg-black/50 p-4 transition-all duration-300 hover:bg-black/50 hover:scale-110 hover:shadow-lg hover:shadow-cyan-500/20">
                            <component :is="tech.icon" class="h-12 w-12 opacity-80 transition-opacity duration-300 group-hover:opacity-100" />
                        </div>
                        <span class="text-sm font-medium text-gray-400 transition-colors duration-300 group-hover:text-white">
                            {{ tech.name }}
                        </span>
                    </div>

                    <div v-for="tech in technologies" :key="`second-${tech.name}`" class="flex flex-shrink-0 flex-col items-center group">
                        <div class="mb-3 rounded-lg bg-black/50 p-4 transition-all duration-300 hover:bg-black/50 hover:scale-110 hover:shadow-lg hover:shadow-cyan-500/20">
                            <component :is="tech.icon" class="h-12 w-12 opacity-80 transition-opacity duration-300 group-hover:opacity-100" />
                        </div>
                        <span class="text-sm font-medium text-gray-400 transition-colors duration-300 group-hover:text-white">
                            {{ tech.name }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

.animate-scroll {
    animation: scroll 20s linear infinite;
}

.animate-scroll:hover {
    animation-play-state: paused;
}
</style>
