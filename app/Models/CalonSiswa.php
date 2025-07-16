<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonSiswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_siswa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'asal_sekolah',
        'pilihan_jurusan',
        'email',
        'no_hp',
        'dokumen_kk',
        'dokumen_rapor',
        'status',
        'tanggal_daftar',
        'id_admin',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'tanggal_daftar' => 'date',
        ];
    }

    /**
     * Relasi dengan Admin
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin');
    }
}