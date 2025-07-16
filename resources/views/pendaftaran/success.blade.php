@extends('layouts.app')

@section('title', 'Pendaftaran Berhasil')

@section('styles')
    <style>
        .success-card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            border: none;
            margin: 60px 0;
            transition: all 0.3s ease;
        }

        .success-card:hover {
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
        }

        .card-header i {
            color: var(--secondary-color);
            margin-right: 10px;
        }

        .card-body {
            padding: 3rem;
        }

        .success-icon {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            font-size: 4rem;
            box-shadow: 0 10px 30px rgba(21, 126, 58, 0.3);
            animation: success-pulse 2s infinite;
        }

        @keyframes success-pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(21, 126, 58, 0.5);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(21, 126, 58, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(21, 126, 58, 0);
            }
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: var(--secondary-color);
            opacity: 0.8;
            animation: confetti-fall 5s ease-in-out infinite;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(-100px) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(800px) rotate(360deg);
                opacity: 0;
            }
        }

        .info-card {
            border-radius: 15px;
            background-color: var(--gray-light);
            padding: 2rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .info-title {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 1.2rem;
            position: relative;
            padding-left: 20px;
        }

        .info-title:before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 25px;
            background: var(--secondary-color);
            border-radius: 4px;
        }

        .info-list {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .info-list li {
            position: relative;
            padding: 0.7rem 0 0.7rem 2rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .info-list li:last-child {
            border-bottom: none;
        }

        .info-list li i {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
        }

        .detail-row {
            margin-bottom: 1.2rem;
        }

        .detail-label {
            font-weight: 500;
            color: #6c757d;
            margin-bottom: 0.3rem;
        }

        .detail-value {
            font-weight: 600;
            color: var(--dark-color);
        }

        .next-steps {
            position: relative;
            border-radius: 15px;
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--secondary-dark) 100%);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
        }

        .next-steps-title {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1.2rem;
        }

        .next-steps-text {
            color: var(--dark-color);
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 2rem;
        }

        .btn-cek-status {
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            box-shadow: 0 5px 15px rgba(21, 126, 58, 0.3);
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-cek-status:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(21, 126, 58, 0.5);
        }

        .btn-home {
            padding: 12px 25px;
            border-radius: 12px;
            font-weight: 600;
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-home:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .section-heading {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .section-heading h3 {
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 0.8rem;
        }

        .section-heading p {
            color: #6c757d;
            font-size: 1.1rem;
            max-width: 700px;
            margin: 0 auto;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="success-card">
                    <div class="card-header">
                        <h4><i class="fas fa-check-circle"></i>Pendaftaran Berhasil</h4>
                    </div>
                    <div class="card-body">
                        <div id="confetti-container" style="position: relative; overflow: hidden;">
                            <div class="text-center mb-5">
                                <div class="success-icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="section-heading">
                                    <h3>Pendaftaran Berhasil!</h3>
                                    <p>Selamat! Data pendaftaran Anda telah berhasil disimpan. Silakan catat nomor
                                        pendaftaran Anda dan periksa status pendaftaran secara berkala.</p>
                                </div>
                            </div>
                        </div>

                        <div class="info-card">
                            <h5 class="info-title">Informasi Pendaftaran</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="detail-row">
                                        <div class="detail-label">Nomor Pendaftaran</div>
                                        <div class="detail-value">{{ $calonSiswa->id_siswa }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-row">
                                        <div class="detail-label">Tanggal Pendaftaran</div>
                                        <div class="detail-value">
                                            {{ \Carbon\Carbon::parse($calonSiswa->tanggal_daftar)->format('d F Y') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-row">
                                        <div class="detail-label">Nama Lengkap</div>
                                        <div class="detail-value">{{ $calonSiswa->nama }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-row">
                                        <div class="detail-label">NISN</div>
                                        <div class="detail-value">{{ $calonSiswa->nisn }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-row">
                                        <div class="detail-label">Email</div>
                                        <div class="detail-value">{{ $calonSiswa->email }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-row">
                                        <div class="detail-label">Pilihan Jurusan</div>
                                        <div class="detail-value">{{ $calonSiswa->pilihan_jurusan }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="next-steps">
                            <h5 class="next-steps-title"><i class="fas fa-clipboard-list me-2"></i>Langkah Selanjutnya</h5>
                            <p class="next-steps-text">Simpan nomor pendaftaran Anda dan periksa status pendaftaran secara
                                berkala. Status pendaftaran akan diperbarui setelah diverifikasi oleh tim kami.</p>
                            <ul class="info-list mt-3">
                                <li><i class="fas fa-check-circle"></i> Simpan nomor pendaftaran:
                                    <strong>{{ $calonSiswa->id_siswa }}</strong>
                                </li>
                                <li><i class="fas fa-check-circle"></i> Cek status pendaftaran secara berkala</li>
                                <li><i class="fas fa-check-circle"></i> Siapkan dokumen yang diperlukan untuk tahap
                                    selanjutnya</li>
                            </ul>
                        </div>

                        <div class="action-buttons">
                            <a href="{{ route('pendaftaran.cek-status-form') }}" class="btn btn-cek-status">
                                <i class="fas fa-search me-2"></i>Cek Status Pendaftaran
                            </a>
                            <a href="{{ route('home') }}" class="btn btn-home">
                                <i class="fas fa-home me-2"></i>Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('confetti-container');
            const containerWidth = container.offsetWidth;
            const containerHeight = container.offsetHeight;

            // Create confetti elements
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * containerWidth + 'px';
                confetti.style.width = Math.random() * 10 + 5 + 'px';
                confetti.style.height = Math.random() * 10 + 5 + 'px';
                confetti.style.background = getRandomColor();
                confetti.style.animationDuration = Math.random() * 3 + 2 + 's';
                confetti.style.animationDelay = Math.random() * 2 + 's';
                container.appendChild(confetti);
            }

            function getRandomColor() {
                const colors = [
                    '#157e3a', // Primary
                    '#ffd700', // Secondary
                    '#25b053', // Primary Light
                    '#e0bc00', // Secondary Dark
                    '#18bc9c', // Accent Teal
                    '#8e44ad', // Accent Purple
                    '#e67e22'  // Accent Orange
                ];
                return colors[Math.floor(Math.random() * colors.length)];
            }
        });
    </script>
@endsection