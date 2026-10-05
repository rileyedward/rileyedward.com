<script setup lang="ts">
import { Check } from '@lucide/vue';
import { useAccent } from '@/composables/useAccent';
import { accents } from '@/lib/accents';

const { accent, updateAccent } = useAccent();
</script>

<template>
    <div
        class="flex flex-wrap gap-2"
        role="radiogroup"
        aria-label="Accent color"
    >
        <button
            v-for="name in accents"
            :key="name"
            type="button"
            role="radio"
            :aria-checked="accent === name"
            :aria-label="name"
            :title="name"
            :data-accent="name"
            class="flex size-6 cursor-pointer items-center justify-center rounded-full bg-accent-500 ring-offset-2 ring-offset-background outline-none hover:scale-110 focus-visible:ring-2 focus-visible:ring-accent-500"
            :class="{ 'ring-2 ring-accent-500': accent === name }"
            @click="updateAccent(name)"
        >
            <Check v-if="accent === name" class="size-3.5 text-white" />
        </button>
    </div>
</template>
