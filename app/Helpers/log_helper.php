<?php

use App\Models\LogActivityModel;

function log_activity($aktivitas)
{
    $logModel = new LogActivityModel();

    $logModel->save([
        'user_id' => session()->get('id_user'),
        'nama_user' => session()->get('nama'),
        'created_by_role' => session()->get('role'),
        'aktivitas' => $aktivitas,
        'ip_address' => $_SERVER['REMOTE_ADDR'],
        'created_at' => date('Y-m-d H:i:s')
    ]);
}