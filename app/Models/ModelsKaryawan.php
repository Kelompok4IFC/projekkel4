<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelsKaryawan extends Model
{
    protected $table ="karyawan";
    protected $primaryKey = 'id';
    protected $allowedFields = ['karyawan_username', 'karyawan_password'];
}