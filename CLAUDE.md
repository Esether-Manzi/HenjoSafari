# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project overview

HenjoSafari is a two-app monorepo for a safari tour operator's website:

- **`henjo-backend/`** — Laravel 13 REST API + a Filament 5 admin panel (content management for safaris, destinations, bookings, blog, etc.)
- **`henjo-frontend/henjosafaris-frontend/`** — Next.js 16 (App Router) public-facing website that consumes the API

They are deployed and run independently; there is no shared build tooling between them. The backend's Blade/Vite setup (`resources/views/welcome.blade.php`, `vite.config.js`) is unused boilerplate — `routes/web.php` only serves the default Laravel welcome view. All real frontend work happens in the Next.js app.

The frontend has its own `henjo-frontend/henjosafaris-frontend/CLAUDE.md` (which imports `AGENTS.md`) — Claude Code loads that automatically when working inside that directory, in addition to this file.

## Commands

### Backend (`henjo-backend/`)

```bash
composer install                        # install PHP deps
cp .env.example .env && php artisan key:generate   # first-time setup
php artisan migrate                     # run migrations (sqlite by default; local .env currently uses mysql)
php artisan db:seed                     # run DatabaseSeeder (safaris, destinations, blog, etc.)
composer dev                            # runs serve + queue:listen + pail (logs) + vite concurrently
php artisan serve                       # API only, http://127.0.0.1:8000
```

Testing (PHPUnit, in-memory sqlite via `phpunit.xml`):

```bash
composer test                           # clears config cache, runs full suite
php artisan test                        # equivalent, no config clear
php artisan test --filter=ActivityTest  # single test class
php artisan test tests/Unit/ActivityTest.php   # single test file
```

Code style: `vendor/bin/pint` (Laravel Pint) is a dev dependency; no explicit script is wired up, run it directly.

### Frontend (`henjo-frontend/henjosafaris-frontend/`)

```bash
npm run dev      # Next.js dev server, http://localhost:3000
npm run build
npm run start
npm run lint      # eslint (flat config: eslint-config-next core-web-vitals + typescript)
```

There is currently no configured test runner for the frontend (`tests/` directory exists but is empty).

## Architecture

### Backend: Laravel API + Filament admin, same app

Both live in one Laravel app (`henjo-backend`):

- **Public JSON API** — `routes/api.php`, all under `/api/v1/...`, handled by controllers in `app/Http/Controllers/Api/`. Read-only GET endpoints for safaris, destinations, posts, team members, activities; POST endpoints for inquiries and bookings. Every response is shaped `{ success: bool, data, message?, errors? }`. List endpoints (`SafariPackageController::index`) support query-string filtering (`search`, `category`, `destination`, `activity`, `country`) and are paginated (12/page) via Eloquent's paginator, so `data` is a Laravel pagination object, not a bare array.
- **Admin panel** — Filament 5, mounted at `/admin` (`app/Providers/Filament/AdminDashboardPanelProvider.php`). Resources/Pages/Widgets are auto-discovered from `app/Filament/{Resources,Pages,Widgets}` — adding a new file in the right location and naming convention is enough to register it, no manual wiring needed. Each entity resource follows the same subfolder shape: `<Entity>Resource.php` plus `Pages/`, `Schemas/<Entity>Form.php` + `<Entity>Infolist.php`, `Tables/<Entity>Table.php`.
- **Models** (`app/Models/`) commonly combine several traits: `SoftDeletes`, `Cviebrock\EloquentSluggable\Sluggable` (slug generated from `title`/`name` via a `sluggable()` method), and Spatie Media Library's `HasMedia`/`InteractsWithMedia` for image uploads (media collections like `cover` (single file) and `gallery` are registered per-model in `registerMediaCollections()`). Image URLs are exposed to the API via an appended accessor (e.g. `SafariPackage::getCoverImageUrlAttribute()`), which falls back through Spatie media → a conventional `public/images/<entity>/<slug>.<ext>` file → a default placeholder.
- **Pivot relationships** use explicit table/column names rather than Laravel's naming defaults (e.g. `SafariPackage::categories()` uses pivot table `package_category` with `package_id`/`category_id`) — when adding new many-to-many relations, follow the existing explicit style rather than relying on convention-based inference.
- Auth: Sanctum is installed for the API guard; Spatie `laravel-permission` is installed for roles/permissions (used by the Filament admin).
- CORS (`config/cors.php`) is currently locked to `http://localhost:3000` / `127.0.0.1:3000` for `api/*` and `sanctum/csrf-cookie` — add the production frontend origin here before deploying.

### Frontend: Next.js App Router talking to the API through one client

- Routes live under `app/<route>/page.tsx` (e.g. `app/safaris/[slug]/page.tsx`, `app/blog/[slug]/page.tsx`, `app/booking/page.tsx`). Components are grouped by feature under `components/<feature>/` (`components/safari/`, `components/destination/`, `components/blog/`, `components/common/`).
- All HTTP calls go through the singleton `apiClient` in `lib/api/client.ts` (axios wrapper, base URL from `NEXT_PUBLIC_API_URL`, adds a bearer token from `localStorage` if present, unwraps the backend's `{success, data}` envelope). Feature-specific request functions live in `lib/api/<feature>Api.ts` (`safariApi.ts`, `blogApi.ts`, `bookingApi.ts`, `contactApi.ts`, `teamApi.ts`) and wrap `apiClient.get/post/...` — add new endpoints there rather than calling `apiClient` directly from components.
- Types in `types/*.ts` (`safari.ts`, `blog.ts`, `team.ts`, `api.ts`) mirror the backend's Eloquent model shapes (including the `media` array and pagination envelope) — keep them in sync when backend fields change.
- No global state library or React context is currently in use — `store/` and `context/` exist but are empty; data is fetched per-page/per-component through the `lib/api` layer.
- Styling is Tailwind CSS v4 for layout/utility classes, combined with a custom CSS-variable theme defined in `app/globals.css` (`--brand-gold`, `--brand-green`, `--brand-maroon`, `--bg-*`, `--text-*`, etc., with light/dark values) applied via inline `style={{ ... }}` for brand-colored elements — follow this pattern (Tailwind for layout, CSS vars via inline style for brand colors) rather than hardcoding hex values or adding Tailwind color utilities for brand colors.
- Interactive/client components are explicitly marked `'use client'`; forms use `react-hook-form` + `zod` resolvers (`@hookform/resolvers`).

## Current state / in progress

Recent history: schema/admin dashboard were rebuilt from scratch (`Backup before admin dashboard refactor` → `Adding the first Filament resourse` → `Admin dashboard with all navigation groups` → destinations/blog content), with the working tree now mid-way through a booking flow feature (uncommitted): `BookingController`, `NewBookingNotification` mail + Blade view, a migration making `bookings.package_id` nullable (bookings not tied to a specific package are apparently allowed), `DestinationSeeder`/`HenjoContentSeeder`, and the frontend `app/booking/` pages + `bookingApi.ts`/`contactApi.ts`. `HENJOSAFARIS_LIVE_CONTENT.md` at the repo root holds real copy/content pulled from the live site for seeding.

Backend test coverage is minimal (default `ExampleTest`s plus one `ActivityTest`); treat the test suite as not yet a reliable safety net.

## Conventions to follow

- Backend: standard Laravel/PSR-4 structure (`App\` → `app/`). New API endpoints go in `app/Http/Controllers/Api/`, registered under the `v1` prefix group in `routes/api.php`, and return the `{success, data, message?, errors?}` envelope. Note there are legacy non-`Api` controllers (`app/Http/Controllers/DestinationController.php`, `DestinationsController.php`) that aren't wired into `routes/web.php` or `routes/api.php` — don't assume they're live code paths without checking.
- Frontend: TypeScript throughout, `@/` path alias for imports, default-exported PascalCase components, prop types named `<Component>Props`.
