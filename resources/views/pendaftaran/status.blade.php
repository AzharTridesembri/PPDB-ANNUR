@extends('layouts.app')

@section('title', 'Status Pendaftaran')

@section('styles')
    <style>
        :root {
            --primary-color: #157e3a;
            --primary-dark: #0e5b29;
            --secondary-color: #ffd700;
            --secondary-dark: #e6c200;
            --gray-light: #f8f9fa;
            --dark-color: #343a40;
        }

        .status-container {
            margin: 60px 0;
        }

        .status-card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 30px;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 1.5rem;
            border: none;
        }

        .card-header h4 {
            font-weight: 600;
            margin-bottom: 0;
        }

        .card-header i {
            color: var(--secondary-color);
            margin-right: 10px;
        }

        .card-body {
            padding: 2rem;
        }

        .status-icon {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 3rem;
        }

        .status-pending {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--secondary-dark) 100%);
            color: var(--dark-color);
        }

        .status-diterima {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
        }

        .status-ditolak {
            background: linear-gradient(135deg, #dc3545 0%, #c71f37 100%);
            color: white;
        }

        .status-badge {
            padding: 15px 25px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .status-badge-pending {
            background-color: rgba(255, 215, 0, 0.1);
            color: var(--secondary-dark);
            border: 2px solid var(--secondary-color);
        }

        .status-badge-diterima {
            background-color: rgba(21, 126, 58, 0.1);
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .status-badge-ditolak {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 2px solid #dc3545;
        }

        .data-table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .data-table th {
            background-color: var(--gray-light);
            font-weight: 600;
            padding: 15px;
            width: 30%;
        }

        .data-table td {
            padding: 15px;
        }

        .data-table tr {
            transition: all 0.3s ease;
        }

        .data-table tr:hover {
            background-color: rgba(21, 126, 58, 0.03);
        }

        .btn-cetak {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
            box-shadow: 0 5px 15px rgba(21, 126, 58, 0.3);
            transition: all 0.3s ease;
        }

        .btn-cetak:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(21, 126, 58, 0.5);
        }

        .info-card {
            border-radius: 15px;
            border: none;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .info-card-header {
            border: none;
            padding: 1.25rem 1.5rem;
            background: var(--secondary-color) !important;
            color: var(--dark-color) !important;
        }

        .back-link {
            display: inline-block;
            margin-top: 1.5rem;
            color: var(--primary-color);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .back-link:hover {
            color: var(--primary-dark);
            transform: translateX(-5px);
        }

        .back-link i {
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }

        .back-link:hover i {
            transform: translateX(-3px);
        }
    </style>
@endsection

@section('content')
    <div class="container status-container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="status-card">
                    <div class="card-header">
                        <h4><i class="fas fa-clipboard-check me-2"></i>Status Pendaftaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            @if($calonSiswa->status == 'pending')
                                <div class="status-icon status-pending">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="status-badge status-badge-pending">
                                    Menunggu Verifikasi
                                </div>
                                <h3 class="mb-3">Pendaftaran Sedang Diproses</h3>
                                <p class="lead mb-5">Pendaftaran Anda sedang dalam proses verifikasi oleh admin. Silahkan
                                    periksa status secara berkala.</p>
                            @elseif($calonSiswa->status == 'diterima')
                                <div class="status-icon status-diterima">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="status-badge status-badge-diterima">
                                    Diterima
                                </div>
                                <h3 class="mb-3">Selamat! Anda Diterima</h3>
                                <p class="lead mb-5">Pendaftaran Anda telah diverifikasi dan diterima. Silahkan melakukan daftar
                                    ulang sesuai jadwal yang ditentukan.</p>
                            @elseif($calonSiswa->status == 'ditolak')
                                <div class="status-icon status-ditolak">
                                    <i class="fas fa-times"></i>
                                </div>
                                <div class="status-badge status-badge-ditolak">
                                    Ditolak
                                </div>
                                <h3 class="mb-3">Maaf, Pendaftaran Ditolak</h3>
                                <p class="lead mb-5">Pendaftaran Anda tidak memenuhi kriteria yang diperlukan. Silahkan hubungi
                                    pihak sekolah untuk informasi lebih lanjut.</p>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="mb-3 fw-bold"><i class="fas fa-user-graduate me-2"></i>Data Pendaftaran</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered data-table">
                                        <tr>
                                            <th>Nomor Pendaftaran</th>
                                            <td class="fw-bold">{{ $calonSiswa->id_siswa }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Lengkap</th>
                                            <td>{{ $calonSiswa->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>NISN</th>
                                            <td>{{ $calonSiswa->nisn }}</td>
                                        </tr>
                                        <tr>
                                            <th>Asal Sekolah</th>
                                            <td>{{ $calonSiswa->asal_sekolah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pilihan Jurusan</th>
                                            <td>{{ $calonSiswa->pilihan_jurusan }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Pendaftaran</th>
                                            <td>{{ $calonSiswa->tanggal_daftar->format('d F Y') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if($calonSiswa->status == 'pending')
                                                    <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                                                @elseif($calonSiswa->status == 'diterima')
                                                    <span class="badge bg-success">Diterima</span>
                                                @elseif($calonSiswa->status == 'ditolak')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="mt-4 text-center">
                                    <a href="{{ route('pendaftaran.cetak', $calonSiswa->id_siswa) }}" class="btn btn-cetak"
                                        target="_blank">
                                        <i class="fas fa-print me-2"></i>Cetak Bukti Pendaftaran
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card info-card">
                    <div class="card-header bg-info text-white info-card-header">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi Tambahan</h5>
                    </div>
                    <div class="card-body">
                        @if($calonSiswa->status == 'pending')
                            <div class="d-flex">
                                <div class="me-3 text-warning">
                                    <i class="fas fa-exclamation-circle fa-2x"></i>
                                </div>
                                <div>
                                    <p>Pendaftaran Anda sedang dalam proses verifikasi. Proses verifikasi membutuhkan waktu 1-3
                                        hari kerja. Silakan cek status pendaftaran secara berkala.</p>
                                </div>
                            </div>
                        @elseif($calonSiswa->status == 'diterima')
                            <div class="d-flex">
                                <div class="me-3 text-success">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                                <div>
                                    <p>Selamat! Anda telah diterima sebagai calon siswa SMK ANNUR. Silakan lakukan daftar ulang
                                        pada tanggal 11 - 15 Agustus 2024 dengan membawa:</p>
                                    <ul>
                                        <li>Bukti pendaftaran</li>
                                        <li>Fotokopi Kartu Keluarga</li>
                                        <li>Fotokopi Rapor</li>
                                        <li>Pas foto 3x4 (4 lembar)</li>
                                    </ul>
                                </div>
                            </div>
                        @elseif($calonSiswa->status == 'ditolak')
                            <div class="d-flex">
                                <div class="me-3 text-danger">
                                    <i class="fas fa-times-circle fa-2x"></i>
                                </div>
                                <div>
                                    <p>Mohon maaf, pendaftaran Anda ditolak. Untuk informasi lebih lanjut, silakan hubungi
                                        bagian pendaftaran di (021) 1234567 atau email ke info@smkannur.sch.id.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('pendaftaran.cek-status-form') }}" class="back-link">
                        <i class="fas fa-arrow-left"></i>Kembali ke Halaman Cek Status
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection