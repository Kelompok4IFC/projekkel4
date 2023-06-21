<?php

namespace App\Controllers;

use App\Libraries\Pengajuanexcel;
use App\Models\PengaduanModel;

class PengaduanController extends BaseController
{
    public function exportToExcel()
    {
        // Ambil data pengaduan dari database
        $pengaduanModel = new PengaduanModel();
        $pengaduan = $pengaduanModel->findAll();

        // Buat objek Pengajuanexcel
        $pengajuanexcel = new Pengajuanexcel();

        // Ekspor data ke Excel
        $pengajuanexcel->exportToExcel($pengaduan);
    }
}