<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\KendaraanModel;
use App\Models\PelangganModel;

class Kasir extends BaseController
{
    
    public function dashboard()
{
    $this->autoUpdateStatus();

    if (!session()->get('logged_in') || session()->get('role') != 'kasir') {
        return redirect()->to('/login');
    }

    $transaksiModel = new TransaksiModel();
    $kendaraanModel = new KendaraanModel();

   
    $transaksiHariIni = $transaksiModel
        ->where('tgl_sewa', date('Y-m-d'))
        ->countAllResults();

    $kendaraanTersedia = $kendaraanModel
        ->where('status', 'tersedia')
        ->countAllResults();

    $kendaraanDisewa = $kendaraanModel
        ->where('status', 'disewa')
        ->countAllResults();


    $daftarTransaksi = $transaksiModel
        ->select('
            transaksi.*,
            pelanggan.nama AS nama_pelanggan,
            kendaraan.nama_kendaraan
        ')
        ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
        ->join('kendaraan', 'kendaraan.id_kendaraan = transaksi.id_kendaraan')
        ->where('transaksi.tgl_sewa', date('Y-m-d'))
        ->orderBy('transaksi.id_transaksi', 'DESC')
        ->findAll();

    return view('kasir/dashboard', [
        'transaksiHariIni'   => $transaksiHariIni,
        'kendaraanTersedia'  => $kendaraanTersedia,
        'kendaraanDisewa'    => $kendaraanDisewa,
        'daftarTransaksi'    => $daftarTransaksi 
    ]);
}

    
    public function transaksi()
{
    $this->autoUpdateStatus();

    if (!session()->get('logged_in') || session()->get('role') != 'kasir') {
        return redirect()->to('/login');
    }

    $transaksiModel = new \App\Models\TransaksiModel();

    $keyword = $this->request->getGet('keyword');
    $status_bayar = $this->request->getGet('status_bayar');
    $status_sewa = $this->request->getGet('status_sewa');

    $transaksiModel
        ->select('
            transaksi.*,
            pelanggan.nama AS nama_pelanggan,
            kendaraan.nama_kendaraan
        ')
        ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
        ->join('kendaraan', 'kendaraan.id_kendaraan = transaksi.id_kendaraan');

    if (!empty($keyword)) {
        $transaksiModel->like('pelanggan.nama', $keyword);
    }

    if (!empty($status_bayar)) {
        $transaksiModel->where('transaksi.status_bayar', $status_bayar);
    }

    if (!empty($status_sewa)) {
        $transaksiModel->where('transaksi.status_sewa', $status_sewa);
    }

    $transaksi = $transaksiModel
        ->orderBy('transaksi.id_transaksi', 'DESC')
        ->paginate(10);

    return view('kasir/transaksi/index', [
        'transaksi' => $transaksi,
        'pager' => $transaksiModel->pager
    ]);
}


public function tambah()
{
    if (!session()->get('logged_in') || session()->get('role') != 'kasir') {
        return redirect()->to('/login');
    }

    $kendaraanModel = new \App\Models\KendaraanModel();

    $kendaraan = $kendaraanModel
        ->where('status', 'tersedia')
        ->findAll();

    return view('kasir/transaksi/tambah', [
        'kendaraan' => $kendaraan
    ]);
}


public function simpanTransaksi()
{
    $kendaraanModel = new \App\Models\KendaraanModel();
    $pelangganModel = new \App\Models\PelangganModel();

    // ================= INPUT =================
    $id_kendaraan = $this->request->getPost('id_kendaraan');
    $nama         = $this->request->getPost('nama_pelanggan');
    $no_hp        = $this->request->getPost('no_hp');
    $alamat       = $this->request->getPost('alamat');
    $nik          = $this->request->getPost('nik');

    // ================= VALIDASI NIK =================
    if (empty($nik)) {
        return redirect()->back()->with('error', 'NIK wajib diisi');
    }

    if (!preg_match('/^[0-9]{16}$/', $nik)) {
        return redirect()->back()->with('error', 'NIK harus 16 digit angka!');
    }

    // ================= TANGGAL =================
    $tgl_sewa    = $this->request->getPost('tgl_sewa');
    $tgl_kembali = $this->request->getPost('tgl_kembali');

    // ================= UPLOAD KTP =================
$fileKtp = $this->request->getFile('foto_ktp');
$namaFileKtp = null;

if ($fileKtp && $fileKtp->isValid() && !$fileKtp->hasMoved()) {
    $namaFileKtp = $fileKtp->getRandomName();
    $fileKtp->move(FCPATH . 'uploads/ktp', $namaFileKtp);
} else {
    return redirect()->back()->with('error', 'Upload KTP gagal');
}

// ================= UPLOAD SIM =================
$fileSim = $this->request->getFile('foto_sim');
$namaFileSim = null;

if ($fileSim && $fileSim->isValid() && !$fileSim->hasMoved()) {
    $namaFileSim = $fileSim->getRandomName();
    $fileSim->move(FCPATH . 'uploads/sim', $namaFileSim);
} else {
    return redirect()->back()->with('error', 'Upload SIM gagal');
}

    
    $start = new \DateTime($tgl_sewa);
    $end   = new \DateTime($tgl_kembali);

    $lama_sewa = $start->diff($end)->days;
    if ($lama_sewa <= 0) $lama_sewa = 1;

    
    $pelangganModel->insert([
        'nama'     => $nama,
        'no_hp'    => $no_hp,
        'alamat'   => $alamat,
        'nik'      => $nik,
        'foto_ktp' => $namaFileKtp,
        'foto_sim' => $namaFileSim
    ]);

    $id_pelanggan = $pelangganModel->insertID();

    
    $kendaraan = $kendaraanModel->find($id_kendaraan);
    $harga     = $kendaraan['harga_sewa'];

    $total = $harga * $lama_sewa;

    
    session()->set('transaksi_temp', [
        'id_kendaraan' => $id_kendaraan,
        'id_pelanggan' => $id_pelanggan,
        'tgl_sewa'     => $tgl_sewa,
        'tgl_kembali'  => $tgl_kembali,
        'lama_sewa'    => $lama_sewa,
        'total_bayar'  => $total
    ]);

    return redirect()->to('/kasir/transaksi/pembayaran');
}



public function pembayaran()
{
    $data = session()->get('transaksi_temp');

    if (!$data) {
        return redirect()->to('/kasir/transaksi');
    }

    return view('kasir/transaksi/pembayaran', [
        'total' => $data['total_bayar']
    ]);
}


public function prosesPembayaran()
{
    $transaksiModel = new \App\Models\TransaksiModel();
    $kendaraanModel = new \App\Models\KendaraanModel();

    $data = session()->get('transaksi_temp');

    if (!$data) {
        return $this->response->setJSON(['status' => 'error']);
    }

    $uang = (int)$this->request->getPost('uang');
    $total = $data['total_bayar'];

    if ($uang <= 0) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Uang harus lebih dari 0'
        ]);
    }

    // LOGIC
    if ($uang < $total) {
        $status = 'DP';
        $dp = $uang;
    } else {
        $status = 'Lunas';
        $dp = $uang;
    }

    $sisa = max(0, $total - $dp);
    $kembalian = max(0, $uang - $total);

    // SIMPAN
    $transaksiModel->insert([
        'id_user' => session()->get('id_user'),
        'id_pelanggan' => $data['id_pelanggan'],
        'id_kendaraan' => $data['id_kendaraan'],
        'tgl_sewa' => $data['tgl_sewa'],
        'tgl_kembali_rencana' => $data['tgl_kembali'],
        'lama_sewa' => $data['lama_sewa'],
        'total_bayar' => $total,
        'dp' => $dp,
        'sisa_bayar' => $sisa,
        'status_bayar' => $status,
        'status_sewa' => 'Berlangsung'
    ]);

    $idTransaksi = $transaksiModel->insertID();

    $kendaraanModel->update($data['id_kendaraan'], [
        'status' => 'disewa'
    ]);

    session()->remove('transaksi_temp');

    return $this->response->setJSON([
        'status' => 'success',
        'tipe' => $status,
        'id' => $idTransaksi,
        'kembalian' => $kembalian
    ]);
}

public function detail($id)
{
    $db = \Config\Database::connect();

    $transaksi = $db->table('transaksi t')
        ->select('
            t.*, 
            p.nama AS nama_pelanggan,
            p.nik AS nik_pelanggan,
            p.foto_ktp AS foto_ktp_pelanggan,
            p.foto_sim AS foto_sim_pelanggan,
            p.no_hp,
            p.alamat,
            k.nama_kendaraan
        ')
        ->join('pelanggan p', 'p.id_pelanggan = t.id_pelanggan')
        ->join('kendaraan k', 'k.id_kendaraan = t.id_kendaraan')
        ->where('t.id_transaksi', $id)
        ->get()
        ->getRowArray();

    return view('kasir/transaksi/detail', [
        't' => $transaksi
    ]);
}

public function bayarSisa($id)
{     
    $transaksiModel = new \App\Models\TransaksiModel();

    $transaksi = $transaksiModel->find($id);

    $bayar = (int)$this->request->getPost('bayar');
    $sisa_lama = $transaksi['sisa_bayar'];

    if ($bayar <= 0) {
        return redirect()->back()->with('error', 'Masukkan uang!');
    }

    if ($bayar < $sisa_lama) {
        $status = 'DP';
        $sisa_baru = $sisa_lama - $bayar;
    } else {
        $status = 'Lunas';
        $sisa_baru = 0;
    }

    $transaksiModel->update($id, [
        'dp' => $transaksi['dp'] + $bayar,
        'sisa_bayar' => $sisa_baru,
        'status_bayar' => $status
    ]);

    helper('log');
    log_activity('Bayar sisa transaksi ID: ' . $id);

    return redirect()->to('/kasir/transaksi')
        ->with('success', 'Pembayaran berhasil diperbarui');
}

public function struk($id)
{
    $db = \Config\Database::connect();

    $transaksi = $db->table('transaksi t')
        ->select('t.*, p.nama, k.nama_kendaraan')
        ->join('pelanggan p', 'p.id_pelanggan = t.id_pelanggan')
        ->join('kendaraan k', 'k.id_kendaraan = t.id_kendaraan')
        ->where('t.id_transaksi', $id)
        ->get()
        ->getRowArray();

    
    $html = view('kasir/transaksi/struk_pdf', [
        't' => $transaksi
    ]);

    
    $dompdf = new \Dompdf\Dompdf();

    $dompdf->loadHtml($html);

    
    $dompdf->setPaper([0, 0, 226.77, 600], 'portrait');

    $dompdf->render();

    
    $dompdf->stream("struk_rental.pdf", ["Attachment" => false]);
}

public function kembalikan($id)
{
    $transaksiModel = new \App\Models\TransaksiModel();
    $kendaraanModel = new \App\Models\KendaraanModel();

    $transaksi = $transaksiModel->find($id);

    if (!$transaksi) {
        return redirect()->back()->with('error', 'Transaksi tidak ditemukan');
    }

    
    if ($transaksi['status_bayar'] != 'Lunas') {
        return redirect()->back()->with('error', 'Transaksi belum lunas!');
    }

    $tgl_kembali_real = date('Y-m-d');
    $tgl_rencana = $transaksi['tgl_kembali_rencana'];

    
    $start = new \DateTime($tgl_rencana);
    $end   = new \DateTime($tgl_kembali_real);

    $telat = 0;
    if ($tgl_kembali_real > $tgl_rencana) {
        $telat = $start->diff($end)->days;
    }

    
    $denda_per_hari = 100000;
    $denda = $telat * $denda_per_hari;

    
    $transaksiModel->update($id, [
        'tgl_kembali' => $tgl_kembali_real,
        'status_sewa' => 'Selesai',
        'denda' => $denda
    ]);

   
    $kendaraanModel->update($transaksi['id_kendaraan'], [
        'status' => 'tersedia'
    ]);

    return redirect()->to('/kasir/transaksi')
        ->with('success', 
            'Kendaraan berhasil dikembalikan | Denda: Rp '.number_format($denda)
        );
}

public function formKembalikan($id)
{
    $db = \Config\Database::connect();

    $transaksi = $db->table('transaksi t')
        ->select('t.*, p.nama, k.nama_kendaraan')
        ->join('pelanggan p', 'p.id_pelanggan = t.id_pelanggan')
        ->join('kendaraan k', 'k.id_kendaraan = t.id_kendaraan')
        ->where('t.id_transaksi', $id)
        ->get()
        ->getRowArray();

    if (!$transaksi) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    // HITUNG TELAT
    $today = date('Y-m-d');

$rencana = $transaksi['tgl_kembali_rencana'];

$telat = 0;

if ($today > $rencana) {
    $start = new \DateTime($rencana);
    $end   = new \DateTime($today);

    $telat = $start->diff($end)->days;
}

$denda = $telat * 100000;

    return view('kasir/transaksi/kembalikan', [
        't' => $transaksi,
        'telat' => $telat,
        'denda' => $denda
    ]);
}


public function prosesKembalikan($id)
{
    $transaksiModel = new \App\Models\TransaksiModel();
    $kendaraanModel = new \App\Models\KendaraanModel();

    $transaksi = $transaksiModel->find($id);

    if (!$transaksi) {
        return redirect()->back()->with('error', 'Data tidak ditemukan');
    }

    if ($transaksi['status_sewa'] == 'Selesai') {
        return redirect()->back()->with('error', 'Sudah dikembalikan!');
    }

    if ($transaksi['status_bayar'] != 'Lunas') {
        return redirect()->back()->with('error', 'Belum lunas!');
    }

    $today = date('Y-m-d');
    if ($today < $transaksi['tgl_kembali_rencana']) {
    return redirect()->back()->with('error', 'Belum bisa dikembalikan! Tanggal kembali rencana: ' . $transaksi['tgl_kembali_rencana']);
    }

    $tgl_kembali = date('Y-m-d');
    $rencana = $transaksi['tgl_kembali_rencana'];

    
    $telat = 0;
    if ($tgl_kembali > $rencana) {
        $start = new \DateTime($rencana);
        $end   = new \DateTime($tgl_kembali);
        $telat = $start->diff($end)->days;
    }

    $denda = $telat * 100000;

    $bayar = (int)$this->request->getPost('bayar_denda');

    if ($denda > 0) {
        if ($bayar <= 0) {
            return redirect()->back()->with('error', 'Harus bayar denda!');
        }

        if ($bayar < $denda) {
            return redirect()->back()->with('error', 'Denda belum lunas!');
        }
    }

    $kembalian = 0;
    if ($bayar > $denda) {
        $kembalian = $bayar - $denda;
    }

    // UPDATE TRANSAKSI
    $transaksiModel->update($id, [
        'tgl_kembali' => $tgl_kembali,
        'status_sewa' => 'Selesai',
        'denda' => $denda
    ]);

    helper('log');
    log_activity('Pengembalian kendaraan transaksi ID: ' . $id);

    // UPDATE KENDARAAN
    $kendaraanModel->update($transaksi['id_kendaraan'], [
        'status' => 'tersedia'
    ]);

    return redirect()->to('/kasir/transaksi')
        ->with('success', 
            'Pengembalian berhasil | Denda: Rp '.number_format($denda).
            ' | Kembalian: Rp '.number_format($kembalian)
        );
}

public function batalPembayaran()
{
     helper('log');
     log_activity('Membatalkan transaksi');

    session()->remove('transaksi_temp');

    return redirect()->to('/kasir/transaksi')
        ->with('success', 'Transaksi dibatalkan');
}


private function autoUpdateStatus()
{
    $transaksiModel = new \App\Models\TransaksiModel();

    $today = date('Y-m-d');

    // Ambil transaksi yang masih berlangsung
    $transaksi = $transaksiModel
        ->whereIn('status_sewa', ['Berlangsung', 'Terlambat'])
        ->findAll();

    foreach ($transaksi as $t) {

    if ($today > $t['tgl_kembali_rencana'] && $t['status_sewa'] != 'Selesai') {

        $transaksiModel->update($t['id_transaksi'], [
            'status_sewa' => 'Terlambat'
        ]);
    }
}
}

}