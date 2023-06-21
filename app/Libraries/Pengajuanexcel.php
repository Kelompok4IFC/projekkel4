<?php

namespace App\Libraries;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pengajuanexcel
{
    public function exportToExcel($pengaduan)
    {
        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header kolom
        $sheet->setCellValue('A1', 'Pengaduan');
        $sheet->setCellValue('B1', 'Tanggal');
        $sheet->setCellValue('C1', 'Waktu');
        $sheet->setCellValue('D1', 'Ruangan');
        $sheet->setCellValue('E1', 'Nama User');

        // Set data pengaduan
        $row = 2;
        foreach ($pengaduan as $data) {
            $sheet->setCellValue('A' . $row, $data['pengaduan']);
            $sheet->setCellValue('B' . $row, $data['tanggal']);
            $sheet->setCellValue('C' . $row, $data['waktu']);
            $sheet->setCellValue('D' . $row, $data['ruangan']);
            $sheet->setCellValue('E' . $row, $data['nama_user']);
            $row++;
        }

        // Set judul file dan header untuk men-download file
        $filename = 'data_pengaduan.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Buat writer dan tulis spreadsheet ke output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}