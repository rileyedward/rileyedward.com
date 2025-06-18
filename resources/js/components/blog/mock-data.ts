import { BlogPost } from '@/types/models/blog-post';
import { Category } from '@/types/models/category';

// Mock categories
export const mockCategories: Category[] = [
    {
        id: 1,
        name: 'Web Development',
        slug: 'web-development',
        created_at: '2023-01-01T00:00:00.000Z',
        updated_at: '2023-01-01T00:00:00.000Z',
    },
    {
        id: 2,
        name: 'Programming',
        slug: 'programming',
        created_at: '2023-01-01T00:00:00.000Z',
        updated_at: '2023-01-01T00:00:00.000Z',
    },
    {
        id: 3,
        name: 'Design',
        slug: 'design',
        created_at: '2023-01-01T00:00:00.000Z',
        updated_at: '2023-01-01T00:00:00.000Z',
    },
    {
        id: 4,
        name: 'Career',
        slug: 'career',
        created_at: '2023-01-01T00:00:00.000Z',
        updated_at: '2023-01-01T00:00:00.000Z',
    },
];

// Mock blog posts
export const mockBlogPosts: (BlogPost & { published_at: string; author: string; category: string })[] = [
    {
        id: 1,
        category_id: 1,
        title: 'Getting Started with Vue 3 and TypeScript',
        slug: 'getting-started-with-vue-3-and-typescript',
        content: `
# Getting Started with Vue 3 and TypeScript

Vue 3 and TypeScript make a powerful combination for building robust web applications. In this post, we'll explore how to set up a new project and leverage the type safety that TypeScript provides.

## Prerequisites

Before we begin, make sure you have Node.js and npm installed on your machine.

## Creating a New Project

You can create a new Vue 3 project with TypeScript using the Vue CLI:

\`\`\`bash
npm init vue@latest
\`\`\`

Follow the prompts and make sure to select TypeScript when asked.

## Key Benefits

- **Type Safety**: Catch errors at compile time rather than runtime
- **Better IDE Support**: Get better autocomplete and intellisense
- **Improved Maintainability**: Types serve as documentation for your code
    `,
        is_published: '1',
        created_at: '2023-03-15T10:00:00.000Z',
        updated_at: '2023-03-15T10:00:00.000Z',
        published_at: '2023-03-15T10:00:00.000Z',
        author: 'Riley Edward',
        category: 'Web Development',
    },
    {
        id: 2,
        category_id: 2,
        title: 'Understanding JavaScript Promises',
        slug: 'understanding-javascript-promises',
        content: `
# Understanding JavaScript Promises

Promises are a powerful feature in JavaScript that help manage asynchronous operations. Let's dive into how they work and how to use them effectively.

## What is a Promise?

A Promise is an object representing the eventual completion or failure of an asynchronous operation. It allows you to attach callbacks for when the operation succeeds or fails.

## Basic Usage

\`\`\`javascript
const myPromise = new Promise((resolve, reject) => {
  // Asynchronous operation
  if (/* operation successful */) {
    resolve('Success!');
  } else {
    reject('Failure!');
  }
});

myPromise
  .then(result => console.log(result))
  .catch(error => console.error(error));
\`\`\`

## Chaining Promises

One of the most powerful features of Promises is the ability to chain them:

\`\`\`javascript
fetchData()
  .then(processData)
  .then(saveData)
  .catch(handleError);
\`\`\`
    `,
        is_published: '1',
        created_at: '2023-04-20T14:30:00.000Z',
        updated_at: '2023-04-20T14:30:00.000Z',
        published_at: '2023-04-20T14:30:00.000Z',
        author: 'Riley Edward',
        category: 'Programming',
    },
    {
        id: 3,
        category_id: 3,
        title: 'Principles of Modern Web Design',
        slug: 'principles-of-modern-web-design',
        content: `
# Principles of Modern Web Design

Good design is crucial for creating effective websites. Here are some key principles to follow for modern web design.

## Simplicity

Keep your designs clean and focused. Remove unnecessary elements and make sure every part of your design serves a purpose.

## Responsive Design

Ensure your website looks good on all devices, from desktop computers to smartphones.

## Accessibility

Design with all users in mind, including those with disabilities. Use appropriate contrast, provide alt text for images, and ensure keyboard navigation works.

## Visual Hierarchy

Guide users through your content by establishing a clear visual hierarchy. Use size, color, and spacing to indicate the importance of elements.

## Consistency

Maintain consistency in your design elements, such as colors, fonts, and button styles, to create a cohesive experience.
    `,
        is_published: '1',
        created_at: '2023-05-10T09:15:00.000Z',
        updated_at: '2023-05-10T09:15:00.000Z',
        published_at: '2023-05-10T09:15:00.000Z',
        author: 'Riley Edward',
        category: 'Design',
    },
    {
        id: 4,
        category_id: 4,
        title: 'Navigating a Career in Tech',
        slug: 'navigating-a-career-in-tech',
        content: `
# Navigating a Career in Tech

The tech industry offers exciting opportunities but can be challenging to navigate. Here are some tips for building a successful career in technology.

## Continuous Learning

Technology evolves rapidly, so commit to lifelong learning. Stay updated with the latest trends, tools, and best practices in your field.

## Building a Portfolio

Create a strong portfolio showcasing your skills and projects. This is often more valuable than formal qualifications in the tech industry.

## Networking

Connect with other professionals in your field. Attend meetups, conferences, and online forums to build relationships and learn from others.

## Finding Mentors

Seek out experienced professionals who can provide guidance and advice. A good mentor can help you avoid common pitfalls and accelerate your growth.

## Work-Life Balance

The tech industry can be demanding, so prioritize your well-being. Set boundaries and make time for activities outside of work.
    `,
        is_published: '1',
        created_at: '2023-06-05T16:45:00.000Z',
        updated_at: '2023-06-05T16:45:00.000Z',
        published_at: '2023-06-05T16:45:00.000Z',
        author: 'Riley Edward',
        category: 'Career',
    },
    {
        id: 5,
        category_id: 1,
        title: 'Building Responsive Layouts with Tailwind CSS',
        slug: 'building-responsive-layouts-with-tailwind-css',
        content: `
# Building Responsive Layouts with Tailwind CSS

Tailwind CSS is a utility-first CSS framework that makes it easy to create responsive, custom designs. Let's explore how to use it effectively.

## Getting Started

First, install Tailwind CSS in your project:

\`\`\`bash
npm install tailwindcss
\`\`\`

Then, create a configuration file:

\`\`\`bash
npx tailwindcss init
\`\`\`

## Responsive Design

Tailwind makes responsive design simple with breakpoint prefixes:

\`\`\`html
<div class="w-full md:w-1/2 lg:w-1/3">
  <!-- This div will be full width on small screens,
       half width on medium screens,
       and one-third width on large screens -->
</div>
\`\`\`

## Customization

You can customize Tailwind by editing the tailwind.config.js file:

\`\`\`javascript
module.exports = {
  theme: {
    extend: {
      colors: {
        'brand-blue': '#1992d4',
      },
      spacing: {
        '72': '18rem',
        '84': '21rem',
      }
    }
  }
}
\`\`\`
    `,
        is_published: '1',
        created_at: '2023-07-12T11:20:00.000Z',
        updated_at: '2023-07-12T11:20:00.000Z',
        published_at: '2023-07-12T11:20:00.000Z',
        author: 'Riley Edward',
        category: 'Web Development',
    },
    {
        id: 6,
        category_id: 2,
        title: 'Introduction to TypeScript for JavaScript Developers',
        slug: 'introduction-to-typescript-for-javascript-developers',
        content: `
# Introduction to TypeScript for JavaScript Developers

TypeScript extends JavaScript by adding types, making it easier to write robust, maintainable code. Here's what you need to know to get started.

## Why TypeScript?

TypeScript offers several advantages over plain JavaScript:

- Static typing
- Better tooling and IDE support
- Early error detection
- Improved code organization with interfaces and types

## Basic Types

TypeScript provides several basic types:

\`\`\`typescript
// Boolean
let isDone: boolean = false;

// Number
let decimal: number = 6;

// String
let color: string = "blue";

// Array
let list: number[] = [1, 2, 3];
let list2: Array<number> = [1, 2, 3];

// Tuple
let x: [string, number] = ["hello", 10];

// Enum
enum Color {Red, Green, Blue}
let c: Color = Color.Green;

// Any
let notSure: any = 4;
notSure = "maybe a string";

// Void
function warnUser(): void {
  console.log("This is a warning message");
}
\`\`\`

## Interfaces

Interfaces define the structure of objects:

\`\`\`typescript
interface User {
  name: string;
  id: number;
  email?: string; // Optional property
  readonly createdAt: Date; // Read-only property
}

function createUser(user: User): User {
  return user;
}
\`\`\`
    `,
        is_published: '1',
        created_at: '2023-08-18T13:40:00.000Z',
        updated_at: '2023-08-18T13:40:00.000Z',
        published_at: '2023-08-18T13:40:00.000Z',
        author: 'Riley Edward',
        category: 'Programming',
    },
];

// Helper function to get category name by ID
export function getCategoryNameById(categoryId: number): string {
    const category = mockCategories.find((cat) => cat.id === categoryId);
    return category ? category.name : '';
}
