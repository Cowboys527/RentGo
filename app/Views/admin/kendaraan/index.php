<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/kendaraan/index.css') ?>">

<div class="kendaraan-container">

<div class="page-header">
    <div class="header-left">
        <h2 class="page-title">Data Kendaraan</h2>
        <p class="page-subtitle">Kelola data kendaraan rental</p>
    </div>
    <a href="/admin/kendaraan/tambah" class="btn-add">
        <span>Tambah Kendaraan</span>
    </a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert-success">
        <span><?= session()->getFlashdata('success') ?></span>
    </div>
<?php endif; ?>

<!-- SEARCH & FILTER BAR -->
<div class="filter-bar">
    <!-- SEARCH -->
    <form method="get" action="/admin/kendaraan" class="search-form">
        <div class="search-box">
            <input type="text" 
                   name="keyword" 
                   class="search-input"
                   placeholder="Cari nama / plat nomor..."
                   value="<?= $keyword ?? '' ?>">
            <button type="submit" class="btn-search">Search</button>
            <a href="/admin/kendaraan" class="btn-reset">Reset</a>
        </div>
    </form>

    <!-- FILTER -->
    <form method="get" action="/admin/kendaraan" class="filter-form">
        <select name="jenis" class="filter-select">
            <option value="">-- Semua Jenis --</option>
            <option value="SUV" <?= ($jenis=='SUV')?'selected':'' ?>>SUV</option>
            <option value="Sedan" <?= ($jenis=='Sedan')?'selected':'' ?>>Sedan</option>
            <option value="MPV" <?= ($jenis=='MPV')?'selected':'' ?>>MPV</option>
            <option value="Sports Car" <?= ($jenis=='Sport Car')?'selected':'' ?>>Sports Car</option>
        </select>

        <select name="status" class="filter-select">
            <option value="">-- Semua Status --</option>
            <option value="Tersedia" <?= ($status=='Tersedia')?'selected':'' ?>>Tersedia</option>
            <option value="Disewa" <?= ($status=='Disewa')?'selected':'' ?>>Disewa</option>
        </select>

        <button type="submit" class="btn-filter">Filter</button>
    </form>
</div>

<!-- TABLE CARD -->
<div class="table-card">
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kendaraan</th>
                <th>Jenis</th>
                <th>Plat Nomor</th>
                <th>Harga Sewa</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 + (5 * ($pager->getCurrentPage() - 1)); ?>
            <?php foreach ($kendaraan as $k): ?>
            <tr>
                <td><span class="table-no"><?= $no++ ?></span></td>
                <td class="td-bold"><?= $k['nama_kendaraan'] ?></td>
                <td><?= $k['jenis'] ?></td>
                <td><span class="plat-badge"><?= $k['plat_nomor'] ?></span></td>
                <td class="td-price">Rp <?= number_format($k['harga_sewa']) ?></td>
                <td>
                    <?php if ($k['status'] == 'Tersedia'): ?>
                        <span class="status-badge status-tersedia">Tersedia</span>
                    <?php else: ?>
                        <span class="status-badge status-disewa">Disewa</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="/admin/kendaraan/edit/<?= $k['id_kendaraan'] ?>" class="btn-action btn-edit">Edit</a>
                        <a href="/admin/kendaraan/hapus/<?= $k['id_kendaraan'] ?>" 
                           class="btn-action btn-delete"
                           onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>

            <?php if (empty($kendaraan)): ?>
            <tr>
                <td colspan="7" class="empty-state">Belum ada data kendaraan</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- PAGINATION -->
<div class="pagination-wrapper">
    <?= $pager->links() ?>
</div>

</div>

<?= $this->endSection() ?>