<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\KendaraanModel;
use App\Models\LogActivityModel;


class Owner extends BaseController
{

    private function checkLogin()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'owner') {
            return redirect()->to('/login');
        }
    }

    public function dashboard()
    {
        if ($redirect = $this->checkLogin()) return $redirect;

        $transaksiModel = new TransaksiModel();

        $today = date('Y-m-d');
        $bulan = date('m');
        $tahun = date('Y');

        $pendapatanHari = $transaksiModel
            ->where('tgl_sewa', $today)
            ->where('status_bayar', 'Lunas')
            ->selectSum('total_bayar')
            ->first()['total_bayar'] ?? 0;

        $pendapatanBulan = $transaksiModel
            ->where('MONTH(tgl_sewa)', $bulan)
            ->where('YEAR(tgl_sewa)', $tahun)
            ->where('status_bayar', 'Lunas')
            ->selectSum('total_bayar')
            ->first()['total_bayar'] ?? 0;

        $totalTransaksiHari = $transaksiModel
            ->where('tgl_sewa', $today)
            ->countAllResults();

       
        $kendaraanAktif = $transaksiModel
            ->where('status_sewa', 'Berlangsung')
            ->countAllResults();

        
        $grafik = [];

        for ($i = 6; $i >= 0; $i--) {
            $tanggal = date('Y-m-d', strtotime("-$i days"));

            $total = $transaksiModel
                ->where('tgl_sewa', $tanggal)
                ->where('status_bayar', 'Lunas')
                ->selectSum('total_bayar')
                ->first()['total_bayar'] ?? 0;

            $grafik[] = [
                'tanggal' => date('D', strtotime($tanggal)),
                'total' => $total
            ];
        }

        return view('owner/dashboard', [
            'pendapatanHari' => $pendapatanHari,
            'pendapatanBulan' => $pendapatanBulan,
            'totalTransaksiHari' => $totalTransaksiHari,
            'kendaraanAktif' => $kendaraanAktif,
            'grafik' => $grafik
        ]);
    }

    
   public function laporan()
{
    if ($redirect = $this->checkLogin()) return $redirect;

    $transaksiModel = new TransaksiModel();

    $filter = $this->request->getGet('filter');
    $dari   = $this->request->getGet('dari');
    $sampai = $this->request->getGet('sampai');

    // ===== BASE QUERY FUNCTION =====
    $applyFilter = function($builder) use ($filter, $dari, $sampai) {
        $builder->select('
                transaksi.*,
                pelanggan.nama AS nama_pelanggan,
                kendaraan.nama_kendaraan
            ')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
            ->join('kendaraan', 'kendaraan.id_kendaraan = transaksi.id_kendaraan');

        if ($dari && $sampai) {
            $builder->where('tgl_sewa >=', $dari)
                    ->where('tgl_sewa <=', $sampai);
        } else {
            if ($filter == 'harian') {
                $builder->where('tgl_sewa', date('Y-m-d'));
            } elseif ($filter == 'bulanan') {
                $builder->where('MONTH(tgl_sewa)', date('m'));
            } elseif ($filter == 'tahunan') {
                $builder->where('YEAR(tgl_sewa)', date('Y'));
            }
        }

        return $builder;
    };

    
    $allData = $applyFilter(new TransaksiModel())->findAll();

    $totalTransaksi  = count($allData);
    $totalPendapatan = array_sum(array_column($allData, 'total_bayar'));
    $kendaraanDisewa = count(array_unique(array_column($allData, 'id_kendaraan')));

    
    $transaksiPaged = new TransaksiModel();
    $applyFilter($transaksiPaged);
    $transaksi = $transaksiPaged->paginate(10);

    return view('owner/laporan/index', [
        'transaksi'       => $transaksi,
        'pager'           => $transaksiPaged->pager,
        'totalTransaksi'  => $totalTransaksi,
        'totalPendapatan' => $totalPendapatan,
        'kendaraanDisewa' => $kendaraanDisewa,
    ]);
}

    
    
public function logActivity()
{
    if ($redirect = $this->checkLogin()) return $redirect;

    $logModel = new \App\Models\LogActivityModel();

    $filter   = $this->request->getGet('filter');
    $tanggal  = $this->request->getGet('tanggal');
    $keyword  = $this->request->getGet('keyword');

    $builder = $logModel->orderBy('created_at', 'DESC');

    if (!empty($keyword)) {
        $builder->like('aktivitas', $keyword);
    }

    if ($filter && $filter != 'semua') {
        $builder->like('aktivitas', $filter);
    }

    if ($tanggal && $tanggal != 'semua') {
        if ($tanggal == 'hari_ini') {
            $builder->where('DATE(created_at)', date('Y-m-d'));
        } elseif ($tanggal == 'minggu_ini') {
            $builder->where('created_at >=', date('Y-m-d', strtotime('-7 days')));
        }
    }

    $logs = $builder->paginate(10);

    return view('owner/log/index', [
        'logs'  => $logs,
        'pager' => $logModel->pager
    ]);
}

    public function export()
{
    if ($redirect = $this->checkLogin()) return $redirect;

    $transaksiModel = new TransaksiModel();

    $dari   = $this->request->getGet('dari');
    $sampai = $this->request->getGet('sampai');

    $builder = $transaksiModel
        ->select('
            transaksi.*,
            pelanggan.nama AS nama_pelanggan,
            kendaraan.nama_kendaraan
        ')
        ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
        ->join('kendaraan', 'kendaraan.id_kendaraan = transaksi.id_kendaraan');

    if ($dari && $sampai) {
        $builder->where('tgl_sewa >=', $dari)
                ->where('tgl_sewa <=', $sampai);
    }

    $data = $builder->findAll();

    $html = view('owner/laporan/pdf', [
        'transaksi' => $data
    ]);

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    $dompdf->stream("laporan_transaksi.pdf", ["Attachment" => true]);
}

public function kendaraan()
{
    $model = new \App\Models\KendaraanModel();

    $keyword = $this->request->getGet('keyword');
    $jenis   = $this->request->getGet('jenis');
    $status  = $this->request->getGet('status');

    if ($keyword) {
        $model->groupStart()
              ->like('nama_kendaraan', $keyword)
              ->orLike('plat_nomor', $keyword)
              ->groupEnd();
    }

    if ($jenis) { $model->where('jenis', $jenis); }
    if ($status) { $model->where('status', $status); }

    $model->orderBy('id_kendaraan', 'DESC'); 

    $data = [
        'kendaraan' => $model->paginate(6),
        'pager'     => $model->pager,
        'keyword'   => $keyword,
        'jenis'     => $jenis,
        'status'    => $status
    ];

    return view('owner/kendaraan/index', $data);
}

}