<?= $this->extend('layouts/kasir_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/transaksi/pembayaran.css') ?>">

<!-- Page Header -->
<div class="page-header">
    <h2 class="page-title">Pembayaran Rental</h2>
    <p class="page-subtitle">Proses pembayaran transaksi sewa kendaraan</p>
</div>

<div class="pembayaran-wrapper">

    <!-- Total Bayar Card -->
    <div class="form-section">
        <div class="section-title">
            <div class="section-icon section-icon-blue">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
            </div>
            <h3>Ringkasan Pembayaran</h3>
        </div>

        <!-- Total Box -->
        <div class="total-box">
            <span class="total-label">Total Bayar</span>
            <span class="total-value">Rp <?= number_format($total) ?></span>
        </div>

        <!-- Info Keterangan -->
        <div class="info-box">
            <div class="info-item">
                <span class="info-dot dot-red"></span>
                <span><strong>0</strong> = Belum Bayar</span>
            </div>
            <div class="info-item">
                <span class="info-dot dot-orange"></span>
                <span><strong>Kurang dari total</strong> = DP</span>
            </div>
            <div class="info-item">
                <span class="info-dot dot-green"></span>
                <span><strong>Lebih / sama dengan total</strong> = Lunas</span>
            </div>
        </div>
    </div>

    <!-- Form Pembayaran -->
    <div class="form-section">
        <div class="section-title">
            <div class="section-icon section-icon-green">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.11 0-2 .89-2 2v12c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>
            </div>
            <h3>Input Pembayaran</h3>
        </div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('kasir/transaksi/proses') ?>">

            <div class="form-group">
                <label class="form-label">Uang Bayar</label>
                <div class="input-prefix-wrapper">
                    <span class="input-prefix">Rp</span>
                    <input type="number" name="uang" class="form-input input-with-prefix" placeholder="0" required>
                </div>
            </div>

            <!-- BUTTON AKSI -->
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                    Proses Pembayaran
                </button>

                <a href="<?= base_url('kasir/transaksi/batal') ?>" style="text-decoration:none;">
                    <button type="button" class="btn-batal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
                        Batalkan
                    </button>
                </a>
            </div>

        </form>
    </div>

</div>

<?= $this->endSection() ?>