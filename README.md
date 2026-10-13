# VivaCraft

**Student-built projects, prepared for the viva.** VivaCraft is a project-service platform concept that connects clients with student developers and pairs project delivery with clear learning materials and viva preparation.

## What it includes

- Project request and order workflows
- Student-facing project delivery and learning materials
- Viva questions and explanations to help clients understand their work
- Admin tools built with Filament
- A responsive web interface built with Laravel, Inertia.js, and Vue

The exact services and enabled workflows depend on the current application configuration.

## Technology

- PHP 8.2+ and Laravel
- Vue 3 and Inertia.js
- Filament admin panel
- Vite and Tailwind CSS
- MySQL or another Laravel-supported database
- Docker configuration for containerized development/deployment

## Requirements

- PHP 8.2 or later with the extensions required by Laravel
- Composer
- Node.js and npm
- A configured database

## Local setup

From the repository root:

```bash
composer install
npm install
```

Create a local environment file:

```bash
cp .env.example .env
php artisan key:generate
```

On Windows PowerShell, use:

```powershell
Copy-Item .env.example .env
php artisan key:generate
```

Set the database connection in `.env`, then run the migrations and available seeders:

```bash
php artisan migrate --seed
```

Build frontend assets and start the development services:

```bash
npm run build
composer run dev
```

The development script starts Laravel, the queue listener, logs, and Vite. Open the local URL printed by Laravel in the terminal. For a single frontend process, use `npm run dev` in a separate terminal.

## Tests

```bash
php artisan test
```

## Deployment

See [DEPLOYMENT.md](DEPLOYMENT.md) for the current deployment notes. Review all environment variables, database settings, mail/queue configuration, and administrator access before deploying a public instance. Never commit `.env` or production credentials.

## Repository guide

- `app/` — application logic and Filament resources
- `resources/` — Vue pages, components, and templates
- `routes/` — HTTP routes
- `database/` — migrations, factories, and seeders
- `docs/` — supporting project documentation

## License

See the repository's `LICENSE` file, if present.