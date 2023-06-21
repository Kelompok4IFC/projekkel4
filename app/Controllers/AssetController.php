<?php

namespace App\Controllers;

use App\Libraries\Excel;
use App\Models\AssetModel;

class AssetController extends BaseController
{
    protected $assetModel;

    public function __construct()
    {
        $this->assetModel = new AssetModel();
    }

    // ...

    public function exportToExcel()
    {
        // Mendapatkan data assets dari database
        $assets = $this->assetModel->findAll();

        // Menentukan nama file Excel
        $filename = 'assetskelompok4.xlsx';

        // Menggunakan library Excel untuk mengekspor data
        $excel = new Excel();
        $excel->exportDataToExcel($assets, $filename);

        // Mengirim file Excel ke browser untuk diunduh
        return $this->response->download($filename, null);
    }

    // ...
}