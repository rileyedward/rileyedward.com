<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import SiteSettingsController from '@/actions/App/Http/Controllers/Admin/SiteSettingsController';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { edit } from '@/routes/site-settings';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Site settings', href: edit() }],
    },
});

defineProps<{
    settings: {
        availability: string | null;
        contact_email: string | null;
        github_url: string | null;
        linkedin_url: string | null;
        career_start_year: string | null;
    };
}>();
</script>

<template>
    <Head title="Site settings" />

    <div class="flex max-w-2xl flex-1 flex-col gap-6 p-4 md:p-6">
        <Heading
            title="Site settings"
            description="Values shown across the public site. Changes are live as soon as you save."
        />

        <Form
            v-bind="SiteSettingsController.update.form()"
            v-slot="{ errors, processing }"
            class="grid gap-6"
            :options="{ preserveScroll: true }"
        >
            <div class="grid gap-2">
                <Label for="availability">Availability line</Label>
                <Input
                    id="availability"
                    name="availability"
                    :default-value="settings.availability ?? undefined"
                    placeholder="Taking new projects for November"
                />
                <p class="text-xs text-muted-foreground">
                    Shown in the footer. Leave blank to hide it.
                </p>
                <InputError :message="errors.availability" />
            </div>
            <div class="grid gap-2">
                <Label for="contact_email">Public contact email</Label>
                <Input
                    id="contact_email"
                    name="contact_email"
                    type="email"
                    :default-value="settings.contact_email ?? undefined"
                />
                <p class="text-xs text-muted-foreground">
                    Optional. Leave blank to only offer the contact form.
                </p>
                <InputError :message="errors.contact_email" />
            </div>
            <div class="grid gap-6 sm:grid-cols-2">
                <div class="grid gap-2">
                    <Label for="github_url">GitHub URL</Label>
                    <Input
                        id="github_url"
                        name="github_url"
                        type="url"
                        :default-value="settings.github_url ?? undefined"
                    />
                    <InputError :message="errors.github_url" />
                </div>
                <div class="grid gap-2">
                    <Label for="linkedin_url">LinkedIn URL</Label>
                    <Input
                        id="linkedin_url"
                        name="linkedin_url"
                        type="url"
                        :default-value="settings.linkedin_url ?? undefined"
                    />
                    <InputError :message="errors.linkedin_url" />
                </div>
            </div>
            <div class="grid gap-2 sm:w-48">
                <Label for="career_start_year">Career start year</Label>
                <Input
                    id="career_start_year"
                    name="career_start_year"
                    type="number"
                    inputmode="numeric"
                    :default-value="settings.career_start_year ?? undefined"
                />
                <p class="text-xs text-muted-foreground">
                    Drives the "N+ years" figure on About.
                </p>
                <InputError :message="errors.career_start_year" />
            </div>
            <div>
                <Button type="submit" :disabled="processing"
                    >Save settings</Button
                >
            </div>
        </Form>
    </div>
</template>
