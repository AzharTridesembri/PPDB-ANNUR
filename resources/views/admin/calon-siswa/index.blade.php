@extends('layouts.admin')

@section('title', 'Daftar Calon Siswa')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2">Daftar Calon Siswa</h1>
        <p class="mb-4">Daftar semua calon siswa yang telah mendaftar</p>

        <div class="card mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold">Filter & Pencarian</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.calon-siswa.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi
                            </option>
                            <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="search" class="form-label">Cari</label>
                        <input type="text" class="form-control" id="search" name="search"
                            placeholder="Cari berdasarkan nama, NISN, email, atau no. HP" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold">Hasil Pencarian</h6>
                <div>
                    <a href="{{ route('admin.export.excel') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-file-excel me-1"></i>Export Excel
                    </a>
                    <a href="{{ route('admin.export.pdf') }}" class="btn btn-sm btn-danger">
                        <i class="fas fa-file-pdf me-1"></i>Export PDF
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>NISN</th>
                                <th>Asal Sekolah</th>
                                <th>Jurusan</th>
                                <th>Tanggal Daftar</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($calonSiswas->count() > 0)
                                @foreach($calonSiswas as $index => $siswa)
                                    <tr>
                                        <td>{{ $calonSiswas->firstItem() + $index }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $siswa->nisn }}</td>
                                        <td>{{ $siswa->asal_sekolah }}</td>
                                        <td>{{ $siswa->pilihan_jurusan }}</td>
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
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $calonSiswas->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection