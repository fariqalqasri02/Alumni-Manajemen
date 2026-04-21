# Panduan Setup MySQL

## 1. Buat database

```sql
CREATE DATABASE portal_alumni CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

## 2. Atur `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portal_alumni
DB_USERNAME=root
DB_PASSWORD=
```

## 3. Jalankan migrasi dan seed

```bash
php artisan migrate:fresh --seed
```

## 4. Jika ingin import manual

Gunakan file berikut:

- [database/mysql_schema.sql](../database/mysql_schema.sql)

## Catatan

- Testing Laravel tetap bisa menggunakan SQLite in-memory.
- Untuk deployment, gunakan MySQL 8+ atau MariaDB yang kompatibel.
