<script setup lang="ts">
defineProps<{
    tone?: 'accent' | 'neutral';
}>();
</script>

<template>
    <span
        class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium"
        :class="
            tone === 'neutral'
                ? 'bg-muted text-muted-foreground'
                : 'bg-accent-500/10 text-accent-text ring-1 ring-accent-500/20 ring-inset'
        "
    >
        <slot />
    </span>
</template>
