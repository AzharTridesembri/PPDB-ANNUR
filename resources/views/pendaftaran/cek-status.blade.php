@extends('layouts.app')

@section('title', 'Cek Status Pendaftaran')

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

        .check-status-card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            border: none;
            margin: 60px 0;
            position: relative;
            background: #ffffff;
            transition: all 0.3s ease;
        }

        .check-status-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 1.5rem;
            border: none;
        }

        .card-header h4 {
            font-weight: 700;
            margin-bottom: 0;
            position: relative;
            display: inline-block;
        }

        .card-header i {
            color: var(--secondary-color);
            margin-right: 10px;
        }

        .card-body {
            padding: 3rem;
        }

        .search-icon {
            font-size: 4rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            display: inline-block;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .form-control {
            border-radius: 12px;
            padding: 0.8rem 1.2rem;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(21, 126, 58, 0.15);
            border-color: var(--primary-color);
        }

        .input-group-text {
            border-radius: 12px 0 0 12px;
            background-color: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-right: none;
            padding: 0 1rem;
        }

        .input-group-text i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .input-group .form-control {
            border-radius: 0 12px 12px 0;
        }

        .btn-check-status {
            width: 100%;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 16px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            box-shadow: 0 5px 15px rgba(21, 126, 58, 0.3);
            transition: all 0.3s ease;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            display: block;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .btn-check-status:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .btn-check-status:hover:before {
            width: 100%;
        }

        .btn-check-status:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(21, 126, 58, 0.5);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            margin-top: 1.5rem;
            color: var(--primary-color);
            transition: all 0.3s ease;
            text-decoration: none;
            font-weight: 500;
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

        .form-label {
            font-weight: 500;
            margin-bottom: 0.8rem;
            color: var(--dark-color);
        }

        .invalid-feedback {
            font-size: 0.875rem;
            margin-top: 0.5rem;
            color: #dc3545;
        }

        .section-heading {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .section-heading h3 {
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 0.5rem;
        }

        .section-heading p {
            color: #6c757d;
            font-size: 1.1rem;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="check-status-card">
                    <div class="card-header">
                        <h4><i class="fas fa-search"></i>Cek Status Pendaftaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <i class="fas fa-search-location search-icon"></i>
                            <div class="section-heading">
                                <h3>Periksa Status Pendaftaran Anda</h3>
                                <p>Masukkan NISN dan email yang terdaftar untuk memeriksa status pendaftaran Anda.</p>
                            </div>
                        </div>

                        <form action="{{ route('pendaftaran.cek-status') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="nisn" class="form-label">NISN</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    <input type="text" class="form-control @error('nisn') is-invalid @enderror" id="nisn"
                                        name="nisn" value="{{ old('nisn') }}" placeholder="Masukkan NISN Anda" required>
                                </div>
                                @error('nisn')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            @if(session('message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-check-status">
                                <i class="fas fa-search me-2"></i>Cari Status Pendaftaran
                            </button>
                        </form>

                        <div class="text-center">
                            <a href="{{ route('home') }}" class="back-link">
                                <i class="fas fa-arrow-left"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection