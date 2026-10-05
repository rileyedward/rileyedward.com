<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import ContactBand from '@/components/site/ContactBand.vue';
import AccentSwatches from '@/components/site/AccentSwatches.vue';
import ThemeControls from '@/components/site/ThemeControls.vue';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import { about, home } from '@/routes';
import { create as contact } from '@/routes/contact';
import { index as work } from '@/routes/work';

const page = usePage();
const site = computed(() => page.props.site);
const { isCurrentUrl, isCurrentOrParentUrl } = useCurrentUrl();

const links = [
    { label: 'Home', href: home(), exact: true },
    { label: 'Work', href: work(), exact: false },
    { label: 'About', href: about(), exact: true },
    { label: 'Contact', href: contact(), exact: true },
];

const isActive = (link: (typeof links)[number]) =>
    link.exact ? isCurrentUrl(link.href) : isCurrentOrParentUrl(link.href);

const showContactBand = computed(() => !isCurrentUrl(contact()));
const year = new Date().getFullYear();
</script>

<template>
    <div class="site flex min-h-screen flex-col overflow-x-clip">
        <a
            href="#main"
            class="sr-only z-50 rounded-md bg-background px-3 py-2 focus:not-sr-only focus:fixed focus:top-3 focus:left-3"
        >
            Skip to content
        </a>

        <header
            class="sticky top-0 z-40 border-b border-border/60 bg-background/80 backdrop-blur"
        >
            <div
                class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-x-6 gap-y-2 px-4 py-3 sm:px-6"
            >
                <Link
                    :href="home()"
                    class="text-base font-semibold tracking-tight outline-none hover:text-accent-text focus-visible:ring-2 focus-visible:ring-ring"
                >
                    Riley Edward
                </Link>

                <div class="flex items-center gap-2 sm:order-last">
                    <ThemeControls />
                </div>

                <nav
                    aria-label="Main"
                    class="order-last -mx-2 flex w-full items-center gap-1 sm:order-none sm:mx-0 sm:w-auto"
                >
                    <Link
                        v-for="link in links"
                        :key="link.label"
                        :href="link.href"
                        :aria-current="isActive(link) ? 'page' : undefined"
                        class="rounded-full px-3 py-1.5 text-sm outline-none focus-visible:ring-2 focus-visible:ring-ring"
                        :class="
                            isActive(link)
                                ? 'bg-accent-500/10 text-accent-text'
                                : 'text-muted-foreground hover:text-foreground'
                        "
                    >
                        {{ link.label }}
                    </Link>
                </nav>
            </div>
        </header>

        <main id="main" class="flex-1">
            <slot />
            <ContactBand v-if="showContactBand" />
        </main>

        <footer class="border-t border-border/60">
            <div
                class="mx-auto flex max-w-6xl flex-col gap-6 px-4 py-10 text-sm text-muted-foreground sm:flex-row sm:items-center sm:justify-between sm:px-6"
            >
                <div class="space-y-1">
                    <p class="font-medium text-foreground">
                        Riley Edward · Kansas City
                    </p>
                    <p v-if="site.availability" class="flex items-center gap-2">
                        <span
                            class="size-2 rounded-full bg-accent-500"
                            aria-hidden="true"
                        />
                        {{ site.availability }}
                    </p>
                    <p>© {{ year }} Riley Edward</p>
                </div>

                <div class="flex flex-col gap-4 sm:items-end">
                    <div class="flex flex-wrap gap-4">
                        <a
                            v-if="site.githubUrl"
                            :href="site.githubUrl"
                            target="_blank"
                            rel="noopener me"
                            class="hover:text-accent-text"
                            >GitHub</a
                        >
                        <a
                            v-if="site.linkedinUrl"
                            :href="site.linkedinUrl"
                            target="_blank"
                            rel="noopener me"
                            class="hover:text-accent-text"
                            >LinkedIn</a
                        >
                        <a
                            v-if="site.contactEmail"
                            :href="`mailto:${site.contactEmail}`"
                            class="hover:text-accent-text"
                            >{{ site.contactEmail }}</a
                        >
                    </div>
                    <AccentSwatches />
                </div>
            </div>
        </footer>
    </div>
</template>
