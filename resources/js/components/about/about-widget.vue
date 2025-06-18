<script setup lang="ts">
import { Props } from '@/types/components/about/about-widget';

defineProps<Props>();
</script>

<template>
    <div class="rounded-lg bg-purple-500 p-4 shadow-md transition-transform hover:scale-105">
        <div class="mb-2 flex items-center">
            <div class="mr-2 text-white">
                <component :is="icon" class="h-5 w-5" />
            </div>
            <h3 class="text-lg font-bold text-white">{{ title }}</h3>
        </div>
        <p class="text-purple-100">{{ message }}</p>
    </div>
</template>
