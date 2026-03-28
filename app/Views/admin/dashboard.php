<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/dashboard_admin.css') ?>">

<!-- Header -->
<div class="dashboard-header">
    <h1 class="dashboard-title">Dashboard Admin</h1>
    <p class="dashboard-subtitle">Selamat datang di sistem Rental Kendaraan</p>
</div>

<!-- KPI Cards Grid -->
<div class="kpi-grid">
    
    <!-- Card 1: Total Kendaraan -->
    <div class="kpi-card">
        <div class="kpi-icon kpi-icon-blue">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/>
            </svg>
        </div>
        <div class="kpi-content">
            <div class="kpi-value"><?= $totalKendaraan ?></div>
            <div class="kpi-label">Total Kendaraan</div>
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
            <div class="kpi-value kpi-value-green"><?= $tersedia ?></div>
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
            <div class="kpi-value kpi-value-orange"><?= $disewa ?></div>
            <div class="kpi-label">Kendaraan Disewa</div>
        </div>
    </div>

    <!-- Card 4: Total User -->
    <div class="kpi-card">
        <div class="kpi-icon kpi-icon-purple">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
            </svg>
        </div>
        <div class="kpi-content">
            <div class="kpi-value kpi-value-purple"><?= $totalUser ?></div>
            <div class="kpi-label">Total User</div>
        </div>
    </div>

</div>

<!-- Transaksi Terbaru Section -->
<div class="table-section">
    <div class="table-header">
        <h3 class="table-title">Transaksi Terbaru</h3>
        <p class="table-subtitle">Data transaksi hari ini</p>
    </div>

    <div class="table-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>KENDARAAN</th>
                    <th>USER</th>
                    <th>STATUS</th>
                    <th>TANGGAL</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($transaksiHariIni)) : ?>
                    <?php foreach ($transaksiHariIni as $t) : ?>
                        <tr>
                            <td><span class="badge-id"><?= $t['id_transaksi'] ?></span></td>
                            <td><?= $t['nama_kendaraan'] ?></td>
                            <td><?= $t['nama_user'] ?></td>
                            <td>
    <?php $status = strtolower($t['status_kendaraan']); ?>

    <span class="status-badge <?= $status == 'tersedia' ? 'status-lunas' : 'status-disewa' ?>">
        <?= ucfirst($t['status_kendaraan']) ?>
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