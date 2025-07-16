<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    /**
     * Menampilkan halaman login admin
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Proses login admin
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'username' => ['Username atau password salah'],
            ]);
        }

        Auth::guard('admin')->login($admin);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Menampilkan dashboard admin
     */
    public function dashboard()
    {
        $totalPendaftar = CalonSiswa::count();
        $pendingCount = CalonSiswa::where('status', 'pending')->count();
        $diterimaCounts = CalonSiswa::where('status', 'diterima')->count();
        $ditolakCount = CalonSiswa::where('status', 'ditolak')->count();

        return view('admin.dashboard', compact('totalPendaftar', 'pendingCount', 'diterimaCounts', 'ditolakCount'));
    }

    /**
     * Menampilkan daftar calon siswa
     */
    public function calonSiswaIndex(Request $request)
    {
        $query = CalonSiswa::query();

        // Filter berdasarkan status jika ada
        if ($request->has('status') && $request->status != 'semua') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan pencarian jika ada
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        $calonSiswas = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.calon-siswa.index', compact('calonSiswas'));
    }

    /**
     * Menampilkan detail calon siswa
     */
    public function calonSiswaShow($id)
    {
        $calonSiswa = CalonSiswa::findOrFail($id);
        return view('admin.calon-siswa.show', compact('calonSiswa'));
    }

    /**
     * Memperbarui status calon siswa
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diterima,ditolak',
        ]);

        $calonSiswa = CalonSiswa::findOrFail($id);
        $calonSiswa->status = $request->status;
        $calonSiswa->id_admin = Auth::guard('admin')->id();
        $calonSiswa->save();

        return redirect()->route('admin.calon-siswa.show', $id)
            ->with('success', 'Status pendaftaran berhasil diperbarui');
    }

    /**
     * Export data calon siswa ke Excel
     */
    public function exportExcel(Request $request)
    {
        // Kode export Excel akan ditambahkan nanti
        return redirect()->back()->with('info', 'Fitur export Excel akan segera tersedia');
    }

    /**
     * Export data calon siswa ke PDF
     */
    public function exportPDF(Request $request)
    {
        // Kode export PDF akan ditambahkan nanti
        return redirect()->back()->with('info', 'Fitur export PDF akan segera tersedia');
    }

    /**
     * Logout admin
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}