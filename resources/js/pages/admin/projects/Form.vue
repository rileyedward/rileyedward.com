<script setup lang="ts">
import { Form, Head, Link, useHttp } from '@inertiajs/vue3';
import { ExternalLink, Eye, Trash2 } from '@lucide/vue';
import { computed, ref } from 'vue';
import ProjectController from '@/actions/App/Http/Controllers/Admin/ProjectController';
import StackInput from '@/components/admin/StackInput.vue';
import ToggleSwitch from '@/components/admin/ToggleSwitch.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import {
    Dialog,
    DialogClose,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { markdownPreview } from '@/routes/admin';
import { index as projectsIndex, preview } from '@/routes/admin/projects';
import { show } from '@/routes/work';
import type { Option, Project } from '@/types';

type EditableProject = Project & { body: string | null };

const props = defineProps<{
    project: EditableProject | null;
    kinds: Option[];
    statuses: Option[];
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Projects', href: projectsIndex() }],
    },
});

const isEditing = computed(() => props.project !== null);
const formAction = computed(() =>
    props.project
        ? ProjectController.update.form(props.project.id)
        : ProjectController.store.form(),
);

const stack = ref<string[]>([...(props.project?.stack ?? [])]);
const isVisible = ref(props.project?.isVisible ?? false);
const isFeatured = ref(props.project?.isFeatured ?? false);
const body = ref(props.project?.body ?? '');
const removeCover = ref(false);
const coverPreviewUrl = ref<string | null>(
    props.project?.coverImageUrl ?? null,
);

const bodyTab = ref<'write' | 'preview'>('write');
const previewRequest = useHttp<{ markdown: string }, { html: string }>({
    markdown: '',
});
const previewHtml = ref('');

async function showPreview() {
    bodyTab.value = 'preview';
    previewRequest.markdown = body.value;
    const response = await previewRequest.post(markdownPreview().url);
    previewHtml.value = response.html;
}

function onCoverChange(event: Event) {
    const file = (event.target as HTMLInputElement).files?.[0];

    if (file) {
        removeCover.value = false;
        coverPreviewUrl.value = URL.createObjectURL(file);
    }
}

function clearCover() {
    removeCover.value = true;
    coverPreviewUrl.value = null;
}

const selectClass =
    'h-9 w-full rounded-md border border-input bg-transparent px-3 text-sm shadow-xs outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 dark:bg-input/30';
</script>

<template>
    <Head :title="project ? `Edit ${project.title}` : 'New project'" />

    <div class="flex max-w-3xl flex-1 flex-col gap-6 p-4 md:p-6">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <Heading
                :title="project ? project.title : 'New project'"
                :description="
                    isEditing
                        ? 'Changes go live as soon as you save.'
                        : 'New projects start hidden unless you turn on Visible.'
                "
            />
            <div v-if="project" class="flex gap-2">
                <Button v-if="project.isVisible" variant="outline" as-child>
                    <a :href="show(project.slug).url" target="_blank"
                        ><ExternalLink /> View on site</a
                    >
                </Button>
                <Button v-else variant="outline" as-child>
                    <a :href="preview(project.id).url" target="_blank"
                        ><Eye /> Preview</a
                    >
                </Button>
            </div>
        </div>

        <Form
            :key="project?.id ?? 'new'"
            v-bind="formAction"
            v-slot="{ errors, processing }"
            class="grid gap-6"
            :options="{ preserveScroll: true }"
        >
            <div class="grid gap-6 sm:grid-cols-2">
                <div class="grid gap-2">
                    <Label for="title">Title</Label>
                    <Input
                        id="title"
                        name="title"
                        required
                        :default-value="project?.title"
                    />
                    <InputError :message="errors.title" />
                </div>
                <div class="grid gap-2">
                    <Label for="slug">Slug</Label>
                    <Input
                        id="slug"
                        name="slug"
                        :default-value="project?.slug"
                        placeholder="Generated from the title"
                    />
                    <InputError :message="errors.slug" />
                </div>
                <div class="grid gap-2">
                    <Label for="kind">Kind</Label>
                    <select
                        id="kind"
                        name="kind"
                        :class="selectClass"
                        :value="project?.kind ?? 'client'"
                    >
                        <option
                            v-for="kind in kinds"
                            :key="kind.value"
                            :value="kind.value"
                        >
                            {{ kind.label }}
                        </option>
                    </select>
                    <InputError :message="errors.kind" />
                </div>
                <div class="grid gap-2">
                    <Label for="status">Status</Label>
                    <select
                        id="status"
                        name="status"
                        :class="selectClass"
                        :value="project?.status ?? 'in_progress'"
                    >
                        <option
                            v-for="status in statuses"
                            :key="status.value"
                            :value="status.value"
                        >
                            {{ status.label }}
                        </option>
                    </select>
                    <InputError :message="errors.status" />
                </div>
            </div>

            <div class="grid gap-2">
                <Label for="summary">Summary</Label>
                <Input
                    id="summary"
                    name="summary"
                    required
                    maxlength="160"
                    :default-value="project?.summary"
                />
                <p class="text-xs text-muted-foreground">
                    One line, 160 characters max. Used on cards and as the meta
                    description.
                </p>
                <InputError :message="errors.summary" />
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="grid gap-2">
                    <Label for="role">Your role</Label>
                    <Input
                        id="role"
                        name="role"
                        :default-value="project?.role ?? undefined"
                        placeholder="Design and full-stack build"
                    />
                    <InputError :message="errors.role" />
                </div>
                <div class="grid gap-2">
                    <Label>Stack</Label>
                    <StackInput v-model="stack" name="stack" />
                    <InputError :message="errors.stack" />
                </div>
                <div class="grid gap-2">
                    <Label for="live_url">Live URL</Label>
                    <Input
                        id="live_url"
                        name="live_url"
                        type="url"
                        :default-value="project?.liveUrl ?? undefined"
                    />
                    <InputError :message="errors.live_url" />
                </div>
                <div class="grid gap-2">
                    <Label for="repo_url">Repository URL</Label>
                    <Input
                        id="repo_url"
                        name="repo_url"
                        type="url"
                        :default-value="project?.repoUrl ?? undefined"
                    />
                    <InputError :message="errors.repo_url" />
                </div>
            </div>

            <div class="flex flex-wrap gap-8">
                <label class="flex items-center gap-3 text-sm">
                    <ToggleSwitch v-model="isVisible" label="Visible" />
                    Visible on the site
                    <input
                        type="hidden"
                        name="is_visible"
                        :value="isVisible ? 1 : 0"
                    />
                </label>
                <label class="flex items-center gap-3 text-sm">
                    <ToggleSwitch v-model="isFeatured" label="Featured" />
                    Featured on Home
                    <input
                        type="hidden"
                        name="is_featured"
                        :value="isFeatured ? 1 : 0"
                    />
                </label>
            </div>

            <div class="grid gap-2">
                <div class="flex items-center justify-between">
                    <Label for="body">Write-up (markdown)</Label>
                    <div
                        class="inline-flex gap-1 rounded-md bg-muted p-0.5 text-xs"
                    >
                        <button
                            type="button"
                            class="rounded px-2 py-1"
                            :class="
                                bodyTab === 'write'
                                    ? 'bg-background shadow-xs'
                                    : 'text-muted-foreground'
                            "
                            @click="bodyTab = 'write'"
                        >
                            Write
                        </button>
                        <button
                            type="button"
                            class="rounded px-2 py-1"
                            :class="
                                bodyTab === 'preview'
                                    ? 'bg-background shadow-xs'
                                    : 'text-muted-foreground'
                            "
                            @click="showPreview"
                        >
                            Preview
                        </button>
                    </div>
                </div>
                <textarea
                    v-show="bodyTab === 'write'"
                    id="body"
                    v-model="body"
                    name="body"
                    rows="16"
                    class="w-full rounded-md border border-input bg-transparent px-3 py-2 font-mono text-sm shadow-xs outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50"
                    placeholder="## The problem&#10;&#10;## What I built&#10;&#10;## Notable details"
                />
                <div
                    v-show="bodyTab === 'preview'"
                    class="min-h-64 rounded-md border border-input px-4 py-3"
                >
                    <p
                        v-if="previewRequest.processing"
                        class="text-sm text-muted-foreground"
                    >
                        Rendering…
                    </p>
                    <div
                        v-else-if="previewHtml"
                        class="prose-site"
                        v-html="previewHtml"
                    />
                    <p v-else class="text-sm text-muted-foreground">
                        Nothing to preview.
                    </p>
                </div>
                <InputError :message="errors.body" />
            </div>

            <div class="grid gap-3">
                <Label for="cover">Cover screenshot</Label>
                <img
                    v-if="coverPreviewUrl"
                    :src="coverPreviewUrl"
                    alt="Cover preview"
                    class="max-h-64 w-fit rounded-lg border border-border"
                />
                <div class="flex flex-wrap items-center gap-3">
                    <input
                        id="cover"
                        name="cover"
                        type="file"
                        accept="image/png,image/jpeg,image/webp"
                        class="text-sm file:mr-3 file:rounded-md file:border file:border-input file:bg-transparent file:px-3 file:py-1.5 file:text-sm"
                        @change="onCoverChange"
                    />
                    <Button
                        v-if="coverPreviewUrl"
                        type="button"
                        variant="outline"
                        size="sm"
                        @click="clearCover"
                    >
                        Remove image
                    </Button>
                </div>
                <input
                    type="hidden"
                    name="remove_cover"
                    :value="removeCover ? 1 : 0"
                />
                <p class="text-xs text-muted-foreground">
                    PNG, JPG or WebP up to 10 MB. Saved as WebP, max 1600px
                    wide.
                </p>
                <InputError :message="errors.cover" />
            </div>

            <div
                class="flex items-center justify-between gap-4 border-t border-border pt-6"
            >
                <Button type="submit" :disabled="processing">
                    {{ isEditing ? 'Save changes' : 'Create project' }}
                </Button>

                <Dialog v-if="project">
                    <DialogTrigger as-child>
                        <Button
                            type="button"
                            variant="ghost"
                            class="text-destructive"
                        >
                            <Trash2 /> Delete
                        </Button>
                    </DialogTrigger>
                    <DialogContent>
                        <DialogHeader>
                            <DialogTitle
                                >Delete {{ project.title }}?</DialogTitle
                            >
                            <DialogDescription>
                                This removes the project and its screenshot. To
                                take it off the site temporarily, turn off
                                Visible instead.
                            </DialogDescription>
                        </DialogHeader>
                        <DialogFooter class="gap-2">
                            <DialogClose as-child>
                                <Button variant="secondary">Cancel</Button>
                            </DialogClose>
                            <Link
                                :href="ProjectController.destroy(project.id)"
                                as="button"
                                :class="'inline-flex h-9 items-center rounded-md bg-destructive px-4 text-sm font-medium text-white'"
                            >
                                Delete project
                            </Link>
                        </DialogFooter>
                    </DialogContent>
                </Dialog>
            </div>
        </Form>
    </div>
</template>
