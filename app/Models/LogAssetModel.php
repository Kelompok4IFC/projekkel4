<?php

namespace App\Models;

use CodeIgniter\Model;

class LogAssetModel extends Model
{
    protected $table = 'log_asset';
    protected $allowedFields = ['id', 'action', 'user', 'data', 'timestamp'];
}