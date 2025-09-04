<script setup lang="ts">
import { Props } from '@/types/components/about/about-widget';
import { ExternalLinkIcon } from 'lucide-vue-next';

const props = defineProps<Props>();

const isClickable = props.href && props.href.trim() !== '';
</script>

<template>
    <component
        :is="isClickable ? 'a' : 'div'"
        :href="isClickable ? href : undefined"
        :target="isClickable ? '_blank' : undefined"
        :rel="isClickable ? 'noopener noreferrer' : undefined"
        :class="['rounded-lg bg-purple-500 p-4 shadow-md transition-transform hover:scale-105', isClickable ? 'cursor-pointer' : '']"
    >
        <div class="mb-2 flex items-center">
            <div class="mr-2 text-white">
                <component :is="icon" class="h-5 w-5" />
            </div>
            <h3 class="text-lg font-bold text-white">{{ title }} <ExternalLinkIcon v-if="isClickable" class="ml-1 inline h-3 w-3" /></h3>
        </div>
        <p class="text-purple-100">{{ message }}</p>
    </component>
</template>
