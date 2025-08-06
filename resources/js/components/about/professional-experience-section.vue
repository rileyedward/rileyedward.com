<script setup lang="ts">
import { computed, onMounted, ref } from 'vue';
import type { ProfessionalExperience } from '@/types/components/about/professional-experience';
import { professionalExperiences, getCompanySizeLabel, calculateExperience } from './professional-experience.config';

const sectionVisible = ref(false);
const experiencesVisible = ref<boolean[]>([]);
const activeExperienceIndex = ref(0);
const isExpanded = ref(false);

onMounted(() => {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    sectionVisible.value = true;

                    // Stagger experience animations
                    professionalExperiences.forEach((_, index) => {
                        setTimeout(() => {
                            experiencesVisible.value[index] = true;
                        }, index * 200);
                    });
                }
            });
        },
        { threshold: 0.1 }
    );

    const element = document.querySelector('#professional-experience-section');
    if (element) {
        observer.observe(element);
    }

    return () => observer.disconnect();
});

const setActiveExperience = (index: number): void => {
    activeExperienceIndex.value = index;
    isExpanded.value = false; // Reset expansion when switching tabs
};

const toggleExpansion = (): void => {
    isExpanded.value = !isExpanded.value;
};

const formatDate = (dateString: string): string => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short' });
};

const getExperienceDuration = (startDate: string, endDate?: string): string => {
    const start = new Date(startDate);
    const end = endDate ? new Date(endDate) : new Date();

    const months = (end.getFullYear() - start.getFullYear()) * 12 + (end.getMonth() - start.getMonth());
    const years = Math.floor(months / 12);
    const remainingMonths = months % 12;

    if (years === 0) {
        return `${remainingMonths} ${remainingMonths === 1 ? 'month' : 'months'}`;
    } else if (remainingMonths === 0) {
        return `${years} ${years === 1 ? 'year' : 'years'}`;
    } else {
        return `${years} ${years === 1 ? 'year' : 'years'}, ${remainingMonths} ${remainingMonths === 1 ? 'month' : 'months'}`;
    }
};

const experienceStats = computed(() => calculateExperience());
</script>

<template>
    <section id="professional-experience-section" class="bg-[#111] py-16">
        <div class="container mx-auto max-w-7xl px-4">
            <!-- Section Header -->
            <div
                class="mb-12 transition-all duration-1000 ease-out"
                :class="sectionVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
            >
                <div class="flex items-end justify-between border-b border-gray-700 pb-6">
                    <div>
                        <h2 class="text-3xl font-bold text-white md:text-4xl">
                            Professional <span class="text-purple-400">Experience</span>
                        </h2>
                        <p class="mt-2 max-w-2xl text-lg text-gray-400">
                            {{ experienceStats.totalYears }}+ years of professional software development experience
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="mb-8">
                <div class="flex flex-wrap gap-2">
                    <button
                        v-for="(experience, index) in professionalExperiences"
                        :key="experience.id"
                        @click="setActiveExperience(index)"
                        class="rounded-lg px-4 py-2 text-sm font-medium transition-all duration-200"
                        :class="activeExperienceIndex === index
                            ? 'bg-purple-600 text-white shadow-lg'
                            : 'bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-white'
                        "
                    >
                        {{ experience.company }}
                    </button>
                </div>
            </div>

            <!-- Active Experience Details -->
            <div
                v-if="professionalExperiences[activeExperienceIndex]"
                class="animate-fadeIn rounded-xl border border-gray-800 bg-gray-900 p-8 cursor-pointer transition-all duration-300 hover:border-purple-500"
                @click="toggleExpansion"
            >
                <div class="mb-6">
                    <div class="mb-4 flex items-start justify-between">
                        <div class="flex-1">
                            <div class="mb-2 flex flex-col gap-1 sm:flex-row sm:items-center sm:gap-4">
                                <h3 class="text-2xl font-bold text-white">
                                    {{ professionalExperiences[activeExperienceIndex].position }}
                                </h3>
                                <div class="flex items-center gap-2">
                                    <span class="text-purple-400 font-medium text-xl">@</span>
                                    <span class="text-purple-400 font-medium text-xl">{{ professionalExperiences[activeExperienceIndex].company }}</span>
                                </div>
                            </div>

                            <div class="mb-4 flex flex-wrap items-center gap-4 text-sm text-gray-400">
                                <div class="flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ formatDate(professionalExperiences[activeExperienceIndex].startDate) }} - {{ professionalExperiences[activeExperienceIndex].endDate ? formatDate(professionalExperiences[activeExperienceIndex].endDate) : 'Present' }}
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    {{ getExperienceDuration(professionalExperiences[activeExperienceIndex].startDate, professionalExperiences[activeExperienceIndex].endDate) }}
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ professionalExperiences[activeExperienceIndex].location }}
                                </div>
                            </div>

                            <p class="mb-4 text-lg text-gray-300">{{ professionalExperiences[activeExperienceIndex].description }}</p>

                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span>{{ getCompanySizeLabel(professionalExperiences[activeExperienceIndex].companySize) }}</span>
                            </div>
                        </div>

                        <!-- Expand Icon -->
                        <svg
                            class="h-5 w-5 text-gray-400 transition-transform duration-200 hover:text-purple-400"
                            :class="isExpanded ? 'rotate-180' : ''"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                <!-- Expanded Details -->
                <div
                    v-if="isExpanded"
                    class="animate-fadeIn border-t border-gray-700 pt-6"
                    @click.stop
                >
                    <!-- Key Achievements -->
                    <div class="mb-8">
                        <h4 class="mb-4 text-xl font-semibold text-white">Key Achievements</h4>
                        <ul class="space-y-3">
                            <li
                                v-for="achievement in professionalExperiences[activeExperienceIndex].keyAchievements"
                                :key="achievement"
                                class="flex items-start gap-3 text-gray-300"
                            >
                                <span class="mt-2 h-2 w-2 flex-shrink-0 rounded-full bg-purple-400"></span>
                                {{ achievement }}
                            </li>
                        </ul>
                    </div>

                    <!-- Technologies Used -->
                    <div class="mb-8">
                        <h4 class="mb-4 text-xl font-semibold text-white">Technologies Used</h4>
                        <div class="flex flex-wrap gap-2">
                            <span
                                v-for="tech in professionalExperiences[activeExperienceIndex].technologies"
                                :key="tech"
                                class="rounded-full bg-purple-600 px-4 py-2 text-sm font-medium text-white"
                            >
                                {{ tech }}
                            </span>
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
