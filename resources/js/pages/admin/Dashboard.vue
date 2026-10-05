<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Eye, EyeOff, Inbox } from '@lucide/vue';
import Heading from '@/components/Heading.vue';
import { dashboard } from '@/routes';
import { index as projects } from '@/routes/admin/projects';
import { index as inbox, show } from '@/routes/inbox';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Dashboard', href: dashboard() }],
    },
});

defineProps<{
    unreadCount: number;
    latestMessages: {
        id: number;
        name: string;
        businessName: string | null;
        excerpt: string;
        isRead: boolean;
        receivedAt: string | null;
    }[];
    visibleProjectCount: number;
    hiddenProjectCount: number;
}>();
</script>

<template>
    <Head title="Dashboard" />

    <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
        <Heading
            title="Dashboard"
            description="What's new on rileyedward.com"
        />

        <div class="grid gap-4 sm:grid-cols-3">
            <Link
                :href="inbox()"
                class="rounded-xl border border-border p-5 hover:border-accent-500/50"
            >
                <Inbox class="size-5 text-accent-text" />
                <p class="mt-3 text-3xl font-semibold">{{ unreadCount }}</p>
                <p class="text-sm text-muted-foreground">Unread messages</p>
            </Link>
            <Link
                :href="projects()"
                class="rounded-xl border border-border p-5 hover:border-accent-500/50"
            >
                <Eye class="size-5 text-accent-text" />
                <p class="mt-3 text-3xl font-semibold">
                    {{ visibleProjectCount }}
                </p>
                <p class="text-sm text-muted-foreground">Visible projects</p>
            </Link>
            <Link
                :href="projects()"
                class="rounded-xl border border-border p-5 hover:border-accent-500/50"
            >
                <EyeOff class="size-5 text-muted-foreground" />
                <p class="mt-3 text-3xl font-semibold">
                    {{ hiddenProjectCount }}
                </p>
                <p class="text-sm text-muted-foreground">Hidden projects</p>
            </Link>
        </div>

        <section class="rounded-xl border border-border">
            <div
                class="flex items-center justify-between border-b border-border px-5 py-3"
            >
                <h2 class="font-medium">Newest messages</h2>
                <Link
                    :href="inbox()"
                    class="text-sm text-accent-text hover:underline"
                    >Open inbox</Link
                >
            </div>
            <ul v-if="latestMessages.length" class="divide-y divide-border">
                <li v-for="message in latestMessages" :key="message.id">
                    <Link
                        :href="show(message.id)"
                        class="flex flex-col gap-0.5 px-5 py-3 hover:bg-muted/50 sm:flex-row sm:items-baseline sm:gap-4"
                    >
                        <span
                            class="shrink-0 sm:w-48"
                            :class="message.isRead ? '' : 'font-semibold'"
                        >
                            {{ message.name }}
                            <span
                                v-if="!message.isRead"
                                class="ml-1 inline-block size-2 rounded-full bg-accent-500"
                                aria-label="Unread"
                            />
                        </span>
                        <span
                            class="flex-1 truncate text-sm text-muted-foreground"
                            >{{ message.excerpt }}</span
                        >
                        <span class="shrink-0 text-xs text-muted-foreground">{{
                            message.receivedAt
                        }}</span>
                    </Link>
                </li>
            </ul>
            <p
                v-else
                class="px-5 py-8 text-center text-sm text-muted-foreground"
            >
                No messages yet.
            </p>
        </section>
    </div>
</template>
