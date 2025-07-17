<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

-   **[Vehikl](https://vehikl.com)**
-   **[Tighten Co.](https://tighten.co)**
-   **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
-   **[64 Robots](https://64robots.com)**
-   **[Curotec](https://www.curotec.com/services/technologies/laravel)**
-   **[DevSquad](https://devsquad.com/hire-laravel-developers)**
-   **[Redberry](https://redberry.international/laravel-development)**
-   **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Sistem PPDB SMK ANNUR

Sistem Penerimaan Peserta Didik Baru untuk SMK ANNUR.

## Persyaratan Sistem

-   PHP >= 8.2
-   Composer
-   MySQL atau database lainnya yang didukung Laravel
-   Web Server (Apache/Nginx)

## Instalasi

1. Clone repository ini:

```
git clone [URL_REPOSITORY_GITHUB_ANDA]
cd PPDB
```

2. Install semua dependencies:

```
composer install
```

3. Install package untuk ekspor data:

```
composer require phpoffice/phpspreadsheet --ignore-platform-reqs
composer require barryvdh/laravel-dompdf
```

4. Copy file .env.example menjadi .env:

```
cp .env.example .env
```

5. Generate application key:

```
php artisan key:generate
```

Pastikan juga untuk mengatur konfigurasi aplikasi lainnya di file .env:

```
APP_NAME="PPDB SMK ANNUR"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
```

6. Konfigurasi database di file .env:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ppdb_smk_annur
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan nilai-nilai di atas dengan konfigurasi database Anda:

-   `DB_CONNECTION`: Jenis database yang digunakan (mysql, pgsql, sqlite, dll)
-   `DB_HOST`: Host database (biasanya localhost atau 127.0.0.1)
-   `DB_PORT`: Port database (default MySQL: 3306)
-   `DB_DATABASE`: Nama database yang akan digunakan
-   `DB_USERNAME`: Username untuk akses database
-   `DB_PASSWORD`: Password untuk akses database

Jika aplikasi menggunakan fitur email, konfigurasikan juga pengaturan SMTP:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

Untuk penyimpanan file, pastikan konfigurasi storage sudah benar:

```
FILESYSTEM_DISK=public
```

7. Jalankan migrasi database:

```
php artisan migrate
```

8. Buat symbolic link untuk storage:

```
php artisan storage:link
```

9. Jalankan seeder untuk membuat data awal (opsional):

```
php artisan db:seed
```

Atau jalankan seeder tertentu:

```
php artisan db:seed --class=AdminSeeder       # Untuk membuat akun admin
php artisan db:seed --class=CalonSiswaSeeder  # Untuk membuat data contoh calon siswa
```

10. Jalankan server development:

```
php artisan serve
```

## Fitur

-   Pendaftaran calon siswa baru
-   Manajemen data calon siswa
-   Dashboard admin
-   Ekspor data ke Excel dan PDF
-   Cetak bukti pendaftaran

## Akses Admin

Username: admin
Password: admin123

## Catatan Pengembangan

Jika mengalami masalah dengan ekstensi GD saat menggunakan PhpSpreadsheet, gunakan flag `--ignore-platform-reqs` saat menginstal package tersebut.
