@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Dashboard</h1>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card primary h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                    Total Pendaftar</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $totalPendaftar }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card warning h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                    Menunggu Verifikasi</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $pendingCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card success h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                    Diterima</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $diterimaCounts }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card stat-card danger h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs fw-bold text-danger text-uppercase mb-1">
                                    Ditolak</div>
                                <div class="h5 mb-0 fw-bold text-gray-800">{{ $ditolakCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-times-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold">Pendaftar Terbaru</h6>
                        <a href="{{ route('admin.calon-siswa.index') }}" class="btn btn-sm btn-primary">
                            Lihat Semua
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>NISN</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $latestPendaftar = App\Models\CalonSiswa::latest('created_at')->take(5)->get();
                                    @endphp

                                    @if($latestPendaftar->count() > 0)
                                        @foreach($latestPendaftar as $siswa)
                                            <tr>
                                                <td>{{ $siswa->nama }}</td>
                                                <td>{{ $siswa->nisn }}</td>
                                                <td>{{ $siswa->tanggal_daftar }}</td>
                                                <td>
                                                    @if($siswa->status == 'pending')
                                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                                    @elseif($siswa->status == 'diterima')
                                                        <span class="badge bg-success">Diterima</span>
                                                    @elseif($siswa->status == 'ditolak')
                                                        <span class="badge bg-danger">Ditolak</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.calon-siswa.show', $siswa->id_siswa) }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada pendaftar</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-5">
                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Informasi Sistem</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="small text-gray-500">PPDB Tahun Ajaran</div>
                            <div class="fw-bold">2024/2025</div>
                        </div>
                        <div class="mb-3">
                            <div class="small text-gray-500">Login Terakhir</div>
                            <div class="fw-bold">{{ now()->format('d M Y, H:i') }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="small text-gray-500">Status Sistem</div>
                            <div class="fw-bold text-success">Aktif</div>
                        </div>
                        <div class="mb-0">
                            <div class="small text-gray-500">Versi Aplikasi</div>
                            <div class="fw-bold">1.0.0</div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Aksi Cepat</h6>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.export.excel') }}" class="btn btn-success btn-block mb-2">
                            <i class="fas fa-file-excel me-2"></i>Export Excel
                        </a>
                        <a href="{{ route('admin.export.pdf') }}" class="btn btn-danger btn-block">
                            <i class="fas fa-file-pdf me-2"></i>Export PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection