<script setup lang="ts">
import { Form, Head, Link } from '@inertiajs/vue3';
import {
    Archive,
    ArchiveRestore,
    Copy,
    Mail,
    MailOpen,
    Trash2,
} from '@lucide/vue';
import { ref } from 'vue';
import ContactMessageController from '@/actions/App/Http/Controllers/Admin/ContactMessageController';
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
import { formatDateTime } from '@/lib/dates';
import { index as inbox } from '@/routes/inbox';
import type { InboxMessage } from '@/types';

const props = defineProps<{
    message: InboxMessage;
}>();

defineOptions({
    layout: {
        breadcrumbs: [{ title: 'Inbox', href: inbox() }],
    },
});

const mailto = `mailto:${props.message.email}?subject=${encodeURIComponent('Re: your message to Riley Edward')}`;

const copied = ref(false);

async function copyEmail() {
    await navigator.clipboard.writeText(props.message.email);
    copied.value = true;
    setTimeout(() => (copied.value = false), 1500);
}
</script>

<template>
    <Head :title="`Message from ${message.name}`" />

    <div class="flex max-w-3xl flex-1 flex-col gap-6 p-4 md:p-6">
        <Link
            :href="
                inbox({ query: message.isArchived ? { tab: 'archived' } : {} })
            "
            class="text-sm text-muted-foreground hover:text-foreground"
            >← Back to {{ message.isArchived ? 'archived' : 'inbox' }}</Link
        >

        <header>
            <h1 class="text-xl font-semibold">{{ message.name }}</h1>
            <p class="text-sm text-muted-foreground">
                Received
                <time :datetime="message.receivedAt ?? undefined">{{
                    formatDateTime(message.receivedAt)
                }}</time>
            </p>
        </header>

        <div class="flex flex-wrap gap-2">
            <Button as-child>
                <a :href="mailto"><Mail /> Reply by email</a>
            </Button>
            <Button variant="outline" @click="copyEmail">
                <Copy /> {{ copied ? 'Copied' : 'Copy email' }}
            </Button>
            <Form v-bind="ContactMessageController.markUnread.form(message.id)">
                <Button variant="outline" type="submit">
                    <MailOpen /> Mark unread
                </Button>
            </Form>
            <Form
                v-if="message.isArchived"
                v-bind="ContactMessageController.unarchive.form(message.id)"
            >
                <Button variant="outline" type="submit">
                    <ArchiveRestore /> Unarchive
                </Button>
            </Form>
            <Form
                v-else
                v-bind="ContactMessageController.archive.form(message.id)"
            >
                <Button variant="outline" type="submit">
                    <Archive /> Archive
                </Button>
            </Form>
            <Dialog>
                <DialogTrigger as-child>
                    <Button variant="destructive"><Trash2 /> Delete</Button>
                </DialogTrigger>
                <DialogContent>
                    <DialogHeader>
                        <DialogTitle>Delete this message?</DialogTitle>
                        <DialogDescription>
                            The message from {{ message.name }} will be
                            permanently deleted. This can't be undone.
                        </DialogDescription>
                    </DialogHeader>
                    <DialogFooter class="gap-2">
                        <DialogClose as-child>
                            <Button variant="secondary">Cancel</Button>
                        </DialogClose>
                        <Form
                            v-bind="
                                ContactMessageController.destroy.form(
                                    message.id,
                                )
                            "
                            v-slot="{ processing }"
                        >
                            <Button
                                variant="destructive"
                                type="submit"
                                :disabled="processing"
                                >Delete message</Button
                            >
                        </Form>
                    </DialogFooter>
                </DialogContent>
            </Dialog>
        </div>

        <dl
            class="grid gap-4 rounded-xl border border-border p-5 text-sm sm:grid-cols-2"
        >
            <div>
                <dt class="text-muted-foreground">Email</dt>
                <dd class="mt-0.5 break-all">
                    <a
                        :href="mailto"
                        class="text-accent-text hover:underline"
                        >{{ message.email }}</a
                    >
                </dd>
            </div>
            <div>
                <dt class="text-muted-foreground">Business</dt>
                <dd class="mt-0.5">{{ message.businessName || '—' }}</dd>
            </div>
            <div>
                <dt class="text-muted-foreground">Phone</dt>
                <dd class="mt-0.5">
                    <a
                        v-if="message.phone"
                        :href="`tel:${message.phone}`"
                        class="text-accent-text hover:underline"
                        >{{ message.phone }}</a
                    >
                    <template v-else>—</template>
                </dd>
            </div>
            <div>
                <dt class="text-muted-foreground">Sender IP</dt>
                <dd class="mt-0.5 font-mono">{{ message.ipAddress || '—' }}</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-muted-foreground">Browser</dt>
                <dd class="mt-0.5 font-mono text-xs break-all">
                    {{ message.userAgent || '—' }}
                </dd>
            </div>
        </dl>

        <div
            class="rounded-xl border border-border p-5 leading-7 whitespace-pre-wrap"
        >
            {{ message.message }}
        </div>
    </div>
</template>
