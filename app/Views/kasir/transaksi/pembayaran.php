<?= $this->extend('layouts/kasir_sidebar') ?>
<?= $this->section('content') ?>

<div style="max-width:500px; margin:auto; background:#f5f5f5; padding:30px; border-radius:10px;">

    <h2 style="margin-bottom:20px;">Pembayaran Rental</h2>

    <p>Total Bayar</p>
    <div style="background:#dbeafe; padding:15px; font-size:20px; font-weight:bold;">
        Rp <?= number_format($total) ?>
    </div>

    <br>

    <?php if(session()->getFlashdata('error')): ?>
        <p style="color:red"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <small style="color:#555;">
        0 = Belum Bayar <br>
        Kurang dari total = DP <br>
        Lebih / sama = Lunas
    </small>

    <br><br>

    <form method="post" action="<?= base_url('kasir/transaksi/proses') ?>">

        <label>Uang Bayar</label>
        <input type="number" name="uang" style="width:100%; padding:10px;" required>

        <br><br>

        <!-- ================= BUTTON AKSI ================= -->
        <div style="display:flex; gap:10px;">

            <!-- PROSES -->
            <button type="submit" style="background:#2563eb; color:white; padding:10px 20px; border:none; border-radius:5px;">
                Proses Pembayaran
            </button>

            <!-- BATAL -->
            <a href="<?= base_url('kasir/transaksi/batal') ?>" style="text-decoration:none;">
                <button type="button" style="background:#dc2626; color:white; padding:10px 20px; border:none; border-radius:5px;">
                    Batalkan
                </button>
            </a>

        </div>

    </form>

</div>

<?= $this->endSection() ?>