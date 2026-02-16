<?php

namespace App\Models;
use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'id_kendaraan';

    protected $allowedFields = [
        'nama_kendaraan',
        'jenis',
        'plat_nomor',
        'harga_sewa',
        'status'
    ];
}
