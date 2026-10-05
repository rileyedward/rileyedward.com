<script setup lang="ts">
defineProps<{
    eyebrow?: string;
    title: string;
    description?: string;
}>();
</script>

<template>
    <div class="max-w-2xl">
        <p
            v-if="eyebrow"
            class="font-mono text-xs tracking-wider text-accent-text uppercase"
        >
            {{ eyebrow }}
        </p>
        <h2
            class="mt-2 text-2xl font-semibold tracking-tight text-balance sm:text-3xl"
        >
            {{ title }}
        </h2>
        <p v-if="description" class="mt-3 text-pretty text-muted-foreground">
            {{ description }}
        </p>
    </div>
</template>
