<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Search } from '@lucide/vue';
import { ref, watch } from 'vue';
import Heading from '@/components/Heading.vue';
import { Input } from '@/components/ui/input';
import { formatDateTime } from '@/lib/dates';
import { index as inbox, show } from '@/routes/inbox';
import type { InboxMessageSummary, Paginated } from '@/types';

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Inbox', href: inbox() }],
    },
});

const props = defineProps<{
    messages: Paginated<InboxMessageSummary>;
    tab: 'inbox' | 'archived';
    search: string;
    archivedCount: number;
}>();

const searchTerm = ref(props.search);
let searchTimer: ReturnType<typeof setTimeout> | undefined;

watch(searchTerm, (value) => {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
        router.get(
            inbox({
                query: {
                    tab: props.tab === 'archived' ? 'archived' : undefined,
                    search: value || undefined,
                },
            }).url,
            {},
            { preserveState: true, preserveScroll: true, replace: true },
        );
    }, 300);
});

const tabHref = (tab: 'inbox' | 'archived') =>
    inbox({ query: tab === 'archived' ? { tab } : {} });
</script>

<template>
    <Head title="Inbox" />

    <div class="flex flex-1 flex-col gap-6 p-4 md:p-6">
        <Heading
            title="Inbox"
            description="Inquiries from the contact form. Nothing is emailed; replies go from your own mail app."
        />

        <div
            class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
        >
            <nav
                class="inline-flex gap-1 rounded-lg bg-muted p-1"
                aria-label="Folders"
            >
                <Link
                    :href="tabHref('inbox')"
                    class="rounded-md px-3 py-1.5 text-sm"
                    :class="
                        tab === 'inbox'
                            ? 'bg-background shadow-xs'
                            : 'text-muted-foreground'
                    "
                    >Inbox</Link
                >
                <Link
                    :href="tabHref('archived')"
                    class="rounded-md px-3 py-1.5 text-sm"
                    :class="
                        tab === 'archived'
                            ? 'bg-background shadow-xs'
                            : 'text-muted-foreground'
                    "
                    >Archived ({{ archivedCount }})</Link
                >
            </nav>

            <label class="relative block sm:w-72">
                <span class="sr-only">Search messages</span>
                <Search
                    class="pointer-events-none absolute top-1/2 left-3 size-4 -translate-y-1/2 text-muted-foreground"
                />
                <Input
                    v-model="searchTerm"
                    type="search"
                    placeholder="Search name, email, business, message"
                    class="pl-9"
                />
            </label>
        </div>

        <div class="overflow-hidden rounded-xl border border-border">
            <ul v-if="messages.data.length" class="divide-y divide-border">
                <li v-for="message in messages.data" :key="message.id">
                    <Link
                        :href="show(message.id)"
                        class="grid gap-1 px-4 py-3 hover:bg-muted/50 sm:grid-cols-[14rem_1fr_auto] sm:items-baseline sm:gap-4"
                    >
                        <span
                            class="truncate"
                            :class="message.isRead ? '' : 'font-semibold'"
                        >
                            <span
                                v-if="!message.isRead"
                                class="mr-1.5 inline-block size-2 rounded-full bg-accent-500"
                                aria-label="Unread"
                            />
                            {{ message.name }}
                            <span
                                v-if="message.businessName"
                                class="font-normal text-muted-foreground"
                            >
                                · {{ message.businessName }}</span
                            >
                        </span>
                        <span
                            class="truncate text-sm"
                            :class="
                                message.isRead
                                    ? 'text-muted-foreground'
                                    : 'text-foreground'
                            "
                            >{{ message.excerpt }}</span
                        >
                        <time
                            :datetime="message.receivedAt ?? undefined"
                            class="text-xs text-muted-foreground"
                            >{{ formatDateTime(message.receivedAt) }}</time
                        >
                    </Link>
                </li>
            </ul>
            <p
                v-else
                class="px-4 py-12 text-center text-sm text-muted-foreground"
            >
                {{
                    search
                        ? 'No messages match that search.'
                        : tab === 'archived'
                          ? 'Nothing archived.'
                          : 'Inbox zero. Nice.'
                }}
            </p>
        </div>

        <div
            v-if="messages.last_page > 1"
            class="flex items-center justify-between text-sm"
        >
            <Link
                v-if="messages.prev_page_url"
                :href="messages.prev_page_url"
                class="text-accent-text hover:underline"
                >← Newer</Link
            >
            <span v-else />
            <span class="text-muted-foreground"
                >Page {{ messages.current_page }} of
                {{ messages.last_page }}</span
            >
            <Link
                v-if="messages.next_page_url"
                :href="messages.next_page_url"
                class="text-accent-text hover:underline"
                >Older →</Link
            >
            <span v-else />
        </div>
    </div>
</template>
