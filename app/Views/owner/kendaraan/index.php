<?= $this->extend('layouts/owner_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/kendaraan/index.css') ?>">

<div class="kendaraan-container">
    <div class="page-header">
        <div class="header-left">
            <h2 class="page-title">Data Produk Kendaraan</h2>
            <p class="page-subtitle">Monitoring ketersediaan unit kendaraan</p>
        </div>
    </div>

    <div class="filter-bar">
        <form method="get" action="/owner/kendaraan" class="search-form">
            <div class="search-box">
                <input type="text" name="keyword" class="search-input" placeholder="Cari nama / plat nomor..." value="<?= $keyword ?? '' ?>">
                <button type="submit" class="btn-search">Search</button>
            </div>
        </form>
    </div>

    <div class="cards-grid">
        <?php foreach ($kendaraan as $k): ?>
        <div class="vehicle-card">
            <div class="card-image">
                <?php if (!empty($k['foto'])): ?>
                    <img src="<?= base_url('uploads/kendaraan/'.$k['foto']) ?>" alt="<?= esc($k['nama_kendaraan']) ?>">
                <?php else: ?>
                    <div class="no-image-placeholder">No Image</div>
                <?php endif; ?>
                
                <span class="status-overlay <?= ($k['status'] == 'tersedia') ? 'status-tersedia' : 'status-disewa' ?>">
                    <?= ucfirst($k['status']) ?>
                </span>
            </div>

            <div class="card-body">
                <h3 class="vehicle-name"><?= esc($k['nama_kendaraan']) ?></h3>
                <div class="vehicle-details">
                    <div class="detail-item"><span class="detail-label">Jenis:</span> <span class="detail-value"><?= esc($k['jenis']) ?></span></div>
                    <div class="detail-item"><span class="detail-label">Plat:</span> <span class="plat-badge"><?= esc($k['plat_nomor']) ?></span></div>
                    <div class="detail-item price-item"><span class="detail-label">Harga Sewa:</span> <span class="vehicle-price">Rp <?= number_format($k['harga_sewa']) ?></span></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="pagination-wrapper">
    <?= $pager->links() ?>
</div>

</div>
<?= $this->endSection() ?>