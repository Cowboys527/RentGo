<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $allowedFields = [
        'nama',
        'no_hp',
        'alamat',
        'nik',
        'foto_ktp',
        'foto_sim'
    ];
}