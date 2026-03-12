<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use App\Models\UserModel;
use App\Models\TransaksiModel;

class Admin extends BaseController
{
    public function dashboard()
    {
        // Cek login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $kendaraanModel = new KendaraanModel();
        $userModel      = new UserModel();
        $transaksiModel = new TransaksiModel();

        // =============================
        // RINGKASAN DATA
        // =============================

        $totalKendaraan = $kendaraanModel->countAll();

        $tersedia = $kendaraanModel
            ->where('status', 'Tersedia')
            ->countAllResults();

        $disewa = $kendaraanModel
            ->where('status', 'Disewa')
            ->countAllResults();

        $totalUser = $userModel->countAll();

        // =============================
        // TRANSAKSI HARI INI
        // =============================

        $today = date('Y-m-d');

        $transaksiHariIni = $transaksiModel
            ->select('
                transaksi.id_transaksi,
                kendaraan.nama_kendaraan,
                users.nama AS nama_user,
                transaksi.status_bayar,
                transaksi.tgl_sewa
            ')
            ->join('kendaraan', 'kendaraan.id_kendaraan = transaksi.id_kendaraan')
            ->join('users', 'users.id_user = transaksi.id_user')
            ->where('DATE(transaksi.tgl_sewa)', $today)
            ->orderBy('transaksi.id_transaksi', 'DESC')
            ->findAll();

        // =============================
        // KIRIM KE VIEW
        // =============================

        $data = [
            'totalKendaraan'   => $totalKendaraan,
            'tersedia'         => $tersedia,
            'disewa'           => $disewa,
            'totalUser'        => $totalUser,
            'transaksiHariIni' => $transaksiHariIni
        ];

        return view('admin/dashboard', $data);
    }
}