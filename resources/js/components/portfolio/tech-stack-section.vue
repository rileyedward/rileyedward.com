<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { getCategoryColor, getLevelColor, techStackConfig } from './tech-stack.config';

const sectionVisible = ref(false);
const categoriesVisible = ref<boolean[]>([]);

onMounted(() => {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    sectionVisible.value = true;

                    // Stagger category animations
                    techStackConfig.forEach((_, index) => {
                        setTimeout(() => {
                            categoriesVisible.value[index] = true;
                        }, index * 200);
                    });
                }
            });
        },
        { threshold: 0.1 },
    );

    const element = document.querySelector('#tech-stack-section');
    if (element) {
        observer.observe(element);
    }

    return () => observer.disconnect();
});

const selectedCategory = ref<string | null>(null);

const filterByCategory = (category: string): void => {
    selectedCategory.value = selectedCategory.value === category ? null : category;
};
</script>

<template>
    <section id="tech-stack-section" class="bg-[#111] py-16 pb-8">
        <div class="container mx-auto max-w-7xl px-4">
            <!-- Section Header -->
            <div
                class="mb-12 transition-all duration-1000 ease-out"
                :class="sectionVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
            >
                <div class="flex items-end justify-between border-b border-gray-700 pb-6">
                    <div>
                        <h2 class="text-3xl font-bold text-white md:text-4xl">My <span class="text-purple-400">Tech Stack</span></h2>
                        <p class="mt-2 max-w-2xl text-lg text-gray-400">Technologies and tools I use to build solutions</p>
                    </div>
                </div>
            </div>

            <!-- Category Filter Buttons -->
            <div
                class="mb-12 flex flex-wrap justify-center gap-3 transition-all duration-1000 ease-out"
                :class="sectionVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
            >
                <button
                    @click="filterByCategory('')"
                    :class="[
                        'rounded-full px-6 py-2 font-medium transition-all duration-300',
                        !selectedCategory
                            ? 'bg-purple-600 text-white shadow-lg'
                            : 'bg-gray-800 text-gray-300 shadow-md hover:bg-gray-700 hover:shadow-lg',
                    ]"
                >
                    All
                </button>
                <button
                    v-for="category in techStackConfig"
                    :key="category.name"
                    @click="filterByCategory(category.name)"
                    :class="[
                        'rounded-full px-6 py-2 font-medium transition-all duration-300',
                        selectedCategory === category.name
                            ? 'bg-purple-600 text-white shadow-lg'
                            : 'bg-gray-800 text-gray-300 shadow-md hover:bg-gray-700 hover:shadow-lg',
                    ]"
                >
                    {{ category.name }}
                </button>
            </div>

            <!-- Tech Stack Categories Grid -->
            <div class="grid gap-8 lg:grid-cols-2 xl:grid-cols-3">
                <div
                    v-for="(category, categoryIndex) in techStackConfig"
                    :key="category.name"
                    v-show="!selectedCategory || selectedCategory === category.name"
                    class="transition-all duration-700 ease-out"
                    :class="categoriesVisible[categoryIndex] ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                >
                    <div :class="['rounded-xl border-2 p-6 transition-all duration-300 hover:shadow-xl', getCategoryColor(category.color)]">
                        <!-- Category Header -->
                        <div class="mb-6">
                            <h3 class="mb-2 text-2xl font-bold text-white">
                                {{ category.name }}
                            </h3>
                            <p class="text-gray-300">{{ category.description }}</p>
                        </div>

                        <!-- Tech Items -->
                        <div class="space-y-3">
                            <div
                                v-for="tech in category.items"
                                :key="tech.name"
                                class="rounded-lg bg-gray-800 p-4 shadow-sm transition-all duration-300 hover:bg-gray-700 hover:shadow-md"
                            >
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <span class="font-semibold text-white">{{ tech.name }}</span>
                                        <span :class="['rounded-full px-2 py-1 text-xs font-medium text-white', getLevelColor(tech.level)]">
                                            {{ tech.level }}
                                        </span>
                                    </div>

                                    <!-- Years experience display - outline style -->
                                    <div v-if="tech.years">
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full border border-gray-500 px-2 py-1 text-xs text-gray-400"
                                        >
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                                />
                                            </svg>
                                            {{ tech.years }}y
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeIn {
    animation: fadeIn 0.3s ease-out;
}
</style>
