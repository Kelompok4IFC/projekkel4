<?php

namespace App\Models;

use CodeIgniter\Model;

class LogTrackingModel extends Model
{
    protected $table = 'log_tracking';
    protected $allowedFields = ['id', 'action', 'user', 'data', 'timestamp'];
}