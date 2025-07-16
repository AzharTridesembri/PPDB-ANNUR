# Petunjuk Menjalankan Seeder Calon Siswa

Seeder ini akan membuat 500 data dummy calon siswa untuk aplikasi PPDB SMK ANNUR.

## Cara Menjalankan Seeder

### Metode 1: Menggunakan Command Artisan Khusus

```bash
php artisan seed:calon-siswa
```

Command ini akan menjalankan seeder khusus untuk membuat 500 data calon siswa.

### Metode 2: Menggunakan Database Seeder

```bash
php artisan db:seed --class=CalonSiswaSeeder
```

Command ini akan menjalankan seeder calon siswa saja.

### Metode 3: Menjalankan Semua Seeder

```bash
php artisan db:seed
```

Command ini akan menjalankan semua seeder yang terdaftar di DatabaseSeeder, termasuk CalonSiswaSeeder.

## Informasi Data Dummy

Data dummy yang dibuat memiliki karakteristik sebagai berikut:

1. **NISN**: Format 10 digit yang unik
2. **Status Pendaftaran**:
    - 50% Menunggu (pending)
    - 30% Diterima (diterima)
    - 20% Ditolak (ditolak)
3. **Asal Sekolah**: Berbagai SMP dan MTs, termasuk MTs AN NUR
4. **Jurusan**: Semua jurusan yang tersedia di SMK
5. **Tanggal Pendaftaran**: Dalam rentang 3 bulan terakhir

## Catatan Penting

-   Seeder ini hanya membuat data dummy untuk keperluan pengujian
-   File dokumen yang direferensikan (KK dan Rapor) tidak benar-benar ada di sistem penyimpanan
-   Jika ingin menghapus semua data calon siswa sebelum menjalankan seeder, jalankan:

```bash
php artisan migrate:fresh --seed
```

**PERHATIAN**: Command di atas akan menghapus SEMUA data di database dan menjalankan migrasi ulang!
