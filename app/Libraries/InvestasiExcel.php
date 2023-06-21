<?php

namespace App\Libraries;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class InvestasiExcel
{
    public static function exportData($investasi)
    {
        $spreadsheet = new Spreadsheet();

        // Mendapatkan aktif sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Mengatur judul kolom
        $sheet->setCellValue('A1', 'Nama Investasi');
        $sheet->setCellValue('B1', 'Tanggal');
        $sheet->setCellValue('C1', 'Tahun');
        $sheet->setCellValue('D1', 'Keuntungan');
        $sheet->setCellValue('E1', 'Biaya');
        $sheet->setCellValue('F1', 'ROI');

        // Mengisi data investasi
        $row = 2;
        foreach ($investasi as $data) {
            $sheet->setCellValue('A' . $row, isset($data['nama_investasi']) ? $data['nama_investasi'] : '');
            $sheet->setCellValue('B' . $row, isset($data['tanggal']) ? $data['tanggal'] : '');
            $sheet->setCellValue('C' . $row, isset($data['tahun']) ? $data['tahun'] : '');
            $sheet->setCellValue('D' . $row, isset($data['keuntungan']) ? $data['keuntungan'] : '');
            $sheet->setCellValue('E' . $row, isset($data['biaya']) ? $data['biaya'] : '');
            $sheet->setCellValue('F' . $row, isset($data['keuntungan']) && isset($data['biaya']) ? $data['keuntungan'] - $data['biaya'] : '');
            $row++;
        }

        // Membuat objek Writer
        $writer = new Xlsx($spreadsheet);

        // Menyimpan file Excel
        $filename = 'data_investasi.xlsx';
        $path = WRITEPATH . 'uploads/' . $filename;
        $writer->save($path);

        return $path;
    }
}