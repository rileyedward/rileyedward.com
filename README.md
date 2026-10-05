# rileyedward.com

Freelance site for Riley Edward, a Kansas City Laravel developer: public pages, a project showcase driven by the database, and a contact form that feeds a private admin inbox.

Built on the official Laravel Vue starter kit: Laravel 13, Inertia 3 (with SSR), Vue 3, TypeScript, Tailwind v4, Fortify, Wayfinder and Pest.

## Local setup

Requirements: PHP 8.3+, Composer, Node 22+ (20 works), and [Herd](https://herd.laravel.com) (or `php artisan serve`).

```bash
composer setup                 # install, .env, key, migrate, npm install, build
php artisan db:seed            # projects + site settings
php artisan storage:link       # serve uploaded cover images
php artisan app:create-admin   # your admin login (prompts for name/email/password)
herd link rileyedward          # http://rileyedward.test
composer dev                   # Vite, queue and logs with hot reload
```

Local development uses SQLite (`database/database.sqlite`, `APP_URL=http://rileyedward.test`). CI and production run PostgreSQL; a commented `pgsql` block in `.env.example` shows the variables.

## Admin

Sign in at `/login` (not linked anywhere public). Registration and password reset are disabled; create users with `php artisan app:create-admin`.

- **Inbox** (`/admin/inbox`): contact form inquiries. Nothing is emailed; reply from your mail app.
- **Projects** (`/admin/projects`): drag to reorder, toggle Visible / Featured, edit copy in markdown, upload a cover screenshot (stored as WebP).
- **Site settings** (`/admin/site-settings`): availability line, public email, GitHub and LinkedIn URLs, career start year.

## Configuration

| Variable | Purpose |
| --- | --- |
| `MEDIA_DISK` | Filesystem disk for cover images. `public` locally; the Cloud object storage disk in production. |

Accent presets live in `resources/css/app.css` (`[data-accent]` blocks) and `app/Enums/Accent.php`.

## Checks

```bash
composer ci:check   # vp check (lint + format), accent contrast check, vue-tsc, Pint, PHPStan, Pest
```

GitHub Actions runs the same command against PostgreSQL on every push to `main` and `rebuild`.
