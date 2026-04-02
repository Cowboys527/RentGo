<?= $this->extend('layouts/kasir_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/dashboard_kasir.css') ?>">

<!-- Header -->
<div class="dashboard-header">
    <h1 class="dashboard-title">Dashboard Kasir</h1>
    <p class="dashboard-subtitle">Ringkasan Transaksi Hari Ini</p>
</div>

<!-- KPI Cards Grid -->
<div class="kpi-grid">

    <!-- Card 1: Transaksi Hari Ini -->
    <div class="kpi-card">
        <div class="kpi-icon kpi-icon-blue">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/>
            </svg>
        </div>
        <div class="kpi-content">
            <div class="kpi-value"><?= $transaksiHariIni ?></div>
            <div class="kpi-label">Transaksi Hari Ini</div>
        </div>
    </div>

    <!-- Card 2: Kendaraan Tersedia -->
    <div class="kpi-card">
        <div class="kpi-icon kpi-icon-green">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
            </svg>
        </div>
        <div class="kpi-content">
            <div class="kpi-value kpi-value-green"><?= $kendaraanTersedia ?></div>
            <div class="kpi-label">Kendaraan Tersedia</div>
        </div>
    </div>

    <!-- Card 3: Kendaraan Disewa -->
    <div class="kpi-card">
        <div class="kpi-icon kpi-icon-orange">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
            </svg>
        </div>
        <div class="kpi-content">
            <div class="kpi-value kpi-value-orange"><?= $kendaraanDisewa ?></div>
            <div class="kpi-label">Kendaraan Disewa</div>
        </div>
    </div>

</div>

<!-- Tabel Transaksi Hari Ini -->
<div class="table-section">
    <div class="table-header">
        <h3 class="table-title">Daftar Transaksi Hari Ini</h3>
        <p class="table-subtitle">Data transaksi yang masuk hari ini</p>
    </div>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>PELANGGAN</th>
                    <th>KENDARAAN</th>
                    <th>STATUS</th>
                    <th>TANGGAL</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($daftarTransaksi)) : ?>
                    <?php foreach ($daftarTransaksi as $t) : ?>
                        <tr>
                            <td><span class="badge-id"><?= $t['id_transaksi'] ?></span></td>
                            <td><?= $t['nama_pelanggan'] ?></td>
                            <td><?= $t['nama_kendaraan'] ?></td>
                            <td>
                                <?php $status = strtolower($t['status_sewa']); ?>
                                <span class="status-badge <?= $status == 'selesai' ? 'status-lunas' : 'status-disewa' ?>">
                                <?= ucfirst($t['status_sewa']) ?>
                                </span>
                            </td>
                            <td><?= date('d M Y', strtotime($t['tgl_sewa'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="empty-state">Belum ada transaksi hari ini</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>