/**
 * Accent presets. Hues live in resources/css/app.css ([data-accent] blocks);
 * this list only drives the swatch picker and must use the same names.
 */
export const accents = [
    'sky',
    'blue',
    'indigo',
    'violet',
    'pink',
    'rose',
    'amber',
    'emerald',
] as const;

export type Accent = (typeof accents)[number];

export const defaultAccent: Accent = 'sky';

export function isAccent(value: unknown): value is Accent {
    return accents.includes(value as Accent);
}
