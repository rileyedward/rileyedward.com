<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import {
    ArrowRight,
    BarChart3,
    MapPin,
    RefreshCw,
    ShoppingBag,
    Wrench,
} from '@lucide/vue';
import GradientBlobs from '@/components/site/GradientBlobs.vue';
import ProjectCard from '@/components/site/ProjectCard.vue';
import Reveal from '@/components/site/Reveal.vue';
import SectionHeading from '@/components/site/SectionHeading.vue';
import SiteButton from '@/components/site/SiteButton.vue';
import SiteCard from '@/components/site/SiteCard.vue';
import { create as contact } from '@/routes/contact';
import { index as work } from '@/routes/work';
import type { Project } from '@/types';

defineProps<{
    featuredProjects: Project[];
}>();

const kindsOfWork = [
    {
        Icon: ShoppingBag,
        title: 'Online stores and checkout',
        text: 'Sell products or book services online with payments that land in your account.',
    },
    {
        Icon: Wrench,
        title: 'Custom tools for running a business',
        text: 'Replace the spreadsheet and sticky notes with software shaped around how you work.',
    },
    {
        Icon: BarChart3,
        title: 'Dashboards and reporting',
        text: 'See the numbers that matter in one place instead of digging through exports.',
    },
    {
        Icon: RefreshCw,
        title: 'Rebuilding an outdated site',
        text: 'Turn a slow, hard-to-update site into something fast that you can edit yourself.',
    },
];
</script>

<template>
    <Head title="Kansas City web developer">
        <meta
            name="description"
            content="Riley Edward is a Kansas City Laravel developer building custom web apps for local businesses."
        />
    </Head>

    <section class="relative isolate">
        <GradientBlobs />
        <div
            class="mx-auto max-w-6xl px-4 pt-20 pb-24 sm:px-6 sm:pt-28 sm:pb-32"
        >
            <p
                class="inline-flex items-center gap-1.5 font-mono text-xs tracking-wider text-accent-text uppercase"
            >
                <MapPin class="size-3.5" /> Kansas City, MO
            </p>
            <!-- TODO(Riley): hero headline in your own words. -->
            <h1
                class="mt-4 max-w-3xl text-4xl font-semibold tracking-tight text-balance sm:text-6xl"
            >
                Riley Edward, a Kansas City developer building custom web apps
                for local businesses.
            </h1>
            <p class="mt-6 max-w-2xl text-lg text-pretty text-muted-foreground">
                I build the software your business actually needs, from a
                storefront with checkout to the internal tool that runs your
                day, and I'm just down the road when you want to talk it
                through.
            </p>
            <div class="mt-10 flex flex-wrap gap-3">
                <SiteButton :href="contact()">
                    Start a project <ArrowRight />
                </SiteButton>
                <SiteButton :href="work()" variant="secondary">
                    See my work
                </SiteButton>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
        <Reveal>
            <SectionHeading
                eyebrow="What I build"
                title="Whatever your business needs, built to fit."
                description="No fixed menu. A few of the kinds of things I make:"
            />
        </Reveal>
        <div class="mt-10 grid gap-4 sm:grid-cols-2">
            <Reveal v-for="item in kindsOfWork" :key="item.title">
                <SiteCard class="h-full">
                    <component
                        :is="item.Icon"
                        class="size-5 text-accent-text"
                    />
                    <h3 class="mt-4 font-semibold">{{ item.title }}</h3>
                    <p class="mt-1.5 text-sm text-muted-foreground">
                        {{ item.text }}
                    </p>
                </SiteCard>
            </Reveal>
        </div>
    </section>

    <section
        v-if="featuredProjects.length"
        class="mx-auto max-w-6xl px-4 py-16 sm:px-6"
    >
        <Reveal>
            <div class="flex flex-wrap items-end justify-between gap-4">
                <SectionHeading
                    eyebrow="Selected work"
                    title="Recent projects"
                />
                <SiteButton :href="work()" variant="secondary">
                    All work <ArrowRight />
                </SiteButton>
            </div>
        </Reveal>
        <div class="mt-10 grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <Reveal v-for="project in featuredProjects" :key="project.id">
                <ProjectCard :project="project" />
            </Reveal>
        </div>
    </section>

    <section class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
        <Reveal>
            <SiteCard
                class="grid gap-6 sm:grid-cols-[auto_1fr] sm:items-center"
            >
                <div
                    class="flex size-12 items-center justify-center rounded-full bg-accent-500/10 text-accent-text"
                >
                    <MapPin class="size-5" />
                </div>
                <div>
                    <h2 class="text-lg font-semibold">
                        Local, and happy to meet
                    </h2>
                    <p class="mt-1.5 text-muted-foreground">
                        I'm based in Kansas City and work with businesses in
                        Brookside and around town. If you'd rather talk in
                        person, I'll come to you, and I'm just as happy to work
                        with anyone else over a call.
                    </p>
                </div>
            </SiteCard>
        </Reveal>
    </section>
</template>
