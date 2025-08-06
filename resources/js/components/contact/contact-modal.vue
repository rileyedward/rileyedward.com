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
            class="fixed right-6 bottom-6 z-50 flex h-14 w-14 cursor-pointer items-center justify-center rounded-full bg-gradient-to-br from-purple-500 to-purple-600 text-white shadow-lg transition-all duration-300 hover:from-purple-600 hover:to-purple-700 hover:shadow-xl focus:ring-4 focus:ring-purple-300 focus:outline-none active:scale-95"
            aria-label="Contact Me"
        >
            <mail-icon class="h-6 w-6" />
        </button>

        <Transition
            enter-active-class="transition-all duration-300 ease-out"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition-all duration-200 ease-in"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
        >
            <div
                v-if="isOpen"
                class="bg-opacity-50 fixed inset-0 z-50 flex items-center justify-center bg-black p-4 backdrop-blur-sm"
                @click="closeModal"
            >
                <div
                    class="w-full max-w-2xl rounded-xl border border-neutral-700/50 bg-gradient-to-br from-neutral-900 via-neutral-800 to-neutral-900 p-8 shadow-2xl backdrop-filter"
                    @click.stop
                >
                    <div class="mb-6 flex items-start justify-between">
                        <div class="flex items-center space-x-3">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-full bg-gradient-to-br from-purple-500 to-purple-600 shadow-lg"
                            >
                                <mail-icon class="h-6 w-6 text-white" />
                            </div>
                            <div>
                                <h2 class="bg-gradient-to-r from-white to-neutral-300 bg-clip-text text-3xl font-bold text-transparent">
                                    Contact Me
                                </h2>
                                <p class="mt-1 text-neutral-400">Have a question or want to work together? Send me a message!</p>
                            </div>
                        </div>
                        <button
                            @click="closeModal"
                            class="rounded-full p-2 text-neutral-400 transition-all duration-200 hover:bg-neutral-700 hover:text-white focus:ring-2 focus:ring-purple-400 focus:outline-none"
                            aria-label="Close"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form @submit.prevent="submit" class="space-y-5">
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="group">
                                <label
                                    for="name"
                                    class="mb-2 block text-sm font-medium text-neutral-300 transition-colors duration-200 group-focus-within:text-purple-400"
                                    >Name *</label
                                >
                                <input
                                    id="name"
                                    v-model="form.name"
                                    type="text"
                                    class="w-full rounded-lg border border-neutral-600 bg-neutral-800/50 px-4 py-3 text-white placeholder-neutral-500 shadow-sm backdrop-blur-sm transition-all duration-200 hover:bg-neutral-800/70 focus:border-purple-500 focus:bg-neutral-800 focus:ring-2 focus:ring-purple-500/20 focus:outline-none"
                                    placeholder="Your full name"
                                    required
                                />
                                <div v-if="form.errors.name" class="mt-2 flex items-center space-x-1 text-sm text-red-400">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    <span>{{ form.errors.name }}</span>
                                </div>
                            </div>

                            <div class="group">
                                <label
                                    for="business_name"
                                    class="mb-2 block text-sm font-medium text-neutral-300 transition-colors duration-200 group-focus-within:text-purple-400"
                                    >Business Name</label
                                >
                                <input
                                    id="business_name"
                                    v-model="form.business_name"
                                    type="text"
                                    class="w-full rounded-lg border border-neutral-600 bg-neutral-800/50 px-4 py-3 text-white placeholder-neutral-500 shadow-sm backdrop-blur-sm transition-all duration-200 hover:bg-neutral-800/70 focus:border-purple-500 focus:bg-neutral-800 focus:ring-2 focus:ring-purple-500/20 focus:outline-none"
                                    placeholder="Company or organization"
                                />
                                <div v-if="form.errors.business_name" class="mt-2 flex items-center space-x-1 text-sm text-red-400">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    <span>{{ form.errors.business_name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div class="group">
                                <label
                                    for="email"
                                    class="mb-2 block text-sm font-medium text-neutral-300 transition-colors duration-200 group-focus-within:text-purple-400"
                                    >Email *</label
                                >
                                <input
                                    id="email"
                                    v-model="form.email"
                                    type="email"
                                    class="w-full rounded-lg border border-neutral-600 bg-neutral-800/50 px-4 py-3 text-white placeholder-neutral-500 shadow-sm backdrop-blur-sm transition-all duration-200 hover:bg-neutral-800/70 focus:border-purple-500 focus:bg-neutral-800 focus:ring-2 focus:ring-purple-500/20 focus:outline-none"
                                    placeholder="your@email.com"
                                    required
                                />
                                <div v-if="form.errors.email" class="mt-2 flex items-center space-x-1 text-sm text-red-400">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    <span>{{ form.errors.email }}</span>
                                </div>
                            </div>

                            <div class="group">
                                <label
                                    for="phone"
                                    class="mb-2 block text-sm font-medium text-neutral-300 transition-colors duration-200 group-focus-within:text-purple-400"
                                    >Phone</label
                                >
                                <input
                                    id="phone"
                                    v-model="form.phone"
                                    type="tel"
                                    class="w-full rounded-lg border border-neutral-600 bg-neutral-800/50 px-4 py-3 text-white placeholder-neutral-500 shadow-sm backdrop-blur-sm transition-all duration-200 hover:bg-neutral-800/70 focus:border-purple-500 focus:bg-neutral-800 focus:ring-2 focus:ring-purple-500/20 focus:outline-none"
                                    placeholder="(555) 123-4567"
                                />
                                <div v-if="form.errors.phone" class="mt-2 flex items-center space-x-1 text-sm text-red-400">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    <span>{{ form.errors.phone }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="group">
                            <label
                                for="subject"
                                class="mb-2 block text-sm font-medium text-neutral-300 transition-colors duration-200 group-focus-within:text-purple-400"
                                >Subject *</label
                            >
                            <input
                                id="subject"
                                v-model="form.subject"
                                type="text"
                                class="w-full rounded-lg border border-neutral-600 bg-neutral-800/50 px-4 py-3 text-white placeholder-neutral-500 shadow-sm backdrop-blur-sm transition-all duration-200 hover:bg-neutral-800/70 focus:border-purple-500 focus:bg-neutral-800 focus:ring-2 focus:ring-purple-500/20 focus:outline-none"
                                placeholder="What would you like to discuss?"
                                required
                            />
                            <div v-if="form.errors.subject" class="mt-2 flex items-center space-x-1 text-sm text-red-400">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span>{{ form.errors.subject }}</span>
                            </div>
                        </div>

                        <div class="group">
                            <label
                                for="message"
                                class="mb-2 block text-sm font-medium text-neutral-300 transition-colors duration-200 group-focus-within:text-purple-400"
                                >Message *</label
                            >
                            <textarea
                                id="message"
                                v-model="form.message"
                                rows="5"
                                class="w-full resize-none rounded-lg border border-neutral-600 bg-neutral-800/50 px-4 py-3 text-white placeholder-neutral-500 shadow-sm backdrop-blur-sm transition-all duration-200 hover:bg-neutral-800/70 focus:border-purple-500 focus:bg-neutral-800 focus:ring-2 focus:ring-purple-500/20 focus:outline-none"
                                placeholder="Tell me about your project, questions, or how I can help..."
                                required
                            ></textarea>
                            <div v-if="form.errors.message" class="mt-2 flex items-center space-x-1 text-sm text-red-400">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span>{{ form.errors.message }}</span>
                            </div>
                        </div>

                        <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                            <button
                                type="button"
                                class="w-full rounded-lg border border-neutral-600 bg-neutral-800/50 px-6 py-3 text-sm font-medium text-neutral-300 shadow-sm backdrop-blur-sm transition-all duration-200 hover:border-neutral-500 hover:bg-neutral-700 hover:text-white focus:ring-2 focus:ring-purple-500/20 focus:outline-none sm:w-auto"
                                @click="closeModal"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="w-full rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 px-8 py-3 text-sm font-medium text-white shadow-lg transition-all duration-200 hover:from-purple-600 hover:to-purple-700 hover:shadow-xl focus:ring-2 focus:ring-purple-500/50 focus:outline-none active:scale-95 disabled:transform-none disabled:cursor-not-allowed disabled:opacity-50 sm:w-auto"
                                :disabled="form.processing"
                            >
                                <span v-if="form.processing" class="flex items-center justify-center space-x-2">
                                    <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path
                                            class="opacity-75"
                                            fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                        ></path>
                                    </svg>
                                    <span>Sending...</span>
                                </span>
                                <span v-else class="flex items-center justify-center space-x-2">
                                    <mail-icon class="h-4 w-4" />
                                    <span>Send Message</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </Transition>
    </div>
</template>
