import { writable } from 'svelte/store';

export const showContactModal = writable(false);

export const globalAlert = writable<string | null>(null);
