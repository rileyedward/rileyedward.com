<script setup lang="ts">
import GradientBlobs from '@/components/site/GradientBlobs.vue';
import Reveal from '@/components/site/Reveal.vue';
import SiteButton from '@/components/site/SiteButton.vue';
import { create as contact } from '@/routes/contact';
</script>

<template>
    <section class="mx-auto w-full max-w-6xl px-4 py-20 sm:px-6">
        <Reveal>
            <div
                class="relative isolate overflow-hidden rounded-3xl border border-border bg-card px-6 py-14 text-center sm:px-12"
            >
                <GradientBlobs />
                <h2
                    class="text-2xl font-semibold tracking-tight text-balance sm:text-3xl"
                >
                    Have something you want built?
                </h2>
                <p class="mx-auto mt-3 max-w-xl text-muted-foreground">
                    Tell me what you're working on. Coffee in Brookside or a
                    call from anywhere, either works.
                </p>
                <SiteButton :href="contact()" class="mt-8">
                    Start a project
                </SiteButton>
            </div>
        </Reveal>
    </section>
</template>
