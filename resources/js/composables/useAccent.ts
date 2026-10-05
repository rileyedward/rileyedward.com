import type { Ref } from 'vue';
import { onMounted, ref } from 'vue';
import type { Accent } from '@/lib/accents';
import { defaultAccent, isAccent } from '@/lib/accents';
import { setCookie } from '@/lib/utils';

export type UseAccentReturn = {
    accent: Ref<Accent>;
    updateAccent: (value: Accent) => void;
};

const accent = ref<Accent>(defaultAccent);

function applyAccent(value: Accent): void {
    if (typeof document === 'undefined') {
        return;
    }

    document.documentElement.dataset.accent = value;
}

/**
 * The server renders data-accent from the cookie. If the cookie is gone but
 * localStorage still remembers a choice, restore it (and the cookie).
 */
export function initializeAccent(): void {
    if (typeof window === 'undefined') {
        return;
    }

    const stored = localStorage.getItem('accent');
    const rendered = document.documentElement.dataset.accent;

    if (isAccent(stored) && stored !== rendered) {
        applyAccent(stored);
        setCookie('accent', stored);
    }
}

export function useAccent(): UseAccentReturn {
    onMounted(() => {
        const current = document.documentElement.dataset.accent;

        if (isAccent(current)) {
            accent.value = current;
        }
    });

    function updateAccent(value: Accent) {
        accent.value = value;
        localStorage.setItem('accent', value);
        setCookie('accent', value);
        applyAccent(value);
    }

    return { accent, updateAccent };
}
