<?php

namespace App\Libraries;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel
{
    public function exportDataToExcel($data, $filename)
    {
        $spreadsheet = new Spreadsheet();
        $activeSheet = $spreadsheet->getActiveSheet();

        // Menulis header kolom
        $activeSheet->setCellValue('A1', 'No');
        $activeSheet->setCellValue('B1', 'Nama Asset');
        $activeSheet->setCellValue('C1', 'Harga');
        $activeSheet->setCellValue('D1', 'Jumlah');
        $activeSheet->setCellValue('E1', 'Kondisi');

        // Menulis data assets
        $row = 2;
        $no = 1;
        foreach ($data as $asset) {
            $activeSheet->setCellValue('A' . $row, $no);
            $activeSheet->setCellValue('B' . $row, $asset['nama']);

            // Format angka untuk kolom harga
            $harga = 'Rp ' . number_format($asset['harga_beli'], 0, ',', '.');
            $activeSheet->setCellValue('C' . $row, $harga);

            $activeSheet->setCellValue('D' . $row, $asset['jumlah']);
            $activeSheet->setCellValue('E' . $row, $asset['kondisi_barang']);

            $row++;
            $no++;
        }

        // Mengatur lebar kolom
        $activeSheet->getColumnDimension('A')->setWidth(5);
        $activeSheet->getColumnDimension('B')->setWidth(20);
        $activeSheet->getColumnDimension('C')->setWidth(15);
        $activeSheet->getColumnDimension('D')->setWidth(15);
        $activeSheet->getColumnDimension('E')->setWidth(15);

        // Menghasilkan file Excel
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);
    }
}