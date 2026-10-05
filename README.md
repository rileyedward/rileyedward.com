# rileyedward.com

My personal website.

## Overview

### What is rileyedward.com?

rileyedward.com is the freelance site for Riley Edward, a Kansas City developer building custom web apps for local businesses. Visitors can read about what I build, browse client and personal projects, learn about my background, and send an inquiry through the contact form. Behind the scenes, a private admin panel manages the inbox, the projects shown on the site, and the site-wide settings.

### Why Use rileyedward.com?

Most portfolio sites hard-code their content, so every new project or changed detail means a code change and a deploy. Here the projects, their write-ups and screenshots, and details like the availability line all live in the database and are edited from the admin, so the site stays current without touching the code. Inquiries land in a private inbox instead of a third-party form service, and nothing is emailed.

### Key Features

- **Project Showcase**: Client and personal projects with markdown write-ups, stack chips, cover screenshots and live or repository links, filterable by kind.
- **Contact Inbox**: Inquiries from the contact form, with search, read and unread states, archiving, and one-click email replies. Spam is caught with a honeypot field and a limit of five submissions per hour.
- **Project Admin**: Drag projects into order, toggle Visible and Featured with immediate effect, preview hidden projects, and upload screenshots that are resized to WebP.
- **Site Settings**: The availability line, public email, GitHub and LinkedIn links, and career start year, editable without a deploy.
- **Choose-Your-Own Accent**: Light, dark or system mode plus eight accent colors, remembered per visitor and rendered on the server with no flash. Every accent passes WCAG AA contrast in both modes.

## Getting Started

### Prerequisites

Ensure you have the following prerequisites installed on your system. You can verify each installation by running the provided commands in your terminal.

1. **PHP** (8.3+) is required for the application. Check if PHP is installed by running:

   ```bash
   php --version
   ```

2. **Composer** is necessary for managing PHP dependencies. Verify its installation with:

   ```bash
   composer --version
   ```

3. **Node** and **NPM** are needed for managing frontend dependencies. Check their installations with:

   ```bash
   node --version
   npm --version
   ```

### Installation

1. Duplicate the example environment file and configure it with your settings:

   ```bash
   cp .env.example .env
   ```

2. Install PHP and JavaScript dependencies:

   ```bash
   composer install
   npm install
   ```

3. Generate a new PHP application key:

   ```bash
   php artisan key:generate
   ```

4. Create the SQLite database file:

   ```bash
   touch database/database.sqlite
   ```

5. Apply database migrations. The site settings and projects are created by the migrations themselves; adding `--seed` also creates a local admin account (`admin@test.com` / `password`), which the seeder skips in production:

   ```bash
   php artisan migrate --seed
   ```

6. Link the public storage folder so uploaded screenshots can be served:

   ```bash
   php artisan storage:link
   ```

7. Start the development environment:

   ```bash
   composer dev
   ```

   Alternatively, run the backend and frontend separately:

   ```bash
   php artisan serve
   npm run dev
   ```

The admin panel lives at `/admin` and you sign in at `/login`, which isn't linked anywhere on the public site. Registration and password reset are disabled. To add an admin, run the command below and answer the prompts, or pass `--name`, `--email` and `--password`:

```bash
php artisan app:create-admin
```

## Deployment

The app runs on Laravel Cloud with a PostgreSQL database. Use `composer install --no-dev && npm run build:ssr` as the build command and `php artisan migrate --force` as the deploy command; the first migrate also creates the site settings and projects, so a fresh environment has content right away. Cloud's filesystem is reset on every deploy, so uploaded screenshots can't live on local storage: attach a public object storage bucket to the environment and set `MEDIA_DISK` to its disk name. Locally, screenshots stay on the `public` disk. A fresh production database has no admins; create yours from the environment's Commands tab with `php artisan app:create-admin --name="Riley Edward" --email=you@example.com --password="..."`.

## Testing

Run the Pest test suite along with Pint formatting and PHPStan checks:

```bash
composer test
```

Run every CI check, including linting, formatting, type checks and the accent contrast check:

```bash
composer ci:check
```
