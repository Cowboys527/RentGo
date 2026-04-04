<?php

namespace App\Models;

use CodeIgniter\Model;

class LogActivityModel extends Model
{
    protected $table = 'log_activity';
    protected $primaryKey = 'id_log';

    protected $allowedFields = [
        'user_id',
        'nama_user',
        'created_by_role',
        'aktivitas',
        'ip_address',
        'created_at'
    ];
}