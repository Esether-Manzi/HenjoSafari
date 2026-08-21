# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project overview

HenjoSafari is a two-app monorepo for a safari tour operator's website:

- **`henjo-backend/`** — Laravel 13 REST API + a Filament 5 admin panel. Manages both the tour catalog (safaris, destinations, bookings, blog, etc.) and the site's own content — global settings, navigation menus, and CMS-style pages — so most of the public site's copy, branding, and nav structure is admin-editable rather than hardcoded in the frontend.
- **`henjo-frontend/henjosafaris-frontend/`** — Next.js 16 (App Router) public-facing website that consumes the API

They are deployed and run independently; there is no shared build tooling between them. The backend's Blade/Vite setup (`resources/views/welcome.blade.php`, `vite.config.js`) is unused boilerplate — `routes/web.php` only serves the default Laravel welcome view. All real frontend work happens in the Next.js app.

The frontend has its own `henjo-frontend/henjosafaris-frontend/CLAUDE.md` (which imports `AGENTS.md`) — Claude Code loads that automatically when working inside that directory, in addition to this file.

## Commands

### Backend (`henjo-backend/`)

```bash
composer install                        # install PHP deps
cp .env.example .env && php artisan key:generate   # first-time setup
php artisan migrate                     # run migrations (sqlite by default; local .env currently uses mysql)
php artisan storage:link                # required — Spatie media (safari/destination/page images, the homepage hero video) is served from storage/app/public via this symlink
php artisan db:seed                     # run DatabaseSeeder (safaris, destinations, blog, site settings/pages, etc.)
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

- **Public JSON API** — `routes/api.php`, all under `/api/v1/...`, handled by controllers in `app/Http/Controllers/Api/`. Read-only GET endpoints for safaris, destinations, posts, team members, activities, plus the site-content endpoints below; POST endpoints for inquiries and bookings. Every response is shaped `{ success: bool, data, message?, errors? }`. List endpoints (`SafariPackageController::index`) support query-string filtering (`search`, `category`, `destination`, `activity`, `country`) and are paginated (`per_page`, default 12) via Eloquent's paginator, so `data` is a Laravel pagination object, not a bare array.
- **Site content endpoints** — `GET /settings` (`SiteSetting::current()`, a singleton row — site name/logo/tagline, contact info, social links, homepage stat counters, plus computed `safari_package_count`/`country_count`), `GET /menus/{location}` (top-level `Menu` rows for a location like `navbar`/`footer`, each with an eager-loaded `children` tree, filtered to `is_active`), `GET /pages/{slug}` (a single CMS `Page` — title, hero fields, freeform `content`, a JSON `sections` array). These back the frontend's global nav/footer/branding and a handful of content pages — see the Frontend section below.
- **Admin panel** — Filament 5, mounted at `/admin` (`app/Providers/Filament/AdminDashboardPanelProvider.php`). Resources/Pages/Widgets are auto-discovered from `app/Filament/{Resources,Pages,Widgets}` — adding a new file in the right location and naming convention is enough to register it, no manual wiring needed. Each entity resource follows the same subfolder shape: `<Entity>Resource.php` plus `Pages/`, `Schemas/<Entity>Form.php` + `<Entity>Infolist.php`, `Tables/<Entity>Table.php`. Beyond the catalog/booking resources there's a `Menus` and `Pages` resource (the CMS layer above) and a standalone `SettingsPage` (`app/Filament/Pages/SettingsPage.php`, a Livewire form bound to the `SiteSetting` singleton, not a Resource). The main `Dashboard` page (`app/Filament/Pages/Dashboard.php`) overrides `getWidgets()` with an explicit list (welcome banner, grouped stats, quick actions, bookings trend, recent bookings) rather than auto-discovering every widget — the heavier analytics widgets (booking/revenue trends, status charts, package performance, customer geography, CSV export via `Widgets/Concerns/ExportsCsv.php`) live on the separate `ReportsPage` instead, so a new report-only widget should be added to `ReportsPage::getFooterWidgets()`, not left to auto-discovery.
- **Models** (`app/Models/`) commonly combine several traits: `SoftDeletes`, `Cviebrock\EloquentSluggable\Sluggable` (slug generated from `title`/`name` via a `sluggable()` method), and Spatie Media Library's `HasMedia`/`InteractsWithMedia` for image uploads (media collections like `cover` (single file) and `gallery` are registered per-model in `registerMediaCollections()`). Image URLs are exposed to the API via an appended accessor (e.g. `SafariPackage::getCoverImageUrlAttribute()`), which falls back through Spatie media → a conventional `public/images/<entity>/<slug>.<ext>` file → a default placeholder. `SiteSetting` and `Page` follow the same media-accessor pattern (`logo_url`/`homepage_hero_url`, `hero_image_url`/`featured_image_url`) but without a filesystem fallback — they resolve to `null` if no media is attached, so frontend code consuming them needs its own fallback.
- **Pivot relationships** use explicit table/column names rather than Laravel's naming defaults (e.g. `SafariPackage::categories()` uses pivot table `package_category` with `package_id`/`category_id`) — when adding new many-to-many relations, follow the existing explicit style rather than relying on convention-based inference.
- Auth: Sanctum is installed for the API guard; Spatie `laravel-permission` is installed for roles/permissions (used by the Filament admin).
- CORS (`config/cors.php`) is currently locked to `http://localhost:3000` / `127.0.0.1:3000` for `api/*` and `sanctum/csrf-cookie` — add the production frontend origin here before deploying.

### Frontend: Next.js App Router talking to the API through one client

- Routes live under `app/<route>/page.tsx` (e.g. `app/safaris/[slug]/page.tsx`, `app/blog/[slug]/page.tsx`, `app/booking/page.tsx`). Components are grouped by feature under `components/<feature>/` (`components/safari/`, `components/destination/`, `components/blog/`, `components/common/`).
- All HTTP calls go through the singleton `apiClient` in `lib/api/client.ts` (axios wrapper, base URL from `NEXT_PUBLIC_API_URL`, adds a bearer token from `localStorage` if present, unwraps the backend's `{success, data}` envelope). Feature-specific request functions live in `lib/api/<feature>Api.ts` (`safariApi.ts`, `blogApi.ts`, `bookingApi.ts`, `contactApi.ts`, `teamApi.ts`, `menuApi.ts`, `pagesApi.ts`, `settingsApi.ts`, `destinationApi.ts`) and wrap `apiClient.get/post/...` — add new endpoints there rather than calling `apiClient` directly from components.
- Types in `types/*.ts` (`safari.ts`, `blog.ts`, `team.ts`, `api.ts`, `menu.ts`, `page.ts`, `settings.ts`) mirror the backend's Eloquent model shapes (including the `media` array and pagination envelope) — keep them in sync when backend fields change.
- **Global layout is server-rendered and content-driven**: `app/layout.tsx`'s `RootLayout` is an `async` Server Component that fetches `/settings`, `/menus/navbar`, and `/menus/footer` in parallel on every request and passes the results down as props — `<Navbar menuItems={navbarMenu} siteName={...} logoUrl={...} />` and `<Footer settings={settings} quickLinks={footerMenu} />`. Neither component hardcodes nav items, branding, or social links anymore; when adding a new top-level nav entry or changing the site name/logo, do it in the admin (`Menus` resource / `Settings` page), not in `Navbar.tsx`/`Footer.tsx`. A handful of content pages (e.g. `app/about/page.tsx`, split into a `page.tsx` server shell + `AboutClient.tsx`) similarly pull their copy from `pagesApi.getBySlug()` against the backend's `Page` CMS model rather than hardcoding text.
- No global state library or React context is currently in use — `store/` and `context/` exist but are empty; data is fetched per-page/per-component through the `lib/api` layer.
- Styling is Tailwind CSS v4 for layout/utility classes, combined with a custom CSS-variable theme defined in `app/globals.css` (`--brand-gold`, `--brand-green`, `--brand-maroon`, `--bg-*`, `--text-*`, etc., with light/dark values) applied via inline `style={{ ... }}` for brand-colored elements — follow this pattern (Tailwind for layout, CSS vars via inline style for brand colors) rather than hardcoding hex values or adding Tailwind color utilities for brand colors.
- Interactive/client components are explicitly marked `'use client'`; forms use `react-hook-form` + `zod` resolvers (`@hookform/resolvers`).

## Current state / in progress

Recent history: schema/admin dashboard were rebuilt from scratch, then a full booking flow shipped (`BookingController`, `NewBookingNotification` mail, a migration making `bookings.package_id` nullable so a booking isn't required to name a specific package, the admin `Bookings` resource/table showing customer + package names instead of raw IDs, and the frontend `app/booking/` page with country → package cascading selects plus a working "Book Now" modal on the safari detail page). The homepage was also redesigned (grouped feature sections, a looping background video, "2 featured packages per country" curation) and the admin `Dashboard` got a branded welcome banner, grouped stat cards, and a quick-actions widget.

Most recently (`Making the app purely dynamic and adding admin pages`): the site-content CMS layer described above (`SiteSetting`, `Menu`, `Page` models + their API endpoints + Filament resources/`SettingsPage`) was added, `app/layout.tsx` was switched to server-fetch settings/menus, and several previously-hardcoded frontend pages (`about`, `contact`, `destinations`, `booking-policy`, `travel-information`, `women-only-tours`) were rewired to pull their content from it; a `ReportsPage` with CSV-exportable analytics widgets was added alongside the existing `Dashboard`. Known loose end: the homepage hero's background video is still a hardcoded storage path in `app/page.tsx` (`HERO_VIDEO_URL`) rather than reading `SiteSetting::homepage_hero_url`, which now exists specifically for this — worth reconciling if the two drift.

`HENJOSAFARIS_LIVE_CONTENT.md` at the repo root holds real copy/content pulled from the live site, used to seed the above (see `PageContentSeeder`, `DestinationSeeder`).

Backend test coverage is still thin — `tests/Feature/` covers the admin `Dashboard` render path and the Filament icon picker, plus default `ExampleTest`s and one `Unit/ActivityTest`; treat the suite as a starting point, not a full safety net. Frontend has no test runner configured yet.

## Conventions to follow

- Backend: standard Laravel/PSR-4 structure (`App\` → `app/`). New API endpoints go in `app/Http/Controllers/Api/`, registered under the `v1` prefix group in `routes/api.php`, and return the `{success, data, message?, errors?}` envelope. Note there are legacy non-`Api` controllers (`app/Http/Controllers/DestinationController.php`, `DestinationsController.php`) that aren't wired into `routes/web.php` or `routes/api.php` — don't assume they're live code paths without checking.
- Frontend: TypeScript throughout, `@/` path alias for imports, default-exported PascalCase components, prop types named `<Component>Props`.
