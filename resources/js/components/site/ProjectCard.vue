<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowUpRight } from '@lucide/vue';
import SiteBadge from '@/components/site/SiteBadge.vue';
import SiteCard from '@/components/site/SiteCard.vue';
import StackChip from '@/components/site/StackChip.vue';
import { show } from '@/routes/work';
import type { Project } from '@/types';

defineProps<{
    project: Project;
}>();
</script>

<template>
    <SiteCard interactive class="group flex h-full flex-col">
        <div class="flex flex-wrap items-center gap-2">
            <SiteBadge>{{ project.kindLabel }}</SiteBadge>
            <SiteBadge tone="neutral">{{ project.statusLabel }}</SiteBadge>
        </div>
        <h3 class="mt-4 text-lg font-semibold tracking-tight">
            <Link
                :href="show(project.slug)"
                class="outline-none after:absolute after:inset-0 after:rounded-2xl focus-visible:after:ring-2 focus-visible:after:ring-ring"
            >
                {{ project.title }}
            </Link>
        </h3>
        <p class="mt-2 flex-1 text-sm text-muted-foreground">
            {{ project.summary }}
        </p>
        <div class="mt-5 flex items-end justify-between gap-4">
            <div class="flex flex-wrap gap-1.5">
                <StackChip v-for="item in project.stack" :key="item">{{
                    item
                }}</StackChip>
            </div>
            <ArrowUpRight
                class="size-4 shrink-0 text-muted-foreground group-hover:text-accent-text"
            />
        </div>
    </SiteCard>
</template>
