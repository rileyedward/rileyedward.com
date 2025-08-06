<script setup lang="ts">
import AboutWidget from './about-widget.vue';
import { aboutWidgets } from './about-widgets.config';
</script>

<template>
    <section class="bg-[#111] py-24">
        <div class="mx-auto max-w-4xl">
            <div class="mb-12 transition-all duration-1000 ease-out">
                <div class="flex flex-col items-center border-b border-gray-700 pb-6">
                    <div class="text-center">
                        <h2 class="text-3xl font-bold text-white md:text-4xl">Beyond the <span class="text-purple-400">Code</span></h2>
                        <p class="mt-2 max-w-2xl text-lg text-gray-400">A glimpse into my interests and hobbies.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                <about-widget
                    v-for="(widget, index) in aboutWidgets"
                    :key="index"
                    :icon="widget.icon"
                    :title="widget.title"
                    :message="widget.message"
                    :href="widget.href"
                />
            </div>
        </div>
    </section>
</template>
