<?= $this->extend('layouts/owner_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/laporan/index.css') ?>">

<!-- Header -->
<div class="page-header">
    <h2 class="page-title">Laporan Transaksi</h2>
    <p class="page-subtitle">Laporan transaksi harian, bulanan, dan tahunan</p>
</div>

<!-- FILTER -->
<form method="get" class="filter-bar">

    <select name="filter" class="filter-select">
        <option value="">-- Pilih Filter --</option>
        <option value="harian" <?= (($_GET['filter'] ?? '')=='harian')?'selected':'' ?>>Harian</option>
        <option value="bulanan" <?= (($_GET['filter'] ?? '')=='bulanan')?'selected':'' ?>>Bulanan</option>
        <option value="tahunan" <?= (($_GET['filter'] ?? '')=='tahunan')?'selected':'' ?>>Tahunan</option>
    </select>

    <input type="date" name="dari" value="<?= $_GET['dari'] ?? '' ?>" class="filter-input">
    <input type="date" name="sampai" value="<?= $_GET['sampai'] ?? '' ?>" class="filter-input">

    <button type="submit" class="btn-filter">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M10 18h4v-2h-4v2zM3 6v2h18V6H3zm3 7h12v-2H6v2z"/></svg>
        Filter
    </button>

    <a href="<?= base_url('owner/laporan') ?>" style="text-decoration:none;">
        <button type="button" class="btn-reset">Reset</button>
    </a>

    <a href="<?= base_url('owner/laporan/export?' . http_build_query($_GET)) ?>" style="text-decoration:none;">
        <button type="button" class="btn-export">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M19 9h-4V3H9v6H5l7 7 7-7zM5 18v2h14v-2H5z"/></svg>
            Download PDF
        </button>
    </a>

</form>

<div class="summary-grid">

    <div class="summary-card">
        <div class="summary-label">Total Transaksi</div>
        <div class="summary-value summary-value-blue"><?= $totalTransaksi ?></div>
    </div>

    <div class="summary-card">
        <div class="summary-label">Total Pendapatan</div>
        <div class="summary-value summary-value-green">Rp <?= number_format($totalPendapatan) ?></div>
    </div>

    <div class="summary-card">
        <div class="summary-label">Jenis Unit Kendaraan Yang Pernah Disewa</div>
        <div class="summary-value summary-value-orange"><?= $kendaraanDisewa ?> Unit</div>
    </div>

</div>

<div class="table-card">
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Kendaraan</th>
                <th>Tgl Sewa</th>
                <th>Lama</th>
                <th>Total</th>
                <th>Sisa</th>
                <th>Denda</th>
                <th>Status Bayar</th>
                <th>Status Sewa</th>
            </tr>
        </thead>

        <tbody>

        <?php if(empty($transaksi)): ?>
            <tr>
                <td colspan="10" class="empty-state">Tidak ada data</td>
            </tr>
        <?php endif; ?>

        <?php foreach($transaksi as $t): ?>
            <tr>
                <td><span class="badge-id"><?= $t['id_transaksi'] ?></span></td>
                <td><?= $t['nama_pelanggan'] ?></td>
                <td><?= $t['nama_kendaraan'] ?></td>
                <td><?= $t['tgl_sewa'] ?></td>
                <td><?= $t['lama_sewa'] ?> hari</td>
                <td>Rp <?= number_format($t['total_bayar']) ?></td>
                <td>Rp <?= number_format($t['sisa_bayar']) ?></td>
                <td>Rp <?= number_format($t['denda'] ?? 0) ?></td>
                <td>
                    <span class="status-badge <?= $t['status_bayar']=='Lunas' ? 'badge-lunas' : ($t['status_bayar']=='DP' ? 'badge-dp' : 'badge-belum') ?>">
                        <?= $t['status_bayar'] ?>
                    </span>
                </td>
                <td>
                    <span class="status-badge <?= $t['status_sewa']=='Selesai' ? 'badge-selesai' : ($t['status_sewa']=='Terlambat' ? 'badge-telat' : 'badge-berlangsung') ?>">
                        <?= $t['status_sewa'] ?>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>

<div class="pager-wrapper">
    <?= $pager->links() ?>
</div>

<?= $this->endSection() ?>