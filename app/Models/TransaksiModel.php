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
    'jam_sewa', 
    'lama_sewa',
    'tgl_kembali_rencana',
    'jam_kembali',
    'tgl_kembali',
    'total_bayar',
    'dp',
    'sisa_bayar',
    'denda',
    'metode_bayar',
    'status_bayar',
    'status_sewa'
    
    ];
}
