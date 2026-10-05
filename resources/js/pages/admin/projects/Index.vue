<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import {
    moveArrayElement,
    useSortable,
} from '@vueuse/integrations/useSortable';
import { ExternalLink, Eye, GripVertical, Plus } from '@lucide/vue';
import { nextTick, ref, useTemplateRef, watch } from 'vue';
import ToggleSwitch from '@/components/admin/ToggleSwitch.vue';
import Heading from '@/components/Heading.vue';
import { Button } from '@/components/ui/button';
import {
    create,
    edit,
    index as projectsIndex,
    preview,
    reorder,
    toggle,
} from '@/routes/admin/projects';
import { show } from '@/routes/work';
import type { Project } from '@/types';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Projects', href: projectsIndex() }],
    },
});

const props = defineProps<{
    projects: Project[];
}>();

const rows = ref<Project[]>([...props.projects]);
watch(
    () => props.projects,
    (projects) => (rows.value = [...projects]),
);

const tbody = useTemplateRef<HTMLElement>('tbody');

useSortable(tbody, rows, {
    handle: '.drag-handle',
    animation: 150,
    onUpdate: (event: { oldIndex?: number; newIndex?: number }) => {
        moveArrayElement(rows, event.oldIndex ?? 0, event.newIndex ?? 0);
        nextTick(() => {
            router.post(
                reorder().url,
                { ids: rows.value.map((project) => project.id) },
                { preserveScroll: true, preserveState: true },
            );
        });
    },
});

function setFlag(
    project: Project,
    field: 'is_visible' | 'is_featured',
    value: boolean,
) {
    if (field === 'is_visible') {
        project.isVisible = value;
    } else {
        project.isFeatured = value;
    }

    router.patch(
        toggle(project.id).url,
        { field, value },
        { preserveScroll: true, preserveState: true },
    );
}
</script>

<template>
    <Head title="Projects" />

    <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <Heading
                title="Projects"
                description="Drag to reorder. Visible and Featured save immediately."
            />
            <Button as-child>
                <Link :href="create()"><Plus /> New project</Link>
            </Button>
        </div>

        <div class="overflow-x-auto rounded-xl border border-border">
            <table class="w-full min-w-[40rem] text-sm">
                <thead class="bg-muted/50 text-left text-muted-foreground">
                    <tr>
                        <th class="w-10 px-3 py-2">
                            <span class="sr-only">Order</span>
                        </th>
                        <th class="px-3 py-2 font-medium">Project</th>
                        <th class="px-3 py-2 font-medium">Kind</th>
                        <th class="px-3 py-2 font-medium">Status</th>
                        <th class="px-3 py-2 font-medium">Visible</th>
                        <th class="px-3 py-2 font-medium">Featured</th>
                        <th class="px-3 py-2">
                            <span class="sr-only">Links</span>
                        </th>
                    </tr>
                </thead>
                <tbody ref="tbody" class="divide-y divide-border">
                    <tr
                        v-for="project in rows"
                        :key="project.id"
                        class="bg-background"
                    >
                        <td class="px-3 py-2">
                            <button
                                type="button"
                                class="drag-handle cursor-grab p-1 text-muted-foreground hover:text-foreground active:cursor-grabbing"
                                :aria-label="`Drag to reorder ${project.title}`"
                            >
                                <GripVertical class="size-4" />
                            </button>
                        </td>
                        <td class="px-3 py-2">
                            <Link
                                :href="edit(project.id)"
                                class="font-medium hover:text-accent-text"
                                >{{ project.title }}</Link
                            >
                            <p
                                class="max-w-sm truncate text-xs text-muted-foreground"
                            >
                                {{ project.summary }}
                            </p>
                        </td>
                        <td class="px-3 py-2">{{ project.kindLabel }}</td>
                        <td class="px-3 py-2">{{ project.statusLabel }}</td>
                        <td class="px-3 py-2">
                            <ToggleSwitch
                                :model-value="project.isVisible"
                                :label="`Visible: ${project.title}`"
                                @update:model-value="
                                    setFlag(project, 'is_visible', $event)
                                "
                            />
                        </td>
                        <td class="px-3 py-2">
                            <ToggleSwitch
                                :model-value="project.isFeatured"
                                :label="`Featured: ${project.title}`"
                                @update:model-value="
                                    setFlag(project, 'is_featured', $event)
                                "
                            />
                        </td>
                        <td class="px-3 py-2 text-right whitespace-nowrap">
                            <a
                                v-if="project.isVisible"
                                :href="show(project.slug).url"
                                target="_blank"
                                class="inline-flex items-center gap-1 text-xs text-accent-text hover:underline"
                                ><ExternalLink class="size-3.5" /> View on
                                site</a
                            >
                            <a
                                v-else
                                :href="preview(project.id).url"
                                target="_blank"
                                class="inline-flex items-center gap-1 text-xs text-muted-foreground hover:text-foreground"
                                ><Eye class="size-3.5" /> Preview</a
                            >
                        </td>
                    </tr>
                </tbody>
            </table>
            <p
                v-if="!rows.length"
                class="px-4 py-12 text-center text-sm text-muted-foreground"
            >
                No projects yet.
            </p>
        </div>
    </div>
</template>
