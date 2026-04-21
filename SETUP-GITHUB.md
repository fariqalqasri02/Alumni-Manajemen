# Panduan Setelah Clone dari GitHub

Panduan ini untuk orang yang baru menarik project `portal-alumni` dari GitHub ke komputer lokal.

## 1. Clone repository

```powershell
git clone <URL-REPOSITORY>
cd "portal-alumni"
```

## 2. Install dependency

```powershell
composer install
npm install
```

## 3. Buat file environment

Windows PowerShell:

```powershell
copy .env.example .env
```

Lalu generate application key:

```powershell
php artisan key:generate
```

## 4. Siapkan database MySQL

Pastikan MySQL atau MariaDB sudah aktif, misalnya dari XAMPP.

Buat database baru. Nama database boleh berbeda, tetapi contoh paling mudah adalah `portal_alumni`:

```sql
CREATE DATABASE portal_alumni CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

## 5. Atur koneksi database di `.env`

Sesuaikan bagian ini agar sama dengan database yang Anda buat:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portal_alumni
DB_USERNAME=root
DB_PASSWORD=
```

## 6. Jalankan migration dan seeder

```powershell
php artisan migrate:fresh --seed
```

Perintah ini akan:
- membuat semua tabel
- mengisi data demo awal

## 7. Jalankan aplikasinya

Start Apache dan MySQL dulu jika memakai XAMPP.

Terminal 1:

```powershell
php artisan serve
```

Terminal 2:

```powershell
npm run dev
```

## 8. Buka aplikasi

- Laravel app: [http://127.0.0.1:8000](http://127.0.0.1:8000)
- phpMyAdmin: [http://localhost/phpmyadmin](http://localhost/phpmyadmin)

## Akun demo

- Admin: `admin@alumni.test` / `password`
- User: `user@alumni.test` / `password`

## Kalau ada error

Jalankan:

```powershell
php artisan config:clear
php artisan cache:clear
php artisan migrate
```

Lalu pastikan:
- Apache aktif
- MySQL aktif
- database `portal_alumni` sudah dibuat
- konfigurasi `.env` sudah benar
