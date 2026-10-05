/**
 * Verifies every accent preset meets WCAG AA (4.5:1) for text in both modes:
 * the 600 step on the light background and the 400 step on the dark one.
 * The ladder and hues are read straight from resources/css/app.css.
 */
import { readFileSync } from 'node:fs';
import { clampChroma, parse, wcagContrast } from 'culori';

const css = readFileSync(
    new URL('../resources/css/app.css', import.meta.url),
    'utf8',
);

const step = (name) => {
    const match = css.match(
        new RegExp(
            `--accent-${name}:\\s*oklch\\(\\s*([\\d.]+)\\s+calc\\(\\s*([\\d.]+)\\s*\\*\\s*var\\(--accent-chroma\\)\\s*\\)`,
        ),
    );

    if (!match) {
        throw new Error(`Accent step ${name} not found in app.css`);
    }

    return { l: Number(match[1]), c: Number(match[2]) };
};

const background = (selector) => {
    const block = css.match(
        new RegExp(`\\n${selector} \\{\\s*--background:\\s*(oklch\\([^)]+\\))`),
    );

    return parse(block[1]);
};

const presets = [
    ...css.matchAll(
        /\[data-accent='(\w+)'\]\s*\{\s*--accent-hue:\s*([\d.]+);/g,
    ),
].map(([, name, hue]) => ({ name, hue: Number(hue) }));

const checks = [
    { mode: 'light', step: step('600'), background: background(':root') },
    { mode: 'dark', step: step('400'), background: background('\\.dark') },
];

let failed = false;

for (const preset of presets) {
    for (const check of checks) {
        const color = clampChroma(
            { mode: 'oklch', l: check.step.l, c: check.step.c, h: preset.hue },
            'oklch',
        );
        const ratio = wcagContrast(color, check.background);
        const ok = ratio >= 4.5;

        failed ||= !ok;
        console.log(
            `${ok ? 'pass' : 'FAIL'}  ${preset.name.padEnd(8)} ${check.mode.padEnd(5)} ${ratio.toFixed(2)}:1`,
        );
    }
}

if (presets.length !== 8) {
    console.error(`Expected 8 accent presets, found ${presets.length}`);
    failed = true;
}

process.exit(failed ? 1 : 0);
