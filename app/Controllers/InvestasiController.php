<?php

namespace App\Controllers;

use App\Libraries\InvestasiExcel;
use App\Models\InvestasiModel;

class InvestasiController extends BaseController
{
    protected $investasiModel;

    public function __construct()
    {
        $this->investasiModel = new InvestasiModel();
    }

    public function exportToExcel()
    {
        $investasiData = $this->investasiModel->findAll();

        $investasiExcel = new InvestasiExcel();
        $path = $investasiExcel->exportData($investasiData);

        return $this->response->download($path, null)->setFileName('data_investasi.xlsx');
    }
}