<?= $this->extend('layouts/kasir_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/transaksi/index.css') ?>">


<div class="page-header">
    <div class="page-header-left">
        <h2 class="page-title">Daftar Transaksi</h2>
        <p class="page-subtitle">Kelola semua transaksi rental kendaraan</p>
    </div>
    <a href="<?= base_url('kasir/transaksi/tambah') ?>" class="btn-tambah">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/></svg>
        Buat Transaksi
    </a>
</div>


<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>


<form method="get" class="filter-bar">

    
    <div class="search-wrapper">
        <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <input type="text" name="keyword" placeholder="Cari pelanggan..."
            value="<?= $_GET['keyword'] ?? '' ?>"
            class="filter-input filter-search">
    </div>

    
    <select name="status_bayar" class="filter-select">
        <option value="">-- Status Bayar --</option>
        <option value="DP" <?= (($_GET['status_bayar'] ?? '')=='DP')?'selected':'' ?>>DP</option>
        <option value="Lunas" <?= (($_GET['status_bayar'] ?? '')=='Lunas')?'selected':'' ?>>Lunas</option>
    </select>

    
    <select name="status_sewa" class="filter-select">
        <option value="">-- Status Sewa --</option>
        <option value="Berlangsung" <?= (($_GET['status_sewa'] ?? '')=='Berlangsung')?'selected':'' ?>>Berlangsung</option>
        <option value="Selesai" <?= (($_GET['status_sewa'] ?? '')=='Selesai')?'selected':'' ?>>Selesai</option>
        <option value="Terlambat" <?= (($_GET['status_sewa'] ?? '')=='Terlambat')?'selected':'' ?>>Terlambat</option>
    </select>

    
    <button type="submit" class="btn-filter">Filter</button>

    <a href="<?= base_url('kasir/transaksi') ?>">
        <button type="button" class="btn-reset">Reset</button>
    </a>

</form>


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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

        <?php if(empty($transaksi)): ?>
        <tr>
            <td colspan="11" class="empty-state">Data tidak ditemukan</td>
        </tr>
        <?php endif; ?>

        <?php foreach ($transaksi as $t): ?>
        <tr>
            <td><span class="badge-id"><?= $t['id_transaksi'] ?></span></td>
            <td><?= esc($t['nama_pelanggan']) ?></td>
            <td><?= esc($t['nama_kendaraan']) ?></td>
            <td><?= $t['tgl_sewa'] ?></td>
            <td><?= $t['lama_sewa'] ?> hari</td>
            <td>Rp <?= number_format($t['total_bayar']) ?></td>
            <td>Rp <?= number_format($t['sisa_bayar']) ?></td>
            <td>Rp <?= number_format($t['denda'] ?? 0) ?></td>

            <td>
                <span class="status-badge <?= $t['status_bayar']=='Lunas' ? 'badge-lunas' : 'badge-dp' ?>">
                    <?= $t['status_bayar'] ?>
                </span>
            </td>

            
            <td>
    <span class="status-badge 
        <?= 
        $t['status_sewa']=='Selesai' ? 'badge-selesai' : 
        ($t['status_sewa']=='Terlambat' ? 'badge-telat' : 'badge-berlangsung') 
        ?>">
        <?= $t['status_sewa'] ?>
    </span>
</td>

            
<td class="aksi-cell">
    <a href="<?= base_url('kasir/transaksi/detail/'.$t['id_transaksi']) ?>" class="btn-aksi btn-detail">
        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
        Detail
    </a>

    <?php if($t['status_sewa'] == 'Berlangsung' || $t['status_sewa'] == 'Terlambat'): ?>

        <?php if($t['status_bayar'] == 'Lunas'): ?>
            <a href="<?= base_url('kasir/transaksi/kembalikan/'.$t['id_transaksi']) ?>" class="btn-aksi btn-kembalikan">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12.5 8c-2.65 0-5.05.99-6.9 2.6L2 7v9h9l-3.62-3.62c1.39-1.16 3.16-1.88 5.12-1.88 3.54 0 6.55 2.31 7.6 5.5l2.37-.78C21.08 11.03 17.15 8 12.5 8z"/></svg>
                Kembalikan
            </a>
        <?php else: ?>
            <span class="badge-belum-lunas">Belum Lunas</span>
        <?php endif; ?>

    <?php elseif($t['status_sewa'] == 'Selesai'): ?>
        <span class="badge-done">✓ Selesai</span>
    <?php endif; ?>
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