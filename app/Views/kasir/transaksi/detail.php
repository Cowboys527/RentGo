<?= $this->extend('layouts/kasir_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/transaksi/detail.css') ?>">

<div class="page-header">
    <h2 class="page-title">Detail Transaksi</h2>
    <p class="page-subtitle">Informasi lengkap transaksi sewa kendaraan</p>
</div>

<div class="detail-wrapper">

    <!-- ================= DATA PELANGGAN ================= -->
    <div class="form-section">
        <div class="section-title">
            <div class="section-icon section-icon-blue">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                </svg>
            </div>
            <h3>Data Pelanggan</h3>
        </div>

        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Nama</span>
                <span class="info-value"><?= $t['nama_pelanggan'] ?></span>
            </div>

            <div class="info-row">
    <span class="info-label">No HP</span>
    <span class="info-value"><?= $t['no_hp'] ?></span>
</div>

<div class="info-row">
    <span class="info-label">Alamat</span>
    <span class="info-value"><?= $t['alamat'] ?></span>
</div>

            <div class="info-row">
                <span class="info-label">NIK</span>
                <span class="info-value"><?= $t['nik_pelanggan'] ?? '-' ?></span>
            </div>
        </div>

        
       <div style="display:flex; gap:20px; margin-top:20px; flex-wrap:wrap;">

    <div style="flex:1; min-width:200px;">
        <span class="info-label">Foto KTP</span><br>
        <?php if (!empty($t['foto_ktp_pelanggan'])): ?>
            <img 
                src="<?= base_url('uploads/ktp/'.$t['foto_ktp_pelanggan']) ?>" 
                alt="Foto KTP"
                style="width:100%; border-radius:10px; margin-top:10px;"
            >
        <?php else: ?>
            <p style="color:gray;">Tidak ada foto KTP</p>
        <?php endif; ?>
    </div>

    <div style="flex:1; min-width:200px;">
        <span class="info-label">Foto SIM</span><br>
        <?php if (!empty($t['foto_sim_pelanggan'])): ?>
            <img 
                src="<?= base_url('uploads/sim/'.$t['foto_sim_pelanggan']) ?>" 
                alt="Foto SIM"
                style="width:100%; border-radius:10px; margin-top:10px;"
            >
        <?php else: ?>
            <p style="color:gray;">Tidak ada foto SIM</p>
        <?php endif; ?>
    </div>

   </div>


    <!-- ================= DATA TRANSAKSI ================= -->
    <div class="form-section">
        <div class="section-title">
            <div class="section-icon section-icon-blue">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M14 2H6c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V8l-6-6z"/>
                </svg>
            </div>
            <h3>Informasi Transaksi</h3>
        </div>

        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Pelanggan</span>
                <span class="info-value"><?= $t['nama_pelanggan'] ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Kendaraan</span>
                <span class="info-value"><?= $t['nama_kendaraan'] ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Total Bayar</span>
                <span class="info-value info-value-strong">Rp <?= number_format($t['total_bayar']) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">DP</span>
                <span class="info-value">Rp <?= number_format($t['dp']) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Sisa</span>
                <span class="info-value info-value-sisa">Rp <?= number_format($t['sisa_bayar']) ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Status</span>
                <span class="status-badge <?= $t['status_bayar'] == 'Lunas' ? 'badge-lunas' : ($t['status_bayar'] == 'DP' ? 'badge-dp' : 'badge-belum') ?>">
                    <?= $t['status_bayar'] ?>
                </span>
            </div>
        </div>
    </div>


    <!-- ================= BAYAR ================= -->
    <?php if($t['status_bayar'] != 'Lunas'): ?>

    <div class="form-section">
        <div class="section-title">
            <h3>Bayar Sisa</h3>
        </div>

        <form method="post" action="<?= base_url('kasir/transaksi/bayar-sisa/'.$t['id_transaksi']) ?>">

            <div class="form-group">
                <label class="form-label">Jumlah Pembayaran</label>
                <input type="number" name="bayar" class="form-input" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">Bayar</button>
            </div>

        </form>
    </div>

    <?php else: ?>

    <div class="form-section">
        <h3>Status Pembayaran</h3>

        <div class="lunas-box">
            <span>Transaksi ini sudah Lunas</span>
        </div>

        <div class="form-actions" style="margin-top: 20px;">
            <a href="<?= base_url('kasir/transaksi/struk/'.$t['id_transaksi']) ?>" target="_blank">
                <button type="button" class="btn-struk">Cetak Struk</button>
            </a>
        </div>
    </div>

    <?php endif; ?>

    <!-- ================= BACK ================= -->
    <div class="back-action">
        <a href="<?= base_url('kasir/transaksi') ?>">
            <button type="button" class="btn-back">Kembali</button>
        </a>
    </div>

</div>

<?= $this->endSection() ?>