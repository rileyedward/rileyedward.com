<script setup lang="ts">
import type { InertiaLinkProps } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { cn } from '@/lib/utils';

const props = withDefaults(
    defineProps<{
        href?: NonNullable<InertiaLinkProps['href']>;
        external?: boolean;
        variant?: 'primary' | 'secondary';
        type?: 'button' | 'submit';
        disabled?: boolean;
        class?: string;
    }>(),
    { variant: 'primary', type: 'button' },
);

const classes = computed(() =>
    cn(
        'inline-flex h-11 items-center justify-center gap-2 rounded-full px-5 text-sm font-medium outline-none hover:-translate-y-0.5 focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 focus-visible:ring-offset-background disabled:pointer-events-none disabled:opacity-60 [&_svg]:size-4',
        props.variant === 'primary'
            ? 'bg-accent-600 text-white shadow-sm shadow-accent-600/20 hover:bg-accent-700'
            : 'border border-border bg-card text-foreground hover:border-accent-500/50',
        props.class,
    ),
);
</script>

<template>
    <a
        v-if="href && external"
        :href="typeof href === 'string' ? href : href.url"
        target="_blank"
        rel="noopener"
        :class="classes"
    >
        <slot />
    </a>
    <Link v-else-if="href" :href="href" :class="classes">
        <slot />
    </Link>
    <button v-else :type="type" :disabled="disabled" :class="classes">
        <slot />
    </button>
</template>
