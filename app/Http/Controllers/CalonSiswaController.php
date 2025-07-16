<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CalonSiswaController extends Controller
{
    /**
     * Menampilkan halaman beranda
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Menampilkan formulir pendaftaran
     */
    public function create()
    {
        return view('pendaftaran.create');
    }

    /**
     * Menyimpan data pendaftaran baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nisn' => 'required|string|max:20|unique:calon_siswas,nisn',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'asal_sekolah' => 'required|string|max:255',
            'pilihan_jurusan' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:calon_siswas,email',
            'no_hp' => 'required|string|max:15',
            'dokumen_kk' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'dokumen_rapor' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Upload dokumen KK
        $dokumenKK = $request->file('dokumen_kk');
        $namaFileKK = time() . '_kk_' . $request->nisn . '.' . $dokumenKK->extension();
        $dokumenKK->storeAs('public/dokumen', $namaFileKK);

        // Upload dokumen rapor
        $dokumenRapor = $request->file('dokumen_rapor');
        $namaFileRapor = time() . '_rapor_' . $request->nisn . '.' . $dokumenRapor->extension();
        $dokumenRapor->storeAs('public/dokumen', $namaFileRapor);

        // Simpan data calon siswa
        $calonSiswa = CalonSiswa::create([
            'nama' => $request->nama,
            'nisn' => $request->nisn,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'asal_sekolah' => $request->asal_sekolah,
            'pilihan_jurusan' => $request->pilihan_jurusan,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'dokumen_kk' => $namaFileKK,
            'dokumen_rapor' => $namaFileRapor,
            'status' => 'pending',
            'tanggal_daftar' => Carbon::now()->toDateString(),
        ]);

        return redirect()->route('pendaftaran.success', $calonSiswa->id_siswa);
    }

    /**
     * Menampilkan halaman sukses pendaftaran
     */
    public function success($id)
    {
        $calonSiswa = CalonSiswa::findOrFail($id);
        return view('pendaftaran.success', compact('calonSiswa'));
    }

    /**
     * Menampilkan halaman cek status pendaftaran
     */
    public function cekStatusForm()
    {
        return view('pendaftaran.cek-status');
    }

    /**
     * Proses cek status pendaftaran
     */
    public function cekStatus(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string',
            'email' => 'required|email',
        ]);

        $calonSiswa = CalonSiswa::where('nisn', $request->nisn)
            ->where('email', $request->email)
            ->first();

        if (!$calonSiswa) {
            return back()->withErrors(['message' => 'Data pendaftaran tidak ditemukan']);
        }

        return view('pendaftaran.status', compact('calonSiswa'));
    }

    /**
     * Cetak bukti pendaftaran
     */
    public function cetakBukti($id)
    {
        $calonSiswa = CalonSiswa::findOrFail($id);
        return view('pendaftaran.cetak', compact('calonSiswa'));
    }
}