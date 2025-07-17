<?php

namespace App\Exports;

use App\Models\CalonSiswa;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class CalonSiswaExport
{
    protected $status;
    protected $search;

    public function __construct($status = null, $search = null)
    {
        $this->status = $status;
        $this->search = $search;
    }

    public function export()
    {
        // Buat spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul
        $sheet->setCellValue('A1', 'DATA CALON SISWA SMK ANNUR');
        $sheet->mergeCells('A1:K1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set tanggal ekspor
        $sheet->setCellValue('A2', 'Tanggal Export: ' . date('d-m-Y H:i:s'));
        $sheet->mergeCells('A2:K2');
        $sheet->getStyle('A2')->getFont()->setSize(12);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set header
        $headers = [
            'No',
            'Nama',
            'NISN',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat',
            'Asal Sekolah',
            'Pilihan Jurusan',
            'Email',
            'No. HP',
            'Status'
        ];

        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '4', $header);
            $col++;
        }

        // Style untuk header
        $headerRange = 'A4:K4';
        $sheet->getStyle($headerRange)->getFont()->setBold(true);
        $sheet->getStyle($headerRange)->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('157e3a');
        $sheet->getStyle($headerRange)->getFont()->getColor()->setRGB('FFFFFF');

        // Dapatkan data
        $query = CalonSiswa::query();

        // Filter berdasarkan status jika ada
        if ($this->status && $this->status != 'semua') {
            $query->where('status', $this->status);
        }

        // Filter berdasarkan pencarian jika ada
        if ($this->search) {
            $search = $this->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nisn', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        $calonSiswas = $query->orderBy('created_at', 'desc')->get();

        // Isi data
        $row = 5;
        foreach ($calonSiswas as $index => $siswa) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $siswa->nama);
            $sheet->setCellValue('C' . $row, $siswa->nisn);
            $sheet->setCellValue('D' . $row, $siswa->tempat_lahir);
            $sheet->setCellValue('E' . $row, $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d-m-Y') : '');
            $sheet->setCellValue('F' . $row, $siswa->alamat);
            $sheet->setCellValue('G' . $row, $siswa->asal_sekolah);
            $sheet->setCellValue('H' . $row, $siswa->pilihan_jurusan);
            $sheet->setCellValue('I' . $row, $siswa->email);
            $sheet->setCellValue('J' . $row, $siswa->no_hp);
            $sheet->setCellValue('K' . $row, ucfirst($siswa->status));

            // Style untuk status
            if ($siswa->status == 'diterima') {
                $sheet->getStyle('K' . $row)->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('d1e7dd');
            } elseif ($siswa->status == 'ditolak') {
                $sheet->getStyle('K' . $row)->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('f8d7da');
            } elseif ($siswa->status == 'pending') {
                $sheet->getStyle('K' . $row)->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setRGB('fff3cd');
            }

            $row++;
        }

        // Jika tidak ada data
        if ($calonSiswas->count() == 0) {
            $sheet->setCellValue('B5', 'Tidak ada data yang ditemukan');
            $sheet->mergeCells('B5:K5');
            $sheet->getStyle('B5')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Auto size kolom
        foreach (range('A', 'K') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Simpan file
        $filename = 'data_calon_siswa_' . date('Y-m-d_H-i-s') . '.xlsx';
        $filePath = storage_path('app/public/' . $filename);

        // Pastikan direktori ada
        if (!file_exists(storage_path('app/public'))) {
            mkdir(storage_path('app/public'), 0755, true);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        // Return file untuk didownload
        return response()->download($filePath, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }
}