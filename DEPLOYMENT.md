# CSE Project Builder & Viva Prep — Deployment Guide

This guide covers deploying the Laravel application to **free-tier** hosting and making it work on the internet.

---

## Prerequisites

- **Git** and **GitHub** account
- **PHP 8.2+**, **Composer**, **Node.js 18+**, **npm**
- **MySQL** or **PostgreSQL** (or use SQLite for minimal setup)
- For free hosting: **Railway**, **Render**, or **Vercel** (frontend only) + **PlanetScale** / **Railway DB** for database

---

## Step 1: Prepare the application

### 1.1 Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env`:

- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://your-domain.com` (update after deployment)
- Set database credentials for your chosen provider (see below).

### 1.2 Database

**Option A — SQLite (simplest for free tier):**

```env
DB_CONNECTION=sqlite
# Comment out DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
```

```bash
touch database/database.sqlite
php artisan migrate --force
php artisan db:seed --force
```

**Option B — MySQL (e.g. PlanetScale, Railway, Render):**

Create a database on your provider, then:

```env
DB_CONNECTION=mysql
DB_HOST=your-host
DB_PORT=3306
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-password
```

```bash
php artisan migrate --force
php artisan db:seed --force
```

### 1.3 Build frontend

```bash
npm ci --legacy-peer-deps
npm run build
```

### 1.4 File storage (deliverables)

- Default: files are stored under `storage/app/private`. Ensure the deployment platform has persistent disk or use a volume.
- For **Cloudinary** (optional): install `cloudinary-labs/cloudinary-laravel`, set env vars, and change the deliverable upload in Filament to use Cloudinary.

### 1.5 Admin user

After first deploy, create an admin user (if not seeded):

```bash
php artisan tinker
>>> \App\Models\User::where('email','admin@example.com')->update(['is_admin' => true]);
```

Or register a new user and set `is_admin = 1` in the database.

---

## Step 2: Deploy to Railway (recommended free tier)

1. **Sign up**: [railway.app](https://railway.app) (GitHub login).

2. **New project** → **Deploy from GitHub repo** → select this repo.

3. **Variables** (in Railway dashboard):

   - `APP_KEY` — from `php artisan key:generate --show` (or leave empty and run once via one-off command).
   - `APP_ENV=production`
   - `APP_DEBUG=false`
   - `APP_URL=https://your-app.up.railway.app` (Railway will give you a URL).
   - Database: add **MySQL** or **PostgreSQL** plugin in Railway, then use the generated `DATABASE_URL` or set `DB_*` vars.

4. **Build command:**

   ```bash
   composer install --no-dev --optimize-autoloader && npm ci --legacy-peer-deps && npm run build
   ```

5. **Start command:**

   ```bash
   php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && php artisan serve --host=0.0.0.0 --port=$PORT
   ```

6. **Root directory:** leave default (repo root).

7. Deploy; Railway will assign a URL. Set `APP_URL` to that URL.

8. **Optional:** Custom domain in Railway → Settings → Domains.

---

## Step 3: Deploy to Render (alternative)

1. **Sign up**: [render.com](https://render.com).

2. **New → Web Service** → connect GitHub repo.

3. **Environment:** PHP (or Docker; see below).

4. **Build:**

   ```bash
   composer install --no-dev --optimize-autoloader && npm ci --legacy-peer-deps && npm run build
   ```

5. **Start:**

   ```bash
   php artisan migrate --force && php artisan config:cache && php artisan serve --host=0.0.0.0 --port=$PORT
   ```

6. Add **Environment Variables** in Render (same as Railway: `APP_KEY`, `APP_URL`, `DB_*`, etc.).

7. Add **PostgreSQL** or **MySQL** from Render dashboard and link with `DATABASE_URL` or `DB_*`.

---

## Step 4: CI/CD (auto-deploy on push)

- **Railway / Render:** Both auto-deploy on push to the connected branch (e.g. `main`).
- **GitHub Actions (optional):** Add a workflow that runs `composer install`, `npm ci`, `npm run build`, and optionally runs tests; deployment itself is still done by Railway/Render.

Example minimal `.github/workflows/deploy.yml`:

```yaml
name: Deploy
on:
  push:
    branches: [main]
jobs:
  build:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4
      - uses: php-actions/composer@v6
        with:
          command: install --no-dev --optimize-autoloader
      - run: npm ci --legacy-peer-deps && npm run build
```

---

## Step 5: Security checklist

- [ ] `APP_DEBUG=false` in production
- [ ] Strong `APP_KEY` (never commit `.env`)
- [ ] HTTPS only (`APP_URL` with `https://`; enforce HTTPS in your host)
- [ ] Database credentials only in env (no commits)
- [ ] Filament admin at `/admin` — only admins can access (via `User::canAccessPanel()`)
- [ ] Student routes under `auth` middleware; order download checks `user_id` and `order_id`

---

## Step 6: Verify on the internet

1. Open `APP_URL` in a browser.
2. **Homepage:** FloatingLines hero, “Get Started”, “Browse Templates”.
3. **Register** a student account → **Dashboard** → **Order a custom project** → submit form → **My Orders** → order appears.
4. **Admin:** Log in as a user with `is_admin = true` → go to `/admin` → Filament dashboard → **Orders**, **Project Templates**; edit an order, set status, add deliverables (ZIP), add viva questions.
5. As student: open **My Orders** → open the delivered order → **Downloads** and **Viva preparation** sections work.
6. **Templates:** `/templates` lists templates; “Use this template” pre-fills the order form.

---

## Summary

| Step | Action |
|------|--------|
| 1 | Configure `.env`, run migrations and seed, build assets |
| 2 | Deploy to Railway (or Render) with build/start commands and env vars |
| 3 | Add database (Railway/Render plugin or external MySQL/Postgres) |
| 4 | Rely on auto-deploy on push (or add GitHub Actions for build/tests) |
| 5 | Harden security (no debug, HTTPS, env-only secrets) |
| 6 | Test homepage, auth, orders, admin, deliverables, viva content |

After this, the site is **secure**, **fast** (cached config/routes/views), and **user-friendly** with the described flows.
