# Blog Components

## Blog Content Component

The `blog-content.vue` component is used to render markdown content in blog posts. It uses the `marked` library to convert markdown to HTML and applies styling using Tailwind's prose classes.

### Installation

To use this component, you need to install the following packages:

```bash
# Install marked for markdown parsing
npm install marked

# Install @tailwindcss/typography for prose classes (if not already installed)
npm install @tailwindcss/typography
```

Then, update your `tailwind.config.js` or `tailwind.config.ts` file to include the typography plugin:

```javascript
// tailwind.config.js or tailwind.config.ts
module.exports = {
    // ...
    plugins: [
        require('@tailwindcss/typography'),
        // ...other plugins
    ],
};
```

### Usage

```vue
<template>
    <!-- Assuming you have a blogPost object with a content property -->
    <blog-content :content="yourMarkdownContent" />
</template>

<script setup lang="ts">
// Import the component from your project structure
import BlogContent from '../components/blog/blog-content.vue';
</script>
```

### Styling

The component includes custom styling for various markdown elements. You can customize these styles in the `<style>` section of the component.
