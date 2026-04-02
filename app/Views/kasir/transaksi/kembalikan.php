<?= $this->extend('layouts/kasir_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/transaksi/kembalikan.css') ?>">


<div class="page-header">
    <h2 class="page-title">Pengembalian Kendaraan</h2>
    <p class="page-subtitle">Proses pengembalian kendaraan rental</p>
</div>

<div class="kembalikan-wrapper">

    
    <div class="form-section">
        <div class="section-title">
            <div class="section-icon section-icon-blue">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
            </div>
            <h3>Informasi Sewa</h3>
        </div>

        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Pelanggan</span>
                <span class="info-value"><?= $t['nama'] ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Kendaraan</span>
                <span class="info-value"><?= $t['nama_kendaraan'] ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Kembali Rencana</span>
                <span class="info-value"><?= $t['tgl_kembali_rencana'] ?></span>
            </div>
        </div>
    </div>

    
    <div class="form-section">
        <div class="section-title">
            <div class="section-icon <?= $denda > 0 ? 'section-icon-red' : 'section-icon-green' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/></svg>
            </div>
            <h3>Informasi Keterlambatan</h3>
        </div>

        <div class="info-grid">
            <div class="info-row">
                <span class="info-label">Hari Ini</span>
                <span class="info-value"><?= date('d-m-Y') ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Telat</span>
                <span class="info-value <?= $telat > 0 ? 'info-value-warning' : '' ?>"><?= $telat ?> hari</span>
            </div>
            <div class="info-row">
                <span class="info-label">Denda</span>
                <span class="info-value <?= $denda > 0 ? 'info-value-denda' : 'info-value-aman' ?>">
                    Rp <?= number_format($denda) ?>
                </span>
            </div>
        </div>
    </div>

   
    <div class="form-section">
        <div class="section-title">
            <div class="section-icon section-icon-green">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            </div>
            <h3>Konfirmasi Pengembalian</h3>
        </div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('kasir/transaksi/kembalikan/proses/'.$t['id_transaksi']) ?>">

            <?php if($denda > 0): ?>
                <div class="form-group">
                    <label class="form-label">Bayar Denda</label>
                    <div class="input-prefix-wrapper">
                        <span class="input-prefix">Rp</span>
                        <input type="number" name="bayar_denda" required placeholder="0" class="form-input input-with-prefix">
                    </div>
                </div>
            <?php else: ?>
                <div class="nodenda-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    <span>Tidak ada denda — kendaraan dikembalikan tepat waktu</span>
                </div>
            <?php endif; ?>

            <div class="form-actions">
                <button type="submit" class="btn-konfirmasi">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                    Konfirmasi Pengembalian
                </button>
            </div>

        </form>
    </div>


    <div class="back-action">
        <a href="<?= base_url('kasir/transaksi') ?>" style="text-decoration:none;">
            <button type="button" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                Kembali
            </button>
        </a>
    </div>

</div>

<?= $this->endSection() ?>