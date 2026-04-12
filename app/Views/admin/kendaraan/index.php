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

<div class="filter-bar">
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

    <form method="get" action="/admin/kendaraan" class="filter-form">
        <select name="jenis" class="filter-select">
            <option value="">-- Semua Jenis --</option>
            <option value="SUV" <?= ($jenis=='SUV')?'selected':'' ?>>SUV</option>
            <option value="Sedan" <?= ($jenis=='Sedan')?'selected':'' ?>>Sedan</option>
            <option value="MPV" <?= ($jenis=='MPV')?'selected':'' ?>>MPV</option>
            <option value="Sports Car" <?= ($jenis=='Sports Car')?'selected':'' ?>>Sports Car</option>
        </select>

        <select name="status" class="filter-select">
            <option value="">-- Semua Status --</option>
            <option value="tersedia" <?= ($status=='tersedia')?'selected':'' ?>>Tersedia</option>
            <option value="disewa" <?= ($status=='disewa')?'selected':'' ?>>Disewa</option>
        </select>

        <button type="submit" class="btn-filter">Filter</button>
    </form>
</div>

<div class="cards-grid">
    <?php foreach ($kendaraan as $k): ?>
    <div class="vehicle-card">
        <!-- Foto -->
        <div class="card-image">
            <?php if (!empty($k['foto'])): ?>
                <img src="<?= base_url('uploads/kendaraan/'.$k['foto']) ?>" alt="<?= esc($k['nama_kendaraan']) ?>">
            <?php else: ?>
                <div class="no-image-placeholder">No Image</div>
            <?php endif; ?>
            
            <!-- Status Badge di atas foto -->
            <?php if ($k['status'] == 'tersedia'): ?>
                <span class="status-overlay status-tersedia">Tersedia</span>
            <?php else: ?>
                <span class="status-overlay status-disewa">Disewa</span>
            <?php endif; ?>
        </div>

        <!-- Info Kendaraan -->
        <div class="card-body">
            <h3 class="vehicle-name"><?= esc($k['nama_kendaraan']) ?></h3>
            
            <div class="vehicle-details">
                <div class="detail-item">
                    <span class="detail-label">Jenis:</span>
                    <span class="detail-value"><?= esc($k['jenis']) ?></span>
                </div>
                
                <div class="detail-item">
                    <span class="detail-label">Plat:</span>
                    <span class="plat-badge"><?= esc($k['plat_nomor']) ?></span>
                </div>
                
                <div class="detail-item price-item">
                    <span class="detail-label">Harga Sewa:</span>
                    <span class="vehicle-price">Rp <?= number_format($k['harga_sewa']) ?></span>
                </div>
            </div>

            
            <div class="card-actions">
                <a href="/admin/kendaraan/edit/<?= $k['id_kendaraan'] ?>" 
                   class="btn-card btn-edit-card">Edit</a>
                <a href="/admin/kendaraan/hapus/<?= $k['id_kendaraan'] ?>" 
                   class="btn-card btn-delete-card"
                   onclick="return confirm('Yakin mau hapus?')">Hapus</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>

    <?php if (empty($kendaraan)): ?>
    <div class="empty-state-card">
        <p>Belum ada data kendaraan</p>
    </div>
    <?php endif; ?>
</div>


<div class="pagination-wrapper">
    <?= $pager->links() ?>
</div>

</div>

<?= $this->endSection() ?>