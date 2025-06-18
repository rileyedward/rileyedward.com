<script setup lang="ts">
import { Emits, Props } from '@/types/components/blog/blog-search-filter';
import { ref, watch } from 'vue';

const props = defineProps<Props>();
const emit = defineEmits<Emits>();

const searchQuery = ref<string>('');
const selectedCategory = ref<number | null>(null);

watch(
    searchQuery,
    (newQuery: string): void => {
        emit('update:searchQuery', newQuery);
    },
    { immediate: true },
);

watch(
    selectedCategory,
    (newCategory: number | null): void => {
        emit('update:selectedCategory', newCategory);
    },
    { immediate: true },
);

const resetFilters = (): void => {
    searchQuery.value = '';
    selectedCategory.value = null;
};
</script>

<template>
    <div class="mb-8 rounded-lg bg-[#1a1a1a] p-6 shadow-lg">
        <div class="flex flex-col gap-4 md:flex-row">
            <div class="flex-1">
                <label for="search" class="mb-1 block text-sm font-medium text-gray-400">Search Posts</label>
                <div class="relative">
                    <input
                        id="search"
                        v-model="searchQuery"
                        type="text"
                        placeholder="Search by title..."
                        class="relative z-10 w-full rounded-md border border-gray-700 bg-[#222] px-4 py-2 text-white placeholder-gray-500 focus:border-transparent focus:ring-2 focus:ring-purple-500 focus:outline-none"
                        :disabled="false"
                    />
                    <button
                        v-if="searchQuery"
                        @click="searchQuery = ''"
                        class="absolute top-1/2 right-3 -translate-y-1/2 text-gray-400 hover:text-white"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="md:w-1/3">
                <label for="category" class="mb-1 block text-sm font-medium text-gray-400">Filter by Category</label>
                <select
                    id="category"
                    v-model="selectedCategory"
                    class="relative z-10 w-full rounded-md border border-gray-700 bg-[#222] px-4 py-2 text-white focus:border-transparent focus:ring-2 focus:ring-purple-500 focus:outline-none"
                    :disabled="false"
                >
                    <option :value="null">All Categories</option>
                    <option v-for="category in props.categories" :key="category.id" :value="category.id">
                        {{ category.name }}
                    </option>
                </select>
            </div>

            <div class="flex items-end">
                <button
                    @click="resetFilters"
                    class="rounded-md bg-[#222] px-4 py-2 text-gray-300 hover:bg-[#333] focus:ring-2 focus:ring-purple-500 focus:outline-none"
                    :class="{ 'cursor-not-allowed opacity-50': !searchQuery && selectedCategory === null }"
                    :disabled="!searchQuery && selectedCategory === null"
                >
                    Reset
                </button>
            </div>
        </div>

        <div class="mt-4 text-sm text-gray-400">
            <p>
                <span v-if="searchQuery">Searching for "{{ searchQuery }}"</span>
                <span v-if="selectedCategory !== null">
                    <span v-if="searchQuery"> in </span>
                    <span v-else>Filtering by </span>
                    {{ props.categories.find((c) => c.id === selectedCategory)?.name }}
                </span>
                <span v-if="!searchQuery && selectedCategory === null">All posts</span>
            </p>
        </div>
    </div>
</template>
