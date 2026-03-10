<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $allowedFields = [
    'id_user',
    'id_pelanggan',
    'id_kendaraan',
    'tgl_sewa',
    'lama_sewa',
    'total_bayar',
    'status_bayar',
    'tgl_kembali'
    
    ];
}
