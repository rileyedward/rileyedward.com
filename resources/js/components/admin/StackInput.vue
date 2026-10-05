<script setup lang="ts">
import { X } from '@lucide/vue';
import { ref } from 'vue';

defineProps<{
    name: string;
}>();

const items = defineModel<string[]>({ required: true });
const draft = ref('');

function add() {
    const value = draft.value.trim().replace(/,$/, '');

    if (
        value &&
        !items.value.some((item) => item.toLowerCase() === value.toLowerCase())
    ) {
        items.value = [...items.value, value];
    }

    draft.value = '';
}

function remove(index: number) {
    items.value = items.value.filter((_, position) => position !== index);
}

function onBackspace() {
    if (!draft.value && items.value.length) {
        remove(items.value.length - 1);
    }
}
</script>

<template>
    <div
        class="flex min-h-9 flex-wrap items-center gap-1.5 rounded-md border border-input bg-transparent px-2 py-1.5 focus-within:border-ring focus-within:ring-[3px] focus-within:ring-ring/50"
    >
        <span
            v-for="(item, index) in items"
            :key="item"
            class="inline-flex items-center gap-1 rounded-md bg-muted px-2 py-0.5 font-mono text-xs"
        >
            {{ item }}
            <input type="hidden" :name="`${name}[]`" :value="item" />
            <button
                type="button"
                class="text-muted-foreground hover:text-foreground"
                :aria-label="`Remove ${item}`"
                @click="remove(index)"
            >
                <X class="size-3" />
            </button>
        </span>
        <input
            v-model="draft"
            type="text"
            class="min-w-24 flex-1 bg-transparent text-sm outline-none"
            placeholder="Add tech, press Enter"
            @keydown.enter.prevent="add"
            @keydown.,.prevent="add"
            @keydown.backspace="onBackspace"
            @blur="add"
        />
    </div>
</template>
