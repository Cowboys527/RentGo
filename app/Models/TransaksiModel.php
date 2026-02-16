<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';

    protected $allowedFields = [
        'id_user',
        'id_kendaraan',
        'tanggal_pinjam',
        'tanggal_kembali',
        'total_bayar',
        'status'
    ];
}
