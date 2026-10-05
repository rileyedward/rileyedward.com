<script setup lang="ts">
import { Monitor, Moon, Palette, Sun } from '@lucide/vue';
import {
    PopoverContent,
    PopoverPortal,
    PopoverRoot,
    PopoverTrigger,
} from 'reka-ui';
import AccentSwatches from '@/components/site/AccentSwatches.vue';
import { useAppearance } from '@/composables/useAppearance';

const { appearance, updateAppearance } = useAppearance();

const modes = [
    { value: 'light', Icon: Sun, label: 'Light' },
    { value: 'dark', Icon: Moon, label: 'Dark' },
    { value: 'system', Icon: Monitor, label: 'System' },
] as const;
</script>

<template>
    <PopoverRoot>
        <PopoverTrigger
            class="inline-flex size-9 cursor-pointer items-center justify-center rounded-full border border-border text-muted-foreground outline-none hover:border-accent-500/60 hover:text-accent-text focus-visible:ring-2 focus-visible:ring-ring"
            aria-label="Theme settings"
        >
            <Palette class="size-4" />
        </PopoverTrigger>
        <PopoverPortal>
            <PopoverContent
                align="end"
                :side-offset="8"
                class="z-50 w-64 rounded-xl border border-border bg-popover p-4 text-popover-foreground shadow-lg data-[state=open]:animate-in data-[state=open]:fade-in-0 data-[state=open]:zoom-in-95"
            >
                <p class="font-mono text-xs text-muted-foreground uppercase">
                    Mode
                </p>
                <div
                    class="mt-2 grid grid-cols-3 gap-1 rounded-lg bg-muted p-1"
                    role="radiogroup"
                    aria-label="Color mode"
                >
                    <button
                        v-for="{ value, Icon, label } in modes"
                        :key="value"
                        type="button"
                        role="radio"
                        :aria-checked="appearance === value"
                        class="flex cursor-pointer items-center justify-center gap-1.5 rounded-md px-2 py-1.5 text-xs outline-none focus-visible:ring-2 focus-visible:ring-ring"
                        :class="
                            appearance === value
                                ? 'bg-background text-foreground shadow-xs'
                                : 'text-muted-foreground hover:text-foreground'
                        "
                        @click="updateAppearance(value)"
                    >
                        <component :is="Icon" class="size-3.5" />
                        {{ label }}
                    </button>
                </div>

                <p
                    class="mt-4 font-mono text-xs text-muted-foreground uppercase"
                >
                    Accent
                </p>
                <AccentSwatches class="mt-2" />
            </PopoverContent>
        </PopoverPortal>
    </PopoverRoot>
</template>
