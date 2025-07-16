@extends('layouts.app')

@section('title', 'Formulir Pendaftaran')

@section('styles')
    <style>
        :root {
            --primary-color: #157e3a;
            --primary-dark: #0e5b29;
            --secondary-color: #ffd700;
            --secondary-dark: #e6c200;
        }

        .form-container {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 1.5rem;
            position: relative;
        }

        .form-header h4 {
            font-weight: 700;
            margin-bottom: 0;
        }

        .form-body {
            padding: 2rem;
        }

        .section-title {
            position: relative;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--primary-dark));
            border-radius: 2px;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 0.7rem 1rem;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(21, 126, 58, 0.15);
            border-color: var(--primary-color);
        }

        .file-upload {
            position: relative;
            overflow: hidden;
            border: 2px dashed #e0e0e0;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-upload:hover {
            border-color: var(--primary-color);
        }

        .file-upload input {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
            width: 100%;
            height: 100%;
        }

        .file-upload i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            display: block;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-daftar {
            padding: 12px 40px;
            font-weight: 600;
            border-radius: 50px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
            box-shadow: 0 5px 15px rgba(21, 126, 58, 0.3);
            transition: all 0.3s ease;
        }

        .btn-daftar:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(21, 126, 58, 0.5);
        }

        .alert-info {
            border-radius: 10px;
            border: none;
            background-color: rgba(21, 126, 58, 0.1);
            border-left: 4px solid var(--primary-color);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .required-mark {
            color: #dc3545;
            font-weight: bold;
        }

        .input-group-text {
            border-radius: 10px 0 0 10px;
            background-color: #f8f9fa;
        }

        .input-group-text i {
            color: var(--primary-color);
        }

        .input-group .form-control {
            border-radius: 0 10px 10px 0;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card form-container mb-5">
                    <div class="form-header">
                        <h4><i class="fas fa-user-plus me-2"></i>Formulir Pendaftaran Peserta Didik Baru</h4>
                    </div>
                    <div class="form-body">
                        <div class="alert alert-info mb-4">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="fas fa-info-circle fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="alert-heading">Petunjuk Pengisian</h5>
                                    <p class="mb-0">Isi formulir berikut dengan lengkap dan benar. Pastikan semua data yang
                                        dimasukkan adalah data yang valid. Field dengan tanda <span
                                            class="required-mark">*</span> wajib diisi.</p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <h5 class="section-title">Data Diri</h5>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap <span
                                            class="required-mark">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                            id="nama" name="nama" value="{{ old('nama') }}"
                                            placeholder="Masukkan nama lengkap" required>
                                    </div>
                                    @error('nama')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nisn" class="form-label">NISN <span class="required-mark">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        <input type="text" class="form-control @error('nisn') is-invalid @enderror"
                                            id="nisn" name="nisn" value="{{ old('nisn') }}" placeholder="Masukkan NISN"
                                            required>
                                    </div>
                                    @error('nisn')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir <span
                                            class="required-mark">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                            placeholder="Masukkan tempat lahir" required>
                                    </div>
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span
                                            class="required-mark">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}"
                                            required>
                                    </div>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="alamat" class="form-label">Alamat Lengkap <span
                                        class="required-mark">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                        name="alamat" rows="3" placeholder="Masukkan alamat lengkap"
                                        required>{{ old('alamat') }}</textarea>
                                </div>
                                @error('alamat')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <h5 class="section-title mt-5">Data Pendidikan</h5>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="asal_sekolah" class="form-label">Asal Sekolah <span
                                            class="required-mark">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-school"></i></span>
                                        <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror"
                                            id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah') }}"
                                            placeholder="Masukkan asal sekolah" required>
                                    </div>
                                    @error('asal_sekolah')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pilihan_jurusan" class="form-label">Pilihan Jurusan <span
                                            class="required-mark">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                        <select class="form-select @error('pilihan_jurusan') is-invalid @enderror"
                                            id="pilihan_jurusan" name="pilihan_jurusan" required>
                                            <option value="" selected disabled>-- Pilih Jurusan --</option>
                                            <option value="Pengembangan Perangkat Lunak dan Gim" {{ old('pilihan_jurusan') == 'Pengembangan Perangkat Lunak dan Gim' ? 'selected' : '' }}>Pengembangan Perangkat Lunak dan Gim (PPLG)</option>
                                            <option value="Pemasaran" {{ old('pilihan_jurusan') == 'Pemasaran' ? 'selected' : '' }}>Pemasaran (PM)</option>
                                        </select>
                                    </div>
                                    @error('pilihan_jurusan')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h5 class="section-title mt-5">Kontak</h5>
                            <div class="row mb-4">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="required-mark">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email"
                                            required>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="no_hp" class="form-label">Nomor HP <span
                                            class="required-mark">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                            id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                            placeholder="Masukkan nomor HP" required>
                                    </div>
                                    @error('no_hp')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <h5 class="section-title mt-5">Dokumen</h5>
                            <div class="row mb-5">
                                <div class="col-md-6 mb-3">
                                    <label for="dokumen_kk" class="form-label">Kartu Keluarga (PDF/JPG/PNG) <span
                                            class="required-mark">*</span></label>
                                    <div class="file-upload">
                                        <i class="fas fa-upload"></i>
                                        <span id="file-kk-text">Klik atau seret file ke sini</span>
                                        <input type="file" class="form-control @error('dokumen_kk') is-invalid @enderror"
                                            id="dokumen_kk" name="dokumen_kk" accept=".pdf,.jpg,.jpeg,.png" required>
                                    </div>
                                    <small class="text-muted mt-2 d-block">Format: PDF, JPG, PNG (Maks. 2MB)</small>
                                    @error('dokumen_kk')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="dokumen_rapor" class="form-label">Rapor (PDF/JPG/PNG) <span
                                            class="required-mark">*</span></label>
                                    <div class="file-upload">
                                        <i class="fas fa-upload"></i>
                                        <span id="file-rapor-text">Klik atau seret file ke sini</span>
                                        <input type="file" class="form-control @error('dokumen_rapor') is-invalid @enderror"
                                            id="dokumen_rapor" name="dokumen_rapor" accept=".pdf,.jpg,.jpeg,.png" required>
                                    </div>
                                    <small class="text-muted mt-2 d-block">Format: PDF, JPG, PNG (Maks. 2MB)</small>
                                    @error('dokumen_rapor')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-5 text-center">
                                <div class="form-check d-inline-block mb-4">
                                    <input class="form-check-input" type="checkbox" id="konfirmasi" required>
                                    <label class="form-check-label" for="konfirmasi">
                                        Saya menyatakan bahwa data yang saya isi adalah benar dan saya bertanggung jawab
                                        atas kebenaran data tersebut.
                                    </label>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-daftar">
                                        <i class="fas fa-paper-plane me-2"></i>Daftar Sekarang
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Update file upload text when file is selected
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('dokumen_kk').addEventListener('change', function (e) {
                var fileName = e.target.files[0].name;
                document.getElementById('file-kk-text').textContent = fileName;
            });

            document.getElementById('dokumen_rapor').addEventListener('change', function (e) {
                var fileName = e.target.files[0].name;
                document.getElementById('file-rapor-text').textContent = fileName;
            });
        });
    </script>
@endsection