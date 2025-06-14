<script setup lang="ts">
import { Props } from '@/types/layouts/app-layout';
import { Head as InertiaHead } from '@inertiajs/vue3';

withDefaults(defineProps<Props>(), {
    pageTitle: 'Riley Edward',
});
</script>

<template>
    <inertia-head :title="pageTitle" />

    <main>
        <slot />
    </main>
</template>
