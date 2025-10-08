This repository is a Laravel (PHP) web application for a gym registration system. The goal of this guidance is to give AI coding agents immediate, actionable context so they can make safe, useful changes.

- Runtime / framework
  - Laravel 10+ conventions. PHP files live in `app/`, views in `resources/views/`, routes in `routes/`.
  - Sessions default to `database` (see `config/session.php` and `.env.example`). A `sessions` table migration exists in `database/migrations/0001_01_01_000000_create_users_table.php`.

- Big-picture architecture
  - MVC: Controllers in `app/Http/Controllers`, models in `app/Models`, views in `resources/views`.
  - Route grouping uses `routes/web.php` with route-level middleware for role-based access (`role` middleware alias in `app/Http/Kernel.php`).
  - Global middleware `SetLocale` (in `app/Http/Middleware/SetLocale.php`) runs in the `web` middleware group and reads `session('locale')` to call `app()->setLocale(...)`.

- Language / locale switching (common bug source)
  - Switching is implemented by a POST route `route('lang.switch.post')` in `routes/web.php` which stores the chosen locale in session. There's also a GET fallback `route('lang.switch.get')`.
  - The middleware `SetLocale` must be registered in the `web` middleware group (it's already present in `app/Http/Kernel.php`). If locale changes seem to not persist, check:
    - Session driver: `SESSION_DRIVER` in `.env` (example uses `database`). If `database` is used, ensure migrations have been run and `sessions` table exists.
    - CSRF: The language form uses POST and must include the `@csrf` token (UI already includes it).
    - JS behavior: views submit the language form with `this.form.submit()`; if JavaScript is disabled use the GET fallback `/lang/{locale}`.

- Important files to inspect (examples)
  - `app/Http/Middleware/SetLocale.php` — reads session('locale') and sets app locale.
  - `routes/web.php` — POST `/lang` route and GET fallback `/lang/{locale}`; role-based route groups defined here.
  - `resources/views/components/navbar.blade.php` — language select form; ensure it includes `@csrf` and uses `this.form.submit()`.
  - `config/app.php` — default `locale` and `fallback_locale` (used when translations missing).
  - `config/session.php` — session driver and table settings.
  - `database/migrations/*` — check that `sessions` table creation migration exists and has been migrated in the environment.

- Project-specific conventions & patterns
  - Role-based middleware alias `role` is used for admin/trainer/member segmentation. Look for `app/Http/Middleware/RoleMiddleware.php` if editing behavior.
  - Session-backed features assume persistent sessions; prefer using `session([...])` for state and verify migrations when changing session driver.
  - Views use Blade templates with Tailwind for styling (see `resources/views` and `resources/css/app.css`).

- Developer workflows (how to build/run/test locally)
  - Local run (typical): ensure `.env` is configured, run composer install, run migrations, then start server:
    - composer install
    - cp .env.example .env (fill APP_KEY and DB config if needed)
    - php artisan key:generate
    - php artisan migrate
    - php artisan serve
  - Tests run via `php artisan test` or `vendor/bin/phpunit`. The repo's `phpunit.xml` sets `SESSION_DRIVER=array` for tests.

- Debugging checklist for "language switch doesn't work"
  1. Confirm the language form includes `@csrf` and submits to `route('lang.switch.post')` (or use `GET /lang/{locale}`). See `resources/views/components/navbar.blade.php`.
  2. Confirm `SetLocale` middleware is registered in `web` group (`app/Http/Kernel.php`).
  3. Confirm `SESSION_DRIVER` in `.env` matches your environment and that sessions table exists if using `database` driver (run `php artisan migrate`).
  4. Inspect cookies/SameSite settings if session not persisting between requests (see `config/session.php`).
  5. Ensure redirects use `redirect()->back()` (routes/web.php uses this). If switching from an external URL, the referer may not be set — try redirecting to `route('homepage')` when debugging.

- Safety & style
  - Preserve existing route names and middleware aliases when modifying behavior. Tests (if present) expect session driver to be `array` in CI; do not hardcode environment-specific values.

- When making changes, reference these exact filenames in PR descriptions so maintainers can quickly review: `routes/web.php`, `app/Http/Middleware/SetLocale.php`, `app/Http/Kernel.php`, `resources/views/components/navbar.blade.php`, `config/session.php`.

If any of the above points are unclear or you want the README to include an explicit quickstart for running locally on Windows (PowerShell), say so and I will expand this file accordingly.
