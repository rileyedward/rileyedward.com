<script setup lang="ts">
import { onBeforeUnmount, onMounted, ref } from 'vue';

/**
 * Fades and rises its content ~8px the first time it scrolls into view.
 * Content already on screen at load, or for visitors who prefer reduced
 * motion, is shown as-is with no animation.
 */
const element = ref<HTMLElement | null>(null);
const hidden = ref(false);
let observer: IntersectionObserver | null = null;

onMounted(() => {
    const node = element.value;

    if (
        !node ||
        !('IntersectionObserver' in window) ||
        window.matchMedia('(prefers-reduced-motion: reduce)').matches ||
        node.getBoundingClientRect().top < window.innerHeight
    ) {
        return;
    }

    hidden.value = true;
    observer = new IntersectionObserver(
        (entries) => {
            if (entries.some((entry) => entry.isIntersecting)) {
                hidden.value = false;
                observer?.disconnect();
            }
        },
        { rootMargin: '0px 0px -10% 0px' },
    );
    observer.observe(node);
});

onBeforeUnmount(() => observer?.disconnect());
</script>

<template>
    <div
        ref="element"
        class="duration-500! ease-out"
        :class="
            hidden ? 'translate-y-2 opacity-0' : 'translate-y-0 opacity-100'
        "
    >
        <slot />
    </div>
</template>
