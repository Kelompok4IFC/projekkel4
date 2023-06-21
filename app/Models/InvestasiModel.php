<?php

namespace App\Models;

use CodeIgniter\Model;

class InvestasiModel extends Model
{
    protected $table = 'investasi';
    protected $allowedFields = ['nama_investasi', 'tanggal', 'tahun', 'keuntungan', 'biaya', 'roi'];
}