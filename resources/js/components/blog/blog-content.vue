<script setup lang="ts">
import { Props } from '@/types/components/blog/blog-content';
import { marked } from 'marked';
import { computed } from 'vue';

const props = defineProps<Props>();

marked.setOptions({
    breaks: true,
    gfm: true,
});

const htmlContent = computed(() => {
    try {
        if (!props.content) return '<p>No content available</p>';
        return marked(props.content);
    } catch (error) {
        console.error('Error parsing markdown:', error);
        return '<p>Error rendering content</p>';
    }
});
</script>

<template>
    <div class="blog-content mx-auto max-w-4xl">
        <div v-html="htmlContent" class="prose prose-invert prose-lg"></div>
    </div>
</template>

<style>
/* Global styles for markdown content */
.prose-invert h1,
.prose-invert h2,
.prose-invert h3,
.prose-invert h4,
.prose-invert h5,
.prose-invert h6 {
    color: white;
    margin-top: 2em;
    margin-bottom: 1em;
}

.prose-invert h1 {
    font-size: 2.25em;
}

.prose-invert h2 {
    font-size: 1.875em;
}

.prose-invert h3 {
    font-size: 1.5em;
}

.prose-invert a {
    color: #a78bfa;
    text-decoration: underline;
}

.prose-invert a:hover {
    color: #c4b5fd;
}

.prose-invert p {
    margin-top: 1.25em;
    margin-bottom: 1.25em;
}

.prose-invert ul,
.prose-invert ol {
    margin-top: 1.25em;
    margin-bottom: 1.25em;
    padding-left: 1.625em;
}

.prose-invert ul {
    list-style-type: disc;
}

.prose-invert ol {
    list-style-type: decimal;
}

.prose-invert li {
    margin-top: 0.5em;
    margin-bottom: 0.5em;
}

.prose-invert blockquote {
    font-style: italic;
    border-left-width: 0.25rem;
    border-left-color: #4b5563;
    padding-left: 1em;
    margin-top: 1.6em;
    margin-bottom: 1.6em;
}

.prose-invert code {
    color: #e5e7eb;
    background-color: #374151;
    padding: 0.2em 0.4em;
    border-radius: 0.25rem;
    font-size: 0.875em;
}

.prose-invert pre {
    background-color: #1f2937;
    border-radius: 0.375rem;
    overflow-x: auto;
    padding: 1em;
    margin-top: 1.6em;
    margin-bottom: 1.6em;
}

.prose-invert pre code {
    background-color: transparent;
    padding: 0;
    font-size: 0.875em;
    color: #e5e7eb;
}

.prose-invert img {
    margin-top: 2em;
    margin-bottom: 2em;
    border-radius: 0.375rem;
}

.prose-invert hr {
    border-color: #4b5563;
    margin-top: 3em;
    margin-bottom: 3em;
}

.prose-invert table {
    width: 100%;
    table-layout: auto;
    text-align: left;
    margin-top: 2em;
    margin-bottom: 2em;
    border-collapse: collapse;
}

.prose-invert thead {
    border-bottom-width: 1px;
    border-bottom-color: #4b5563;
}

.prose-invert th {
    color: #e5e7eb;
    font-weight: 600;
    padding: 0.75em 1em;
    vertical-align: bottom;
}

.prose-invert td {
    padding: 0.75em 1em;
    vertical-align: top;
    border-top-width: 1px;
    border-top-color: #4b5563;
}
</style>
