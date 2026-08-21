# Henjo African Safaris

Website for Henjo African Safaris — a safari tour operator based in Uganda offering
bespoke safaris, gorilla trekking, and tailor-made holidays across Uganda, Kenya,
Tanzania, and Rwanda.

The project is a two-app monorepo:

| App | Stack | Purpose |
|---|---|---|
| [`henjo-backend/`](henjo-backend) | Laravel 13 + Filament 5 | Public REST API and admin panel — the tour catalog (safaris, destinations, bookings, blog) plus the site's own content (settings, nav menus, CMS pages) |
| [`henjo-frontend/henjosafaris-frontend/`](henjo-frontend/henjosafaris-frontend) | Next.js 16 (App Router) | Public-facing marketing site that consumes the API |

The two apps are deployed and run independently — there is no shared build tooling
between them, and the frontend talks to the backend purely over HTTP.

## Getting Started

### Prerequisites

- PHP `^8.3` + Composer
- Node.js (for the frontend) + npm
- MySQL (or SQLite for a quick local setup)

### Backend (`henjo-backend/`)

```bash
cd henjo-backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan db:seed          # safaris, destinations, blog, etc.
composer dev                 # serve + queue:listen + pail (logs) + vite, concurrently
```

The API runs at `http://127.0.0.1:8000`, with the admin panel at `/admin`.

### Frontend (`henjo-frontend/henjosafaris-frontend/`)

```bash
cd henjo-frontend/henjosafaris-frontend
npm install
npm run dev
```

Create a `.env.local` with at least `NEXT_PUBLIC_API_URL` pointing at the backend's
`/api/v1` URL (e.g. `http://localhost:8000/api/v1`).

The site runs at `http://localhost:3000`.

## Architecture

### Backend: Laravel API + Filament admin, one app

- **Public JSON API** — `routes/api.php`, all under `/api/v1/...`. Every response is
  shaped `{ success, data, message?, errors? }`. List endpoints support query-string
  filtering (`search`, `category`, `destination`, `activity`, `country`) and are
  paginated.
- **Admin panel** — [Filament 5](https://filamentphp.com), mounted at `/admin`.
  Resources cover safari packages, destinations, categories, activities,
  accommodations, bookings, customers, payments, inquiries, blog posts, team
  members, nav menus, and CMS pages — plus a global Settings page (site name/logo,
  contact info, social links), a dashboard with grouped stats and quick actions,
  and a Reports page with CSV-exportable analytics.
- **Models** commonly combine `SoftDeletes`, sluggable slugs, and
  [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary) for image
  uploads.
- **Auth** — Sanctum for the API guard, `laravel-permission` for admin roles.

### Frontend: Next.js App Router

- Routes live under `app/<route>/page.tsx`; components are grouped by feature under
  `components/<feature>/`.
- All HTTP calls go through a singleton `apiClient` (`lib/api/client.ts`), with
  feature-specific request helpers in `lib/api/<feature>Api.ts`.
- The root layout is an async Server Component that fetches site settings and the
  navbar/footer menus from the backend on every request, so branding, navigation,
  and a number of content pages are admin-editable rather than hardcoded.
- Styling is Tailwind CSS v4 for layout, combined with a CSS-variable brand theme
  (`app/globals.css`) supporting light/dark mode.

See [`CLAUDE.md`](CLAUDE.md) for a more detailed breakdown of conventions,
in-progress work, and known rough edges — it's the working reference kept up to
date as the codebase evolves.

## Testing

```bash
# Backend (PHPUnit, in-memory SQLite)
cd henjo-backend
composer test            # or: php artisan test

# Frontend
cd henjo-frontend/henjosafaris-frontend
npm run lint
```

Frontend test coverage is not yet configured; backend coverage is minimal — treat
the test suite as a starting point rather than a full safety net.

## License

[MIT](LICENSE)
