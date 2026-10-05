<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import ProjectCard from '@/components/site/ProjectCard.vue';
import Reveal from '@/components/site/Reveal.vue';
import { index as work } from '@/routes/work';
import type { Project, ProjectKind } from '@/types';

const props = defineProps<{
    projects: Project[];
    kind: ProjectKind | null;
}>();

const filters: { label: string; kind: ProjectKind | null }[] = [
    { label: 'All', kind: null },
    { label: 'Client', kind: 'client' },
    { label: 'Personal', kind: 'personal' },
];

const filterHref = (kind: ProjectKind | null) =>
    work(kind ? { query: { kind } } : undefined);
</script>

<template>
    <Head title="Work">
        <meta
            name="description"
            content="Client and personal projects by Riley Edward, a Kansas City Laravel developer."
        />
    </Head>

    <section class="mx-auto max-w-6xl px-4 pt-16 pb-8 sm:px-6 sm:pt-24">
        <p class="font-mono text-xs tracking-wider text-accent-text uppercase">
            Work
        </p>
        <h1
            class="mt-2 text-3xl font-semibold tracking-tight text-balance sm:text-5xl"
        >
            Things I've built
        </h1>
        <p class="mt-4 max-w-2xl text-lg text-muted-foreground">
            Client projects for real businesses, plus the personal projects I
            build to learn and scratch my own itches.
        </p>

        <nav aria-label="Filter projects" class="mt-8 flex flex-wrap gap-2">
            <Link
                v-for="filter in filters"
                :key="filter.label"
                :href="filterHref(filter.kind)"
                preserve-scroll
                :aria-current="props.kind === filter.kind ? 'true' : undefined"
                class="rounded-full border px-4 py-1.5 text-sm outline-none focus-visible:ring-2 focus-visible:ring-ring"
                :class="
                    props.kind === filter.kind
                        ? 'border-accent-500/40 bg-accent-500/10 text-accent-text'
                        : 'border-border text-muted-foreground hover:text-foreground'
                "
            >
                {{ filter.label }}
            </Link>
        </nav>
    </section>

    <section class="mx-auto max-w-6xl px-4 pb-8 sm:px-6">
        <div
            v-if="projects.length"
            class="grid gap-4 md:grid-cols-2 lg:grid-cols-3"
        >
            <Reveal v-for="project in projects" :key="project.id">
                <ProjectCard :project="project" />
            </Reveal>
        </div>
        <p
            v-else
            class="rounded-2xl border border-dashed border-border p-10 text-center text-muted-foreground"
        >
            Nothing to show here yet. Check back soon.
        </p>
    </section>
</template>
