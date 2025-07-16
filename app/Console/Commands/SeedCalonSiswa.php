<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\CalonSiswaSeeder;

class SeedCalonSiswa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seed:calon-siswa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengisi database dengan 500 data calon siswa dummy';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mulai mengisi database dengan data calon siswa...');

        // Jalankan seeder
        $seeder = new CalonSiswaSeeder();
        $seeder->run();

        $this->info('Data calon siswa berhasil ditambahkan!');

        return Command::SUCCESS;
    }
}