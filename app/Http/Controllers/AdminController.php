<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade\Pdf;

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
        $status = $request->status ?? null;
        $search = $request->search ?? null;

        $export = new \App\Exports\CalonSiswaExport($status, $search);
        return $export->export();
    }

    /**
     * Export data calon siswa ke PDF
     */
    public function exportPDF(Request $request)
    {
        $status = $request->status ?? null;
        $search = $request->search ?? null;

        $query = CalonSiswa::query();

        // Filter berdasarkan status jika ada
        if ($status && $status != 'semua') {
            $query->where('status', $status);
        }

        // Filter berdasarkan pencarian jika ada
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        $calonSiswas = $query->orderBy('created_at', 'desc')->get();

        $pdf = Pdf::loadView('exports.calon-siswa-pdf', compact('calonSiswas', 'status', 'search'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('data_calon_siswa_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    /**
     * Menghapus data calon siswa
     */
    public function deleteCalonSiswa($id)
    {
        $calonSiswa = CalonSiswa::findOrFail($id);

        // Hapus file dokumen jika ada
        if ($calonSiswa->dokumen_kk) {
            Storage::delete('public/dokumen/' . $calonSiswa->dokumen_kk);
        }

        if ($calonSiswa->dokumen_rapor) {
            Storage::delete('public/dokumen/' . $calonSiswa->dokumen_rapor);
        }

        $calonSiswa->delete();

        return redirect()->route('admin.calon-siswa.index')
            ->with('success', 'Data calon siswa berhasil dihapus');
    }

    /**
     * Menghapus banyak data calon siswa sekaligus
     */
    public function bulkDeleteCalonSiswa(Request $request)
    {
        $request->validate([
            'selected_ids' => 'required|array',
            'selected_ids.*' => 'exists:calon_siswas,id_siswa',
        ]);

        $count = 0;

        foreach ($request->selected_ids as $id) {
            $calonSiswa = CalonSiswa::find($id);

            if ($calonSiswa) {
                // Hapus file dokumen jika ada
                if ($calonSiswa->dokumen_kk) {
                    Storage::delete('public/dokumen/' . $calonSiswa->dokumen_kk);
                }

                if ($calonSiswa->dokumen_rapor) {
                    Storage::delete('public/dokumen/' . $calonSiswa->dokumen_rapor);
                }

                $calonSiswa->delete();
                $count++;
            }
        }

        return redirect()->route('admin.calon-siswa.index')
            ->with('success', $count . ' data calon siswa berhasil dihapus');
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