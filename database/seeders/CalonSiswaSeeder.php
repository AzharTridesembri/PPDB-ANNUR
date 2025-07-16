<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CalonSiswa;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalonSiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $jurusan = [
            'Teknik Komputer dan Jaringan',
            'Rekayasa Perangkat Lunak',
            'Multimedia',
            'Teknik Elektronika Industri',
            'Teknik Kendaraan Ringan',
            'Teknik Sepeda Motor',
            'Akuntansi',
            'Administrasi Perkantoran',
            'Pemasaran'
        ];

        $asalSekolah = [
            'SMP Negeri 1 Bandung',
            'SMP Negeri 2 Bandung',
            'SMP Negeri 3 Bandung',
            'SMP Negeri 4 Bandung',
            'SMP Negeri 5 Bandung',
            'SMP Islam Al-Azhar',
            'SMP Islam Al-Falah',
            'SMP Islam Terpadu Nurul Fikri',
            'SMP Katolik Santo Aloysius',
            'SMP Kristen Kalam Kudus',
            'MTs Negeri 1 Bandung',
            'MTs Negeri 2 Bandung',
            'MTs Salafiyah',
            'MTs Al-Hidayah',
            'MTs Nurul Huda',
            'SMP Muhammadiyah 1',
            'SMP Muhammadiyah 2',
            'SMP Muhammadiyah 3',
            'SMP NU 1',
            'SMP NU 2',
            'MTs AN NUR'
        ];

        $kota = ['Bandung', 'Cimahi', 'Garut', 'Tasikmalaya', 'Cianjur', 'Sumedang', 'Majalengka'];

        // Generate 500 data calon siswa
        echo "Membuat 500 data calon siswa...\n";

        for ($i = 0; $i < 500; $i++) {
            // Buat NISN unik dengan format yang benar (10 digit)
            $nisn = '00' . $faker->unique()->numerify('########');

            // Tentukan status berdasarkan persentase yang lebih realistis
            // 50% pending, 30% diterima, 20% ditolak
            $statusRandom = $faker->randomFloat(2, 0, 1);
            if ($statusRandom < 0.5) {
                $status = 'pending';
            } elseif ($statusRandom < 0.8) {
                $status = 'diterima';
            } else {
                $status = 'ditolak';
            }

            $namaFileKK = time() . '_kk_' . $nisn . '.pdf';
            $namaFileRapor = time() . '_rapor_' . $nisn . '.pdf';
            $tanggalDaftar = $faker->dateTimeBetween('-3 months', 'now')->format('Y-m-d');

            CalonSiswa::create([
                'nama' => $faker->name,
                'nisn' => $nisn,
                'tempat_lahir' => $faker->randomElement($kota),
                'tanggal_lahir' => $faker->dateTimeBetween('-18 years', '-14 years')->format('Y-m-d'),
                'alamat' => $faker->address,
                'asal_sekolah' => $faker->randomElement($asalSekolah),
                'pilihan_jurusan' => $faker->randomElement($jurusan),
                'email' => $faker->unique()->safeEmail,
                'no_hp' => $faker->numerify('08##########'),
                'dokumen_kk' => $namaFileKK,
                'dokumen_rapor' => $namaFileRapor,
                'status' => $status,
                'tanggal_daftar' => $tanggalDaftar,
                'created_at' => Carbon::parse($tanggalDaftar),
                'updated_at' => Carbon::parse($tanggalDaftar),
            ]);

            // Tampilkan progress setiap 50 data
            if (($i + 1) % 50 === 0) {
                echo "Membuat data ke-" . ($i + 1) . " dari 500\n";
            }
        }

        echo "500 data calon siswa berhasil dibuat!\n";
    }
}