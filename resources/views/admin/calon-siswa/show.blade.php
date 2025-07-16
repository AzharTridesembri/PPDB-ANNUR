@extends('layouts.admin')

@section('title', 'Detail Calon Siswa')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Detail Calon Siswa</h1>
            <a href="{{ route('admin.calon-siswa.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Data Diri</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Nama Lengkap</div>
                            <div class="col-md-8">{{ $calonSiswa->nama }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">NISN</div>
                            <div class="col-md-8">{{ $calonSiswa->nisn }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Tempat, Tanggal Lahir</div>
                            <div class="col-md-8">{{ $calonSiswa->tempat_lahir }},
                                {{ $calonSiswa->tanggal_lahir->format('d F Y') }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Alamat</div>
                            <div class="col-md-8">{{ $calonSiswa->alamat }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Asal Sekolah</div>
                            <div class="col-md-8">{{ $calonSiswa->asal_sekolah }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Pilihan Jurusan</div>
                            <div class="col-md-8">{{ $calonSiswa->pilihan_jurusan }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Email</div>
                            <div class="col-md-8">{{ $calonSiswa->email }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">No. HP</div>
                            <div class="col-md-8">{{ $calonSiswa->no_hp }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Tanggal Pendaftaran</div>
                            <div class="col-md-8">{{ $calonSiswa->tanggal_daftar->format('d F Y') }}</div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Dokumen</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="mb-2 fw-bold">Kartu Keluarga</div>
                                <a href="{{ asset('storage/dokumen/' . $calonSiswa->dokumen_kk) }}" class="btn btn-primary"
                                    target="_blank">
                                    <i class="fas fa-file me-1"></i>Lihat Dokumen
                                </a>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-2 fw-bold">Rapor</div>
                                <a href="{{ asset('storage/dokumen/' . $calonSiswa->dokumen_rapor) }}"
                                    class="btn btn-primary" target="_blank">
                                    <i class="fas fa-file me-1"></i>Lihat Dokumen
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Status Pendaftaran</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            @if($calonSiswa->status == 'pending')
                                <div class="bg-warning text-dark p-3 rounded fw-bold mb-3">Menunggu Verifikasi</div>
                            @elseif($calonSiswa->status == 'diterima')
                                <div class="bg-success text-white p-3 rounded fw-bold mb-3">Diterima</div>
                            @elseif($calonSiswa->status == 'ditolak')
                                <div class="bg-danger text-white p-3 rounded fw-bold mb-3">Ditolak</div>
                            @endif
                        </div>

                        <form action="{{ route('admin.calon-siswa.update-status', $calonSiswa->id_siswa) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="status" class="form-label">Ubah Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="pending" {{ $calonSiswa->status == 'pending' ? 'selected' : '' }}>Menunggu
                                        Verifikasi</option>
                                    <option value="diterima" {{ $calonSiswa->status == 'diterima' ? 'selected' : '' }}>
                                        Diterima</option>
                                    <option value="ditolak" {{ $calonSiswa->status == 'ditolak' ? 'selected' : '' }}>Ditolak
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-1"></i>Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold">Aksi</h6>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('pendaftaran.cetak', $calonSiswa->id_siswa) }}" class="btn btn-success w-100 mb-2"
                            target="_blank">
                            <i class="fas fa-print me-1"></i>Cetak Bukti Pendaftaran
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection