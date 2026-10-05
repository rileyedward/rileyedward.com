<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { ArrowLeft, ArrowRight, ExternalLink, FolderGit2 } from '@lucide/vue';
import SiteBadge from '@/components/site/SiteBadge.vue';
import SiteButton from '@/components/site/SiteButton.vue';
import StackChip from '@/components/site/StackChip.vue';
import { index as work, show } from '@/routes/work';
import type { Project, ProjectLink } from '@/types';

defineProps<{
    project: Project;
    previous: ProjectLink | null;
    next: ProjectLink | null;
}>();
</script>

<template>
    <Head :title="project.title">
        <meta name="description" :content="project.summary" />
    </Head>

    <article class="mx-auto max-w-3xl px-4 pt-16 pb-8 sm:px-6 sm:pt-24">
        <Link
            :href="work()"
            class="inline-flex items-center gap-1.5 text-sm text-muted-foreground hover:text-accent-text"
        >
            <ArrowLeft class="size-4" /> All work
        </Link>

        <div class="mt-8 flex flex-wrap gap-2">
            <SiteBadge>{{ project.kindLabel }}</SiteBadge>
            <SiteBadge tone="neutral">{{ project.statusLabel }}</SiteBadge>
        </div>
        <h1
            class="mt-4 text-3xl font-semibold tracking-tight text-balance sm:text-5xl"
        >
            {{ project.title }}
        </h1>
        <p class="mt-4 text-lg text-pretty text-muted-foreground">
            {{ project.summary }}
        </p>

        <dl class="mt-8 grid gap-6 border-y border-border py-6 sm:grid-cols-2">
            <div v-if="project.role">
                <dt class="font-mono text-xs text-muted-foreground uppercase">
                    My role
                </dt>
                <dd class="mt-1.5">{{ project.role }}</dd>
            </div>
            <div v-if="project.stack.length">
                <dt class="font-mono text-xs text-muted-foreground uppercase">
                    Stack
                </dt>
                <dd class="mt-2 flex flex-wrap gap-1.5">
                    <StackChip v-for="item in project.stack" :key="item">{{
                        item
                    }}</StackChip>
                </dd>
            </div>
        </dl>

        <div
            v-if="project.liveUrl || project.repoUrl"
            class="mt-6 flex flex-wrap gap-3"
        >
            <SiteButton v-if="project.liveUrl" :href="project.liveUrl" external>
                Visit site <ExternalLink />
            </SiteButton>
            <SiteButton
                v-if="project.repoUrl"
                :href="project.repoUrl"
                external
                variant="secondary"
            >
                <FolderGit2 /> View code
            </SiteButton>
        </div>

        <img
            v-if="project.coverImageUrl"
            :src="project.coverImageUrl"
            :alt="`Screenshot of ${project.title}`"
            class="mt-10 w-full rounded-2xl border border-border"
            width="1600"
            height="1000"
            loading="lazy"
        />

        <div
            v-if="project.bodyHtml"
            class="prose-site mt-10"
            v-html="project.bodyHtml"
        />

        <nav
            v-if="previous || next"
            aria-label="More projects"
            class="mt-16 grid gap-4 border-t border-border pt-8 sm:grid-cols-2"
        >
            <Link
                v-if="previous"
                :href="show(previous.slug)"
                class="group rounded-2xl border border-border p-4 hover:border-accent-500/50"
            >
                <span
                    class="flex items-center gap-1.5 text-xs text-muted-foreground"
                >
                    <ArrowLeft class="size-3.5" /> Previous
                </span>
                <span
                    class="mt-1 block font-medium group-hover:text-accent-text"
                >
                    {{ previous.title }}
                </span>
            </Link>
            <Link
                v-if="next"
                :href="show(next.slug)"
                class="group rounded-2xl border border-border p-4 text-right hover:border-accent-500/50 sm:col-start-2"
            >
                <span
                    class="flex items-center justify-end gap-1.5 text-xs text-muted-foreground"
                >
                    Next <ArrowRight class="size-3.5" />
                </span>
                <span
                    class="mt-1 block font-medium group-hover:text-accent-text"
                >
                    {{ next.title }}
                </span>
            </Link>
        </nav>
    </article>
</template>
