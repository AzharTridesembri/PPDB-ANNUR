@extends('layouts.admin')

@section('title', 'Daftar Calon Siswa')

@section('styles')
    <style>
        .pagination {
            --bs-pagination-color: #157e3a;
            --bs-pagination-hover-color: #157e3a;
            --bs-pagination-focus-color: #157e3a;
            --bs-pagination-active-bg: #157e3a;
            --bs-pagination-active-border-color: #157e3a;
        }

        .page-item.active .page-link {
            background-color: #157e3a;
            border-color: #157e3a;
        }

        .page-link:hover {
            color: #157e3a;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #bb2d3b;
            border-color: #b02a37;
        }
    </style>
@endsection

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
                    <a href="{{ route('admin.export.excel', ['status' => request('status'), 'search' => request('search')]) }}" class="btn btn-sm btn-success">
                        <i class="fas fa-file-excel me-1"></i>Export Excel
                    </a>
                    <a href="{{ route('admin.export.pdf', ['status' => request('status'), 'search' => request('search')]) }}" class="btn btn-sm btn-danger">
                        <i class="fas fa-file-pdf me-1"></i>Export PDF
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form id="bulk-action-form" action="{{ route('admin.calon-siswa.bulk-delete') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="select-all">
                                    <label class="form-check-label" for="select-all">
                                        Pilih Semua
                                    </label>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-danger btn-sm" id="bulk-delete" disabled>
                                    <i class="fas fa-trash me-1"></i>Hapus Terpilih
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">Pilih</th>
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
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input select-item" type="checkbox"
                                                        name="selected_ids[]" value="{{ $siswa->id_siswa }}">
                                                </div>
                                            </td>
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
                                                <div class="d-flex">
                                                    <a href="{{ route('admin.calon-siswa.show', $siswa->id_siswa) }}"
                                                        class="btn btn-info btn-sm me-1">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <form action="{{ route('admin.calon-siswa.delete', $siswa->id_siswa) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="d-flex justify-content-center mt-4">
                    {{ $calonSiswas->appends(request()->query())->links() }}
                </div>
                <div class="text-center mt-2">
                    <p class="text-muted">
                        Menampilkan {{ $calonSiswas->firstItem() ?? 0 }} sampai {{ $calonSiswas->lastItem() ?? 0 }} dari
                        {{ $calonSiswas->total() }} data
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectAllCheckbox = document.getElementById('select-all');
            const selectItemCheckboxes = document.querySelectorAll('.select-item');
            const bulkDeleteButton = document.getElementById('bulk-delete');

            // Fungsi untuk memeriksa apakah ada checkbox yang dipilih
            function updateBulkDeleteButton() {
                const checkedItems = document.querySelectorAll('.select-item:checked');
                bulkDeleteButton.disabled = checkedItems.length === 0;
            }

            // Event listener untuk checkbox "Pilih Semua"
            selectAllCheckbox.addEventListener('change', function () {
                selectItemCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateBulkDeleteButton();
            });

            // Event listener untuk setiap checkbox item
            selectItemCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    // Periksa apakah semua checkbox dipilih
                    const allChecked = Array.from(selectItemCheckboxes).every(cb => cb.checked);
                    selectAllCheckbox.checked = allChecked;

                    // Periksa apakah ada checkbox yang dipilih untuk mengaktifkan tombol hapus
                    updateBulkDeleteButton();
                });
            });
        });
    </script>
@endsection