<?php

namespace App\Controllers;

use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    public function index()
    {
        $model = new TransaksiModel();
        $data['transaksi'] = $model->findAll();

        return view('admin/transaksi/index', $data);
    }
}
