<?php

namespace App\Controllers;

use App\Libraries\Trackingexcel;
use App\Models\TrackingModel;

class TrackingController extends BaseController
{
  protected $trackingModel;

  public function __construct()
  {
      $this->trackingModel = new TrackingModel();
  }

    public function exportToExcel()
    {
      $trackingModel = new TrackingModel();
      $status = $trackingModel->findAll();

        $trackingExcel = new Trackingexcel();
        $trackingExcel->exportToExcel($status);
    }
}