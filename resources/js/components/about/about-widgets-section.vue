<script setup lang="ts">
import AboutWidget from './about-widget.vue';
import { aboutWidgets } from './about-widgets.config';
</script>

<template>
    <section class="mx-auto max-w-6xl py-36">
        <div class="container mx-auto px-4">
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
