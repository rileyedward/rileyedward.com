<script setup lang="ts">
import { timelineItems } from './about-timeline.config';
</script>

<template>
    <section class="bg-[#111] pt-24 pb-16">
        <div class="container mx-auto px-4">
            <div class="mb-16 text-center">
                <h2 class="mb-2 text-3xl font-bold text-white">My Journey</h2>
                <div class="flex justify-center">
                    <div class="h-1 w-16 bg-cyan-500 opacity-80"></div>
                </div>
            </div>

            <div class="mx-auto max-w-5xl">
                <div v-for="(item, index) in timelineItems" :key="index" class="mb-24 last:mb-0">
                    <div class="flex flex-col md:flex-row" :class="{ 'md:flex-row-reverse': item.align === 'right' }">
                        <div class="hidden justify-center md:flex md:w-1/12">
                            <div class="relative">
                                <div class="absolute left-1/2 h-full w-1 -translate-x-1/2 transform bg-gray-700"></div>
                                <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 transform">
                                    <div class="h-4 w-4 rounded-full bg-cyan-600 ring-2 ring-cyan-400/30"></div>
                                </div>
                            </div>
                        </div>

                        <div class="md:w-11/12" :class="{ 'text-right md:pr-12': item.align === 'right', 'md:pl-12': item.align === 'left' }">
                            <div
                                class="rounded-lg bg-[#1a1a1a] p-6 shadow-lg transition-all duration-300 hover:translate-y-[-2px] hover:shadow-cyan-900/20"
                            >
                                <h3 class="mb-1 text-2xl font-bold text-white">{{ item.title }}</h3>
                                <p class="mb-4 text-sm text-cyan-300">{{ item.subtitle }}</p>
                                <div class="space-y-4 text-gray-300">
                                    <p v-for="(paragraph, pIndex) in item.description.trim().split('\n\n')" :key="pIndex" class="leading-relaxed">
                                        {{ paragraph.trim() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
