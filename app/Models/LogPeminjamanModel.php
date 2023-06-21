<?php

namespace App\Models;

use CodeIgniter\Model;

class LogPeminjamanModel extends Model
{
    protected $table = 'log_peminjaman';
    protected $allowedFields = ['id', 'action', 'user', 'data', 'timestamp'];
}