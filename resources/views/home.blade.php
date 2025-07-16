@extends('layouts.app')

@section('title', 'Beranda')

@section('styles')
    <style>
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
            margin-bottom: 60px;
            position: relative;
        }

        .hero-section:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.8;
        }

        .hero-image {
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            transform: translateY(20px);
            transition: all 0.5s ease;
            border: 5px solid var(--light-color);
        }

        .hero-image:hover {
            transform: translateY(10px) rotate(2deg);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .hero-content {
            position: relative;
            z-index: 10;
        }

        .hero-heading {
            font-weight: 800;
            letter-spacing: -0.5px;
            position: relative;
            display: inline-block;
        }

        .hero-heading:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60%;
            height: 4px;
            background: var(--secondary-color);
            border-radius: 2px;
        }

        .hero-subheading {
            font-weight: 600;
            opacity: 0.9;
        }

        .timeline-item {
            position: relative;
            transition: all 0.4s ease;
            border: none;
            overflow: hidden;
        }

        .timeline-item:hover {
            transform: translateY(-15px);
        }

        .timeline-item:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transition: all 0.4s ease;
        }

        .timeline-item:hover:after {
            width: 100%;
        }

        .timeline-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            transition: all 0.5s ease;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            box-shadow: 0 10px 20px rgba(21, 126, 58, 0.2);
            color: white;
        }

        .timeline-item:hover .timeline-icon {
            transform: scale(1.15) rotate(10deg);
            box-shadow: 0 15px 30px rgba(21, 126, 58, 0.3);
        }

        .timeline-icon i {
            font-size: 30px;
            color: var(--secondary-color);
        }

        .jurusan-card {
            border: none;
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .jurusan-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .jurusan-card img {
            height: 240px;
            object-fit: cover;
            transition: all 0.5s ease;
        }

        .jurusan-card:hover img {
            transform: scale(1.1);
        }

        .jurusan-card .card-body {
            padding: 2rem 1.5rem;
        }

        .jurusan-card .card-title {
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--primary-color);
            position: relative;
            padding-bottom: 10px;
        }

        .jurusan-card .card-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--secondary-color);
            border-radius: 2px;
        }

        .jurusan-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--secondary-color);
            color: var(--dark-color);
            font-weight: 600;
            padding: 8px 15px;
            border-radius: 50px;
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
        }

        .kontak-card {
            border-radius: 20px;
            border: none;
            transition: all 0.4s ease;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            background: linear-gradient(135deg, var(--light-color) 0%, var(--gray-light) 100%);
            overflow: hidden;
            position: relative;
        }

        .kontak-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            opacity: 0;
            transition: all 0.4s ease;
            z-index: 0;
        }

        .kontak-card:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .kontak-card:hover:before {
            opacity: 1;
        }

        .kontak-card:hover .card-body * {
            color: var(--light-color);
            position: relative;
            z-index: 1;
        }

        .kontak-icon {
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-color) 100%);
            color: white;
            font-size: 30px;
            box-shadow: 0 10px 20px rgba(21, 126, 58, 0.2);
            transition: all 0.4s ease;
        }

        .kontak-card:hover .kontak-icon {
            transform: scale(1.2) rotate(10deg);
            background: var(--secondary-color);
            color: var(--dark-color);
            box-shadow: 0 15px 30px rgba(255, 215, 0, 0.3);
        }

        .section-title {
            position: relative;
            margin-bottom: 3rem;
            font-weight: 800;
            color: var(--primary-dark);
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        .section-subtitle {
            color: var(--primary-color);
            font-weight: 500;
            margin-bottom: 2rem;
        }

        .btn-daftar {
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            box-shadow: 0 10px 20px rgba(255, 215, 0, 0.3);
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--secondary-dark) 100%);
            color: var(--dark-color);
            border: none;
            transition: all 0.4s ease;
        }

        .btn-daftar:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(255, 215, 0, 0.4);
            color: var(--dark-color);
        }

        .btn-cek {
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 50px;
            border: 2px solid var(--light-color);
            background: transparent;
            color: var(--light-color);
            transition: all 0.4s ease;
        }

        .btn-cek:hover {
            transform: translateY(-5px);
            background: var(--light-color);
            color: var(--primary-color);
        }

        .feature-item {
            transition: all 0.3s ease;
            padding: 10px 0;
        }

        .feature-item i {
            color: var(--secondary-color);
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .feature-item:hover i {
            transform: scale(1.2);
        }

        .bg-section {
            background-color: var(--gray-light);
            border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            padding: 3rem;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Hero Section -->
        <div class="hero-section p-5 my-5">
            <div class="row align-items-center hero-content">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="display-4 hero-heading mb-3 animate__animated animate__fadeInUp">Pendaftaran Peserta Didik
                        Baru</h1>
                    <h2 class="h3 hero-subheading mb-4 animate__animated animate__fadeInUp animate__delay-1s">SMK ANNUR
                        Tahun Ajaran 2024/2025</h2>
                    <p class="lead mb-5 animate__animated animate__fadeInUp animate__delay-2s">Selamat datang di portal PPDB
                        SMK ANNUR. Raih masa depan cerah dengan memilih jurusan yang sesuai minat dan bakatmu!</p>
                    <div class="d-grid gap-3 d-md-flex animate__animated animate__fadeInUp animate__delay-3s">
                        <a href="{{ route('pendaftaran.create') }}" class="btn btn-daftar">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </a>
                        <a href="{{ route('pendaftaran.cek-status-form') }}" class="btn btn-cek">
                            <i class="fas fa-search me-2"></i>Cek Status
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="storage/photos/dokumen/logosmk.png" alt="SMK ANNUR"
                        class="img-fluid hero-image animate__animated animate__fadeInRight">
                </div>
            </div>
        </div>

        <!-- Timeline Section -->
        <div class="row mb-5 py-5 bg-section">
            <div class="col-12 text-center mb-5">
                <h2 class="h1 section-title">Alur Pendaftaran</h2>
                <p class="section-subtitle w-75 mx-auto">Ikuti timeline pendaftaran berikut untuk bergabung dengan SMK ANNUR
                </p>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm timeline-item">
                    <div class="card-body text-center p-4">
                        <div class="timeline-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <h5 class="card-title fw-bold">Pendaftaran Online</h5>
                        <p class="card-text">1 Juni - 30 Juli 2024</p>
                        <p class="text-muted small">Daftar secara online melalui website PPDB</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm timeline-item">
                    <div class="card-body text-center p-4">
                        <div class="timeline-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h5 class="card-title fw-bold">Verifikasi Berkas</h5>
                        <p class="card-text">1 - 5 Agustus 2024</p>
                        <p class="text-muted small">Berkas pendaftaran diverifikasi oleh panitia</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm timeline-item">
                    <div class="card-body text-center p-4">
                        <div class="timeline-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <h5 class="card-title fw-bold">Pengumuman</h5>
                        <p class="card-text">10 Agustus 2024</p>
                        <p class="text-muted small">Pengumuman hasil seleksi penerimaan</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm timeline-item">
                    <div class="card-body text-center p-4">
                        <div class="timeline-icon">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                        <h5 class="card-title fw-bold">Daftar Ulang</h5>
                        <p class="card-text">11 - 15 Agustus 2024</p>
                        <p class="text-muted small">Proses daftar ulang bagi siswa yang diterima</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jurusan Section -->
        <div class="row mb-5 py-5">
            <div class="col-12 text-center mb-5">
                <h2 class="h1 section-title">Program Keahlian</h2>
                <p class="section-subtitle w-75 mx-auto">Pilih jurusan sesuai dengan minat dan bakat untuk masa depan
                    cemerlang</p>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 jurusan-card">
                    <div class="overflow-hidden">
                    </div>
                    <span class="jurusan-badge">PPLG</span>
                    <div class="card-body">
                        <h5 class="card-title">Pengembangan Perangkat Lunak dan Gim</h5>
                        <p class="card-text text-muted">Program keahlian yang mempelajari dan mendalami cara-cara
                            mengembangkan perangkat lunak dan gim. Siswa akan belajar pemrograman, desain UI/UX,
                            pengembangan aplikasi, dan pembuatan gim.</p>
                        <div class="mt-4">
                            <div class="feature-item"><i class="fas fa-check-circle"></i> Pemrograman Web & Mobile</div>
                            <div class="feature-item"><i class="fas fa-check-circle"></i> Desain UI/UX</div>
                            <div class="feature-item"><i class="fas fa-check-circle"></i> Pengembangan Game</div>
                            <div class="feature-item"><i class="fas fa-check-circle"></i> Database Management</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card h-100 jurusan-card">
                    <div class="overflow-hidden">
                    </div>
                    <span class="jurusan-badge">PM</span>
                    <div class="card-body">
                        <h5 class="card-title">Pemasaran</h5>
                        <p class="card-text text-muted">Program keahlian yang mempelajari strategi pemasaran, teknik
                            penjualan, komunikasi bisnis, dan manajemen produk. Siswa akan dibekali dengan pengetahuan dan
                            keterampilan di bidang marketing.</p>
                        <div class="mt-4">
                            <div class="feature-item"><i class="fas fa-check-circle"></i> Digital Marketing</div>
                            <div class="feature-item"><i class="fas fa-check-circle"></i> Manajemen Bisnis</div>
                            <div class="feature-item"><i class="fas fa-check-circle"></i> Komunikasi Pemasaran</div>
                            <div class="feature-item"><i class="fas fa-check-circle"></i> Customer Relationship</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kontak Section -->
        <div class="row mb-5 py-5 bg-section">
            <div class="col-12 text-center mb-5">
                <h2 class="h1 section-title">Informasi Kontak</h2>
                <p class="section-subtitle w-75 mx-auto">Hubungi kami untuk informasi lebih lanjut</p>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 kontak-card">
                    <div class="card-body text-center p-4">
                        <div class="kontak-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h5 class="card-title fw-bold">Alamat</h5>
                        <p class="card-text">Jl. KH. Usman Dhomiri, Pasir Putih, Sawangan, Kota Depok, Jawa Barat</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 kontak-card">
                    <div class="card-body text-center p-4">
                        <div class="kontak-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h5 class="card-title fw-bold">Telepon</h5>
                        <p class="card-text">(021) 7431271</p>
                        <p class="card-text">0812-3456-7890</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 kontak-card">
                    <div class="card-body text-center p-4">
                        <div class="kontak-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h5 class="card-title fw-bold">Email</h5>
                        <p class="card-text">info@smkannur.sch.id</p>
                        <p class="card-text">ppdb@smkannur.sch.id</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"></script>
    <script>
        // Aktifkan animasi saat scroll
        document.addEventListener('DOMContentLoaded', function () {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                    }
                });
            }, {
                threshold: 0.1
            });

            document.querySelectorAll('.timeline-item, .jurusan-card, .kontak-card').forEach(item => {
                observer.observe(item);
            });
        });
    </script>
@endsection