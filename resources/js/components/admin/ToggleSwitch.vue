<script setup lang="ts">
defineProps<{
    label: string;
}>();

const checked = defineModel<boolean>({ required: true });
</script>

<template>
    <button
        type="button"
        role="switch"
        :aria-checked="checked"
        :aria-label="label"
        class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer items-center rounded-full transition-colors outline-none focus-visible:ring-2 focus-visible:ring-ring"
        :class="checked ? 'bg-accent-600' : 'bg-input'"
        @click="checked = !checked"
    >
        <span
            class="inline-block size-4 rounded-full bg-white shadow transition-transform"
            :class="checked ? 'translate-x-4.5' : 'translate-x-0.5'"
        />
    </button>
</template>
