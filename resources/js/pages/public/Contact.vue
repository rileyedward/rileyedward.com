<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { CheckCircle2 } from '@lucide/vue';
import ContactController from '@/actions/App/Http/Controllers/Site/ContactController';
import GradientBlobs from '@/components/site/GradientBlobs.vue';
import SiteButton from '@/components/site/SiteButton.vue';
import SiteCard from '@/components/site/SiteCard.vue';
import { home } from '@/routes';

defineProps<{
    sent: boolean;
}>();

const fieldClass =
    'mt-1.5 block w-full rounded-lg border border-input bg-background px-3 py-2.5 text-base outline-none placeholder:text-muted-foreground/70 focus:border-accent-500 focus:ring-2 focus:ring-accent-500/30 aria-invalid:border-destructive';
</script>

<template>
    <Head title="Contact">
        <meta
            name="description"
            content="Tell Riley Edward what you're working on. Kansas City web development for local businesses."
        />
    </Head>

    <section class="relative isolate">
        <GradientBlobs />
        <div class="mx-auto max-w-2xl px-4 pt-16 pb-24 sm:px-6 sm:pt-24">
            <p
                class="font-mono text-xs tracking-wider text-accent-text uppercase"
            >
                Contact
            </p>
            <h1
                class="mt-2 text-3xl font-semibold tracking-tight text-balance sm:text-5xl"
            >
                Let's talk about your project
            </h1>
            <p class="mt-4 text-lg text-muted-foreground">
                Tell me what you're working on and I'll get back to you within a
                couple of days.
            </p>

            <SiteCard v-if="sent" class="mt-10 text-center" role="status">
                <CheckCircle2 class="mx-auto size-8 text-accent-text" />
                <h2 class="mt-4 text-xl font-semibold">
                    Thanks, message sent.
                </h2>
                <p class="mt-2 text-muted-foreground">
                    I'll read it soon and reply by email.
                </p>
                <SiteButton :href="home()" variant="secondary" class="mt-6">
                    Back home
                </SiteButton>
            </SiteCard>

            <SiteCard v-else class="mt-10">
                <Form
                    v-bind="ContactController.store.form()"
                    v-slot="{ errors, processing }"
                    class="grid gap-5"
                >
                    <div class="grid gap-5 sm:grid-cols-2">
                        <label class="block text-sm font-medium">
                            Name
                            <input
                                name="name"
                                required
                                autocomplete="name"
                                :aria-invalid="!!errors.name"
                                :class="fieldClass"
                            />
                            <span
                                v-if="errors.name"
                                class="mt-1 block text-sm text-destructive"
                                >{{ errors.name }}</span
                            >
                        </label>
                        <label class="block text-sm font-medium">
                            Email
                            <input
                                name="email"
                                type="email"
                                required
                                autocomplete="email"
                                :aria-invalid="!!errors.email"
                                :class="fieldClass"
                            />
                            <span
                                v-if="errors.email"
                                class="mt-1 block text-sm text-destructive"
                                >{{ errors.email }}</span
                            >
                        </label>
                        <label class="block text-sm font-medium">
                            Business name
                            <span class="font-normal text-muted-foreground"
                                >(optional)</span
                            >
                            <input
                                name="business_name"
                                autocomplete="organization"
                                :aria-invalid="!!errors.business_name"
                                :class="fieldClass"
                            />
                            <span
                                v-if="errors.business_name"
                                class="mt-1 block text-sm text-destructive"
                                >{{ errors.business_name }}</span
                            >
                        </label>
                        <label class="block text-sm font-medium">
                            Phone
                            <span class="font-normal text-muted-foreground"
                                >(optional)</span
                            >
                            <input
                                name="phone"
                                type="tel"
                                autocomplete="tel"
                                :aria-invalid="!!errors.phone"
                                :class="fieldClass"
                            />
                            <span
                                v-if="errors.phone"
                                class="mt-1 block text-sm text-destructive"
                                >{{ errors.phone }}</span
                            >
                        </label>
                    </div>

                    <label class="block text-sm font-medium">
                        What are you working on?
                        <textarea
                            name="message"
                            rows="6"
                            required
                            :aria-invalid="!!errors.message"
                            :class="fieldClass"
                        />
                        <span
                            v-if="errors.message"
                            class="mt-1 block text-sm text-destructive"
                            >{{ errors.message }}</span
                        >
                    </label>

                    <div class="hidden" aria-hidden="true">
                        <label>
                            Leave this field empty
                            <input
                                name="website"
                                tabindex="-1"
                                autocomplete="off"
                            />
                        </label>
                    </div>

                    <div>
                        <SiteButton type="submit" :disabled="processing">
                            {{ processing ? 'Sending…' : 'Send message' }}
                        </SiteButton>
                    </div>
                </Form>
            </SiteCard>
        </div>
    </section>
</template>
