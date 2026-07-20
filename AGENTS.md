# PPDB — Penerimaan Peserta Didik Baru

Laravel 12 app for online student admission (SD-level). Three areas: **Public** (landing/CMS), **Admin** (backoffice), **Peserta** (student dashboard).

## Quick start

```bash
composer setup       # install, .env, key, migrate --force, npm build
composer dev         # concurrent: serve + queue:listen + pail logs + vite (npx concurrently)
composer test        # config:clear + artisan test (PHPUnit, in-memory SQLite)
```

## Role system (Spatie permissions)

5 roles (capitalized): `Super Admin`, `Admin`, `Operator`, `Verifikator`, `Peserta`.

Route middleware: `role:Super Admin|Admin` and `role:Peserta`. Permissions use dot notation (`dashboard.view`, `pendaftaran.verify`) — see `PermissionSeeder.php` for the full list.

`RoleAndPermissionSeeder.php` is **dead code** — only `PermissionSeeder` + `RoleSeeder` are called.

Seed accounts (password `password`):
- `superadmin@ppdb.test` — Super Admin
- `admin@ppdb.test`, `operator@ppdb.test`, `verifikator@ppdb.test`
- `peserta@ppdb.test`

Seed order: `php artisan db:seed` → PermissionSeeder → RoleSeeder → AdminUserSeeder → DummyDataSeeder (15 registrations in varied states).

## Routes

| Prefix | Middleware | Purpose |
|--------|-----------|---------|
| `/` (public.) | guest | Beranda, Berita, Galeri, Pengumuman, Kontak |
| `/admin` (admin.) | auth+verified+`role:Super Admin\|Admin` | Master data, pendaftaran, CMS, users |
| `/peserta` (peserta.) | auth+verified+`role:Peserta` | Biodata, dokumen, daftar ulang |
| auth | guest/auth | Breeze scaffold (register, login, password) |

Dashboard redirects based on role: Peserta → `/peserta/dashboard`, Admin → `/admin/dashboard`.

## Key conventions

- **SQLite** default. Session, queue, cache all use `database` driver. No Redis/MySQL in dev.
- `EnsureUserIsActive` is applied on every web request (both as alias `active` and in `$middleware->web(append:)` in `bootstrap/app.php`). Inactive users are logged out with an Indonesian error message.
- `.env` timezone is `Asia/Makassar` (config default `UTC`; .env wins if set).
- Models use Indonesian naming: `Peserta`, `Pendaftaran`, `PeriodePpdb`, `JalurPendaftaran`, etc.
- Registration flow: Biodata → OrangTua → SekolahAsal → PilihJalur → UploadDokumen → Submit → Verifikasi → Seleksi → DaftarUlang.
- `Pendaftaran` statuses: `draft`, `submitted`, `verifikasi`, `diterima`, `cadangan`, `ditolak`.

## Test

- PHPUnit 11, in-memory SQLite (`:memory:`), refresh per test.
- Default Breeze tests under `tests/Feature/Auth/` and `tests/Feature/ProfileTest.php`.
- `Tests\TestCase` has no custom overrides beyond the default.

## Code style

- 4-space indent, LF endings, UTF-8 (`.editorconfig`).
- No strict types declaration used.
- Route resource controllers for CRUD; separate GET/PUT methods for single-row CMS settings.
