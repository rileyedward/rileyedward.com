<script setup lang="ts">
import { cn } from '@/lib/utils';

const props = defineProps<{
    interactive?: boolean;
    class?: string;
}>();
</script>

<template>
    <div
        :class="
            cn(
                'relative rounded-2xl border border-border bg-card p-6',
                props.interactive &&
                    'hover:-translate-y-0.5 hover:border-accent-500/50 hover:shadow-[0_0_0_1px_color-mix(in_oklch,var(--accent-500)_25%,transparent),0_12px_32px_-12px_color-mix(in_oklch,var(--accent-500)_35%,transparent)]',
                props.class,
            )
        "
    >
        <slot />
    </div>
</template>
