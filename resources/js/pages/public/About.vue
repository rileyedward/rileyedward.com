<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import Reveal from '@/components/site/Reveal.vue';
import SectionHeading from '@/components/site/SectionHeading.vue';
import SiteCard from '@/components/site/SiteCard.vue';
import StackChip from '@/components/site/StackChip.vue';

const site = computed(() => usePage().props.site);

const years = computed(() =>
    site.value.yearsOfExperience
        ? `${site.value.yearsOfExperience}+ years`
        : 'Years',
);

const stack = ['Laravel', 'PHP', 'Vue', 'TypeScript', 'PostgreSQL', 'Tailwind'];

const principles = [
    {
        title: 'Talk first',
        text: 'We start with a conversation, in person or on a call, so I understand the business before I write any code.',
    },
    {
        title: 'Small, reviewable steps',
        text: 'You see working progress early and often, not a big reveal at the end.',
    },
    {
        title: 'You own it',
        text: 'Your code, your data, your accounts. Nothing is locked up with me.',
    },
];
</script>

<template>
    <Head title="About">
        <meta
            name="description"
            content="Riley Edward is a Laravel and Vue developer in Kansas City who builds custom web apps for local businesses."
        />
    </Head>

    <section class="mx-auto max-w-3xl px-4 pt-16 pb-8 sm:px-6 sm:pt-24">
        <p class="font-mono text-xs tracking-wider text-accent-text uppercase">
            About
        </p>
        <h1
            class="mt-2 text-3xl font-semibold tracking-tight text-balance sm:text-5xl"
        >
            Hi, I'm Riley.
        </h1>
        <!-- TODO(Riley): About intro in your own words. -->
        <p class="mt-6 text-lg text-pretty text-muted-foreground">
            I'm a developer in Kansas City who builds custom web applications
            with Laravel and Vue. I like working with local businesses because
            the work is concrete: a real owner with a real problem, and software
            that makes their day easier once it ships.
        </p>
    </section>

    <section class="mx-auto max-w-3xl space-y-12 px-4 py-8 sm:px-6">
        <Reveal>
            <SiteCard>
                <p class="font-mono text-xs text-muted-foreground uppercase">
                    Now
                </p>
                <h2 class="mt-2 text-lg font-semibold">
                    Software Engineer II at Schier Products
                </h2>
                <p class="text-sm text-muted-foreground">Shawnee, KS</p>
                <!-- TODO(Riley): one or two sentences on your Schier work. -->
                <p class="mt-3 text-muted-foreground">
                    Building and maintaining the internal and customer-facing
                    web applications that support the business.
                </p>
            </SiteCard>
        </Reveal>

        <Reveal>
            <SectionHeading
                eyebrow="Experience"
                :title="`${years} in Laravel and Vue`"
                description="Across agency client work and in-house product teams, I've built custom web apps, data analytics tools, and reporting dashboards."
            />
            <div class="mt-6 flex flex-wrap gap-2">
                <StackChip v-for="item in stack" :key="item">{{
                    item
                }}</StackChip>
            </div>
        </Reveal>

        <Reveal>
            <SectionHeading eyebrow="How I work" title="Simple and honest" />
            <div class="mt-6 grid gap-4 sm:grid-cols-3">
                <SiteCard v-for="item in principles" :key="item.title">
                    <h3 class="font-semibold">{{ item.title }}</h3>
                    <p class="mt-1.5 text-sm text-muted-foreground">
                        {{ item.text }}
                    </p>
                </SiteCard>
            </div>
        </Reveal>

        <div
            v-if="site.githubUrl || site.linkedinUrl"
            class="flex flex-wrap gap-4 text-sm"
        >
            <a
                v-if="site.githubUrl"
                :href="site.githubUrl"
                target="_blank"
                rel="noopener me"
                class="text-accent-text underline-offset-4 hover:underline"
                >GitHub</a
            >
            <a
                v-if="site.linkedinUrl"
                :href="site.linkedinUrl"
                target="_blank"
                rel="noopener me"
                class="text-accent-text underline-offset-4 hover:underline"
                >LinkedIn</a
            >
        </div>
    </section>
</template>
