<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

type Props = {
    className?: HTMLAttributes['class'];
};

defineProps<Props>();
</script>

<template>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 40 40"
        :class="className"
        v-bind="$attrs"
        aria-hidden="true"
    >
        <text
            x="20"
            y="26"
            text-anchor="middle"
            font-family="ui-monospace, monospace"
            font-size="16"
            font-weight="700"
            fill="currentColor"
        >
            RE
        </text>
    </svg>
</template>
