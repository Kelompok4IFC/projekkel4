<?php

namespace App\Libraries;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Trackingexcel{

public function exportToExcel($tracking)
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    $sheet->setCellValue('A1', 'No');
    $sheet->setCellValue('B1', 'Nama Asset');
    $sheet->setCellValue('C1', 'Keadaan');
    $sheet->setCellValue('D1', 'Tanggal');
    $sheet->setCellValue('E1', 'Lokasi');

    $row = 2;
    $no = 1;

    foreach ($tracking as $status) {
        $sheet->setCellValue('A' . $row, $no);
        $sheet->setCellValue('B' . $row, $status['nama']);
        $sheet->setCellValue('C' . $row, isset($status['keadaan']) ? $status['keadaan'] : '');
        $sheet->setCellValue('D' . $row, isset($status['tanggal']) ? date('Y-m-d', strtotime($status['tanggal'])) : '');
        $sheet->setCellValue('E' . $row, isset($status['lokasi']) ? $status['lokasi'] : '');
        $row++;
        $no++;
    }

    $writer = new Xlsx($spreadsheet);
    $filename = 'data_tracking.xlsx';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}
}