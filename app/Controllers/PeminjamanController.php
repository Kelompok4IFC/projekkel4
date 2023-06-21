<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\PeminjamanModel;

class PeminjamanController extends BaseController
{
    protected $peminjamanModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
    }

    // ...

    public function exportToExcel()
    {
        // Mendapatkan data peminjaman dari database
        $peminjaman = $this->peminjamanModel->findAll();

        // Membuat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menulis judul kolom
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Peminjam');
        $sheet->setCellValue('C1', 'Nama Barang');
        $sheet->setCellValue('D1', 'Tanggal');
        $sheet->setCellValue('E1', 'Nama Penanggung Jawab');

        // Menulis data peminjaman
        $row = 2;
        foreach ($peminjaman as $key => $peminjam) {
            $sheet->setCellValue('A' . $row, isset($peminjam['id']) ? $peminjam['id'] : '');
            $sheet->setCellValue('B' . $row, isset($peminjam['nama_peminjam']) ? $peminjam['nama_peminjam'] : '');
            $sheet->setCellValue('C' . $row, isset($peminjam['nama_barang']) ? $peminjam['nama_barang'] : '');
            $sheet->setCellValue('D' . $row, isset($peminjam['tanggal']) ? $peminjam['tanggal'] : '');
            $sheet->setCellValue('E' . $row, isset($peminjam['nama_penanggung_jawab']) ? $peminjam['nama_penanggung_jawab'] : '');

            $row++;
        }

        // Menentukan nama file Excel
        $filename = 'rekap_peminjaman.xlsx';

        // Membuat objek Writer untuk menulis Spreadsheet ke file Excel
        $writer = new Xlsx($spreadsheet);

        // Menyimpan file Excel
        $writer->save($filename);

        // Mengirim file Excel ke browser untuk diunduh
        return $this->response->download($filename, null);
    }

    // ...
}