<script setup lang="ts">
import type { Project } from '@/types/components/portfolio/project-showcase';
import { onMounted, ref } from 'vue';
import { getTypeIcon, projects } from './project-showcase.config';

const sectionVisible = ref(false);
const projectsVisible = ref<boolean[]>([]);
const selectedProject = ref<Project | null>(null);

onMounted(() => {
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    sectionVisible.value = true;

                    // Stagger project animations
                    projects.forEach((_, index) => {
                        setTimeout(() => {
                            projectsVisible.value[index] = true;
                        }, index * 150);
                    });
                }
            });
        },
        { threshold: 0.1 },
    );

    const element = document.querySelector('#project-showcase-section');
    if (element) {
        observer.observe(element);
    }

    return () => observer.disconnect();
});

const selectProject = (project: Project): void => {
    selectedProject.value = selectedProject.value?.id === project.id ? null : project;
};
</script>

<template>
    <section id="project-showcase-section" class="bg-[#111] pt-8 pb-24">
        <div class="container mx-auto max-w-7xl px-4">
            <!-- Section Header -->
            <div
                class="mb-12 transition-all duration-1000 ease-out"
                :class="sectionVisible ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
            >
                <div class="flex items-end justify-between border-b border-gray-700 pb-6">
                    <div>
                        <h2 class="text-3xl font-bold text-white md:text-4xl">Featured <span class="text-purple-400">Projects</span></h2>
                        <p class="mt-2 max-w-2xl text-lg text-gray-400">Web applications and tools I've built and learned from</p>
                    </div>
                </div>
            </div>

            <!-- Projects Grid -->
            <div class="grid gap-8 lg:grid-cols-2 xl:grid-cols-3">
                <div
                    v-for="(project, projectIndex) in projects"
                    :key="project.id"
                    class="transition-all duration-700 ease-out"
                    :class="projectsVisible[projectIndex] ? 'translate-y-0 opacity-100' : 'translate-y-8 opacity-0'"
                >
                    <div
                        class="group cursor-pointer rounded-xl border border-gray-800 bg-gray-900 p-6 transition-all duration-300 hover:border-purple-500 hover:shadow-xl"
                        @click="selectProject(project)"
                    >
                        <!-- Project Header -->
                        <div class="mb-4 flex items-start justify-between">
                            <div class="flex items-start gap-3">
                                <span class="text-2xl">{{ getTypeIcon(project.type) }}</span>
                                <div>
                                    <h3 class="text-xl font-bold text-white transition-colors group-hover:text-purple-400">
                                        {{ project.title }}
                                    </h3>
                                </div>
                            </div>

                            <!-- Expand Icon -->
                            <svg
                                class="h-5 w-5 text-gray-400 transition-transform duration-200 group-hover:text-purple-400"
                                :class="selectedProject?.id === project.id ? 'rotate-180' : ''"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>

                        <!-- Short Description -->
                        <p class="mb-4 text-gray-300">{{ project.shortDescription }}</p>

                        <!-- Tech Stack Preview -->
                        <div class="mb-4 flex flex-wrap gap-2">
                            <span
                                v-for="tech in project.technologies.slice(0, 4)"
                                :key="tech.name"
                                class="rounded-full bg-gray-800 px-2 py-1 text-xs text-gray-300"
                            >
                                {{ tech.name }}
                            </span>
                            <span v-if="project.technologies.length > 4" class="rounded-full bg-gray-800 px-2 py-1 text-xs text-gray-400">
                                +{{ project.technologies.length - 4 }} more
                            </span>
                        </div>

                        <!-- Project Links -->
                        <div class="flex gap-2">
                            <a
                                v-for="link in project.links"
                                :key="link.type"
                                :href="link.url"
                                target="_blank"
                                rel="noopener noreferrer"
                                @click.stop
                                class="inline-flex items-center gap-1 rounded-md bg-purple-600 px-3 py-1 text-xs font-medium text-white transition-colors hover:bg-purple-700"
                            >
                                <svg v-if="link.type === 'github'" class="h-3 w-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"
                                    />
                                </svg>
                                <svg v-else-if="link.type === 'live'" class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"
                                    />
                                </svg>
                                <svg v-else-if="link.type === 'blog'" class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                    />
                                </svg>
                                <svg v-else class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                    />
                                </svg>
                                {{ link.label }}
                            </a>
                        </div>

                        <!-- Expanded Details -->
                        <div v-if="selectedProject?.id === project.id" class="animate-fadeIn mt-6 border-t border-gray-700 pt-6">
                            <!-- Full Description -->
                            <div class="mb-6">
                                <h4 class="mb-2 font-semibold text-white">About This Project</h4>
                                <p class="text-gray-300">{{ project.fullDescription }}</p>
                            </div>

                            <!-- All Technologies -->
                            <div class="mb-6">
                                <h4 class="mb-3 font-semibold text-white">Technologies Used</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span
                                        v-for="tech in project.technologies"
                                        :key="tech.name"
                                        class="rounded-full bg-purple-600 px-3 py-1 text-sm text-white"
                                    >
                                        {{ tech.name }}
                                    </span>
                                </div>
                            </div>

                            <!-- Key Features -->
                            <div class="mb-6">
                                <h4 class="mb-3 font-semibold text-white">Key Features</h4>
                                <ul class="space-y-2">
                                    <li v-for="feature in project.features" :key="feature" class="flex items-start gap-2 text-gray-300">
                                        <span class="mt-2 h-1 w-1 flex-shrink-0 rounded-full bg-purple-400"></span>
                                        {{ feature }}
                                    </li>
                                </ul>
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
