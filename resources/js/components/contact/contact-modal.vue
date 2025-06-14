<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { MailIcon } from 'lucide-vue-next';
import { ref } from 'vue';

const isOpen = ref(false);

const form = useForm({
    name: '',
    business_name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
});

const openModal = () => {
    isOpen.value = true;
};

const closeModal = () => {
    isOpen.value = false;
    form.reset();
    form.clearErrors();
};

const submit = () => {
    form.post(route('contact-message'), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal();
        },
    });
};
</script>

<template>
    <div>
        <button
            @click="openModal"
            class="fixed right-6 bottom-6 z-50 flex h-14 w-14 cursor-pointer items-center justify-center rounded-full bg-white text-black shadow-lg hover:bg-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:outline-none"
            aria-label="Contact Me"
        >
            <mail-icon />
        </button>

        <div
            v-if="isOpen"
            class="bg-opacity-60 fixed inset-0 z-50 flex items-center justify-center bg-black p-4 backdrop-blur-md"
            @click="closeModal"
        >
            <div class="w-full max-w-2xl rounded-lg bg-neutral-900 p-6 shadow-2xl backdrop-filter" @click.stop>
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white">Contact Me</h2>
                        <p class="mt-1 text-neutral-400">Have a question or want to work together? Send me a message!</p>
                    </div>
                    <button @click="closeModal" class="text-neutral-400 hover:text-white focus:outline-none" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="submit" class="mt-4">
                    <div class="mb-4 flex w-full items-center gap-4">
                        <div class="w-full">
                            <label for="name" class="mb-1 block text-sm font-medium text-neutral-300">Name *</label>
                            <input
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="w-full rounded-md border border-neutral-600 bg-neutral-800 px-3 py-2 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                                required
                            />
                            <div v-if="form.errors.name" class="mt-1 text-sm text-red-400">{{ form.errors.name }}</div>
                        </div>

                        <div class="w-full">
                            <label for="business_name" class="mb-1 block text-sm font-medium text-neutral-300">Business Name (Optional)</label>
                            <input
                                id="business_name"
                                v-model="form.business_name"
                                type="text"
                                class="w-full rounded-md border border-neutral-600 bg-neutral-800 px-3 py-2 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            />
                            <div v-if="form.errors.business_name" class="mt-1 text-sm text-red-400">{{ form.errors.business_name }}</div>
                        </div>
                    </div>

                    <div class="mb-4 flex w-full items-center gap-4">
                        <div class="w-full">
                            <label for="email" class="mb-1 block text-sm font-medium text-neutral-300">Email *</label>
                            <input
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="w-full rounded-md border border-neutral-600 bg-neutral-800 px-3 py-2 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                                required
                            />
                            <div v-if="form.errors.email" class="mt-1 text-sm text-red-400">{{ form.errors.email }}</div>
                        </div>

                        <div class="w-full">
                            <label for="phone" class="mb-1 block text-sm font-medium text-neutral-300">Phone (Optional)</label>
                            <input
                                id="phone"
                                v-model="form.phone"
                                type="tel"
                                class="w-full rounded-md border border-neutral-600 bg-neutral-800 px-3 py-2 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            />
                            <div v-if="form.errors.phone" class="mt-1 text-sm text-red-400">{{ form.errors.phone }}</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="subject" class="mb-1 block text-sm font-medium text-neutral-300">Subject *</label>
                        <input
                            id="subject"
                            v-model="form.subject"
                            type="text"
                            class="w-full rounded-md border border-neutral-600 bg-neutral-800 px-3 py-2 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            required
                        />
                        <div v-if="form.errors.subject" class="mt-1 text-sm text-red-400">{{ form.errors.subject }}</div>
                    </div>

                    <div class="mb-4">
                        <label for="message" class="mb-1 block text-sm font-medium text-neutral-300">Message *</label>
                        <textarea
                            id="message"
                            v-model="form.message"
                            rows="4"
                            class="w-full rounded-md border border-neutral-600 bg-neutral-800 px-3 py-2 text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            required
                        ></textarea>
                        <div v-if="form.errors.message" class="mt-1 text-sm text-red-400">{{ form.errors.message }}</div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button
                            type="button"
                            class="mr-2 rounded-md border border-neutral-600 bg-neutral-800 px-4 py-2 text-sm font-medium text-neutral-300 shadow-sm hover:bg-neutral-700 hover:text-white focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-neutral-900 focus:outline-none"
                            @click="closeModal"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="rounded-md bg-purple-500 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-purple-400 focus:ring-2 focus:ring-purple-400 focus:ring-offset-2 focus:ring-offset-neutral-900 focus:outline-none"
                            :disabled="form.processing"
                        >
                            {{ form.processing ? 'Sending...' : 'Send Message' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
