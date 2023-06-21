<?php

namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table = 'pengaduan';
    protected $allowedFields = ['pengaduan', 'tanggal', 'waktu', 'ruangan', 'nama_user'];
}