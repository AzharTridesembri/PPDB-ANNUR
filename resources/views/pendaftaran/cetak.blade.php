<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pendaftaran - {{ $calonSiswa->nama }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            padding: 0;
            margin: 0;
        }

        .print-container {
            background-color: #fff;
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 20mm 15mm;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #157e3a;
        }

        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
            height: auto;
            margin-right: 20px;
        }

        .header-text {
            text-align: center;
        }

        .school-name {
            font-size: 22px;
            font-weight: bold;
            margin: 0;
            color: #157e3a;
        }

        .school-address {
            font-size: 12px;
            margin: 5px 0;
        }

        .document-title {
            font-size: 24px;
            font-weight: bold;
            margin: 20px 0 10px;
            text-align: center;
            color: #157e3a;
            text-transform: uppercase;
        }

        .document-subtitle {
            font-size: 16px;
            text-align: center;
            margin-bottom: 30px;
            color: #555;
        }

        .registration-number {
            text-align: center;
            margin: 20px 0;
            padding: 10px;
            background-color: #f9f9f9;
            border: 2px dashed #157e3a;
            border-radius: 10px;
        }

        .registration-number-label {
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .registration-number-value {
            font-size: 20px;
            font-weight: bold;
            color: #157e3a;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin: 30px 0 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #157e3a;
            color: #157e3a;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table td {
            padding: 8px 10px;
            vertical-align: top;
        }

        .data-table td:first-child {
            width: 30%;
            font-weight: 500;
        }

        .data-table td:nth-child(2) {
            width: 5%;
            text-align: center;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
        }

        .signature-area {
            display: inline-block;
            text-align: center;
            margin-top: 30px;
        }

        .signature-name {
            margin-top: 80px;
            font-weight: bold;
            border-top: 1px solid #333;
            padding-top: 10px;
            display: inline-block;
        }

        .signature-title {
            font-size: 12px;
            color: #555;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            opacity: 0.1;
            font-size: 100px;
            font-weight: bold;
            color: #157e3a;
            white-space: nowrap;
            z-index: 0;
        }

        .date-place {
            margin-top: 40px;
            margin-bottom: 20px;
            text-align: right;
        }

        .status-approved {
            display: inline-block;
            padding: 5px 15px;
            background-color: #157e3a;
            color: white;
            border-radius: 50px;
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
        }

        .barcode-container {
            text-align: center;
            margin: 20px 0;
        }

        .barcode {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
        }

        .note {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 4px solid #ffd700;
            font-size: 14px;
        }

        .print-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #157e3a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .print-btn:hover {
            background-color: #0e5e2b;
        }

        @media print {
            body {
                background-color: #fff;
            }

            .print-container {
                width: 100%;
                min-height: auto;
                padding: 0;
                box-shadow: none;
            }

            .print-btn {
                display: none;
            }
        }
    </style>
</head>

<body>
    <button onclick="window.print()" class="print-btn">
        <i class="fas fa-print"></i> Cetak
    </button>

    <div class="print-container">
        <div class="watermark">SMK ANNUR</div>

        <div class="header">
            <div class="logo-container">
                <img src="{{ asset('storage/photos/dokumen/logosmk.png') }}" alt="Logo SMK ANNUR" class="logo">
                <div class="header-text">
                    <p class="school-name">SMK ANNUR</p>
                    <p class="school-address">Jl. KH. Usman Dhomiri, Pasir Putih, Sawangan, Kota Depok, Jawa Barat</p>
                    <p class="school-address">Email: info@smkannur.sch.id | Telp: (021) 7431271</p>
                </div>
            </div>
        </div>

        <h1 class="document-title">Bukti Pendaftaran</h1>
        <p class="document-subtitle">Penerimaan Peserta Didik Baru Tahun Ajaran 2024/2025</p>

        <div class="registration-number">
            <div class="registration-number-label">Nomor Pendaftaran</div>
            <div class="registration-number-value">{{ $calonSiswa->id_siswa }}</div>
        </div>

        <h2 class="section-title">A. Data Diri</h2>
        <table class="data-table">
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td>{{ $calonSiswa->nama }}</td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>:</td>
                <td>{{ $calonSiswa->nisn }}</td>
            </tr>
            <tr>
                <td>Tempat, Tanggal Lahir</td>
                <td>:</td>
                <td>{{ $calonSiswa->tempat_lahir }}, {{ date('d F Y', strtotime($calonSiswa->tanggal_lahir)) }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $calonSiswa->alamat }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $calonSiswa->email }}</td>
            </tr>
            <tr>
                <td>Nomor Telepon</td>
                <td>:</td>
                <td>{{ $calonSiswa->no_hp }}</td>
            </tr>
        </table>

        <h2 class="section-title">B. Data Pendidikan</h2>
        <table class="data-table">
            <tr>
                <td>Asal Sekolah</td>
                <td>:</td>
                <td>{{ $calonSiswa->asal_sekolah }}</td>
            </tr>
            <tr>
                <td>Pilihan Jurusan</td>
                <td>:</td>
                <td>{{ $calonSiswa->pilihan_jurusan }}</td>
            </tr>
        </table>

        <div class="note">
            <strong>Catatan:</strong> Bukti pendaftaran ini harap dibawa saat melakukan daftar ulang bersama dengan
            dokumen asli yang diperlukan.
        </div>

        <div class="date-place">
            Depok, {{ date('d F Y') }}
        </div>

        <div class="footer">
            <div class="signature-area">
                <div class="status-approved">DITERIMA</div>
                <div class="signature-name">Kepala Sekolah</div>
                <div class="signature-title">SMK ANNUR</div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function () {
            // Auto print when the page loads (uncomment to enable)
            // window.print();
        };
    </script>
</body>

</html>