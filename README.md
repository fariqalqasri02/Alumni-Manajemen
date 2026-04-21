# Sistem Manajemen Alumni

Project ini dibuat dengan PHP 8.2 dan Laravel 12 untuk memenuhi requirement portal alumni dan pusat karier kampus.

## Fitur

- Registrasi dan login user/admin
- Manajemen profil mahasiswa/alumni
- Informasi lowongan kerja dan pencarian/filter
- Informasi kegiatan karier dan pendaftaran online
- Tracer study alumni
- Dashboard user dan admin
- Kelola lowongan, kegiatan, tracer study, dan hak akses
- Laporan sistem
- Export PDF dan Excel
- Tampilan responsif desktop, tablet, dan mobile

## Stack

- Laravel 12
- Blade + Tailwind CSS
- SQLite untuk test bawaan
- MySQL sebagai konfigurasi default aplikasi
- DomPDF untuk export PDF

## Menjalankan Project

1. Salin environment:

Linux/macOS:

```bash
cp .env.example .env
```

Windows PowerShell:

```powershell
copy .env.example .env
```

2. Sesuaikan koneksi MySQL di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portal_alumni
DB_USERNAME=root
DB_PASSWORD=
```

3. Install dependency:

```bash
composer install
npm install
```

4. Generate key dan migrasi:

```bash
php artisan key:generate
php artisan migrate:fresh --seed
```

5. Jalankan aplikasi:

```bash
php artisan serve
npm run dev
```

## Setup MySQL Cepat di Windows XAMPP

Jika MariaDB/MySQL XAMPP belum aktif, Anda bisa memakai script:

```powershell
powershell -ExecutionPolicy Bypass -File .\scripts\setup-mysql.ps1
php artisan migrate:fresh --seed
```

## Akun Demo

- Admin: `admin@alumni.test` / `password`
- User: `user@alumni.test` / `password`

## Panduan Tambahan

- [ERD](./docs/ERD.md)
- [Use Case](./docs/USE-CASE.md)
- [Panduan MySQL](./docs/SETUP-MYSQL.md)
- [Panduan Setelah Clone GitHub](./SETUP-GITHUB.md)
- [Skema SQL MySQL](./database/mysql_schema.sql)

## Verifikasi

Perintah yang sudah lolos saat implementasi:

```bash
php artisan migrate:fresh --seed
php artisan route:list
php artisan test
```
