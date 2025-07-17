<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Calon Siswa SMK ANNUR</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 12px;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th {
            background-color: #157e3a;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 5px;
        }

        td {
            padding: 5px;
            font-size: 10px;
        }

        .status-pending {
            background-color: #fff3cd;
        }

        .status-diterima {
            background-color: #d1e7dd;
        }

        .status-ditolak {
            background-color: #f8d7da;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 20px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>DATA CALON SISWA SMK ANNUR</h1>
        <p>Tanggal Export: {{ date('d-m-Y H:i:s') }}</p>
        @if($status && $status != 'semua')
            <p>Filter Status: {{ ucfirst($status) }}</p>
        @endif
        @if($search)
            <p>Pencarian: {{ $search }}</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">Nama</th>
                <th style="width: 10%">NISN</th>
                <th style="width: 10%">Tempat Lahir</th>
                <th style="width: 10%">Tanggal Lahir</th>
                <th style="width: 10%">Asal Sekolah</th>
                <th style="width: 10%">Jurusan</th>
                <th style="width: 15%">Email</th>
                <th style="width: 10%">No. HP</th>
                <th style="width: 5%">Status</th>
            </tr>
        </thead>
        <tbody>
            @if(count($calonSiswas) > 0)
                @foreach($calonSiswas as $index => $siswa)
                    <tr>
                        <td style="text-align: center">{{ $index + 1 }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $siswa->nisn }}</td>
                        <td>{{ $siswa->tempat_lahir }}</td>
                        <td>{{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d-m-Y') : '' }}</td>
                        <td>{{ $siswa->asal_sekolah }}</td>
                        <td>{{ $siswa->pilihan_jurusan }}</td>
                        <td>{{ $siswa->email }}</td>
                        <td>{{ $siswa->no_hp }}</td>
                        <td class="status-{{ $siswa->status }}" style="text-align: center">
                            {{ ucfirst($siswa->status) }}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10" style="text-align: center">Tidak ada data</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        <p>© {{ date('Y') }} SMK ANNUR - Sistem Penerimaan Peserta Didik Baru</p>
    </div>
</body>

</html>