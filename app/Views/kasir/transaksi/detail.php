<?= $this->extend('layouts/kasir_sidebar') ?>
<?= $this->section('content') ?>

<h2>Detail Transaksi</h2>

<p><b>Pelanggan:</b> <?= $t['nama'] ?></p>
<p><b>Kendaraan:</b> <?= $t['nama_kendaraan'] ?></p>
<p><b>Total:</b> Rp <?= number_format($t['total_bayar']) ?></p>
<p><b>DP:</b> Rp <?= number_format($t['dp']) ?></p>
<p><b>Sisa:</b> Rp <?= number_format($t['sisa_bayar']) ?></p>
<p><b>Status:</b> <?= $t['status_bayar'] ?></p>

<hr>

<?php if($t['status_bayar'] != 'Lunas'): ?>

<h3>Bayar Sisa</h3>

<form method="post" action="<?= base_url('kasir/transaksi/bayar-sisa/'.$t['id_transaksi']) ?>">
    <input type="number" name="bayar" placeholder="Masukkan pembayaran" required>

    <br><br>

    <button type="submit">Bayar</button>
</form>

<?php else: ?>

    <p style="color:green;"><b>Sudah Lunas</b></p>

    <a href="<?= base_url('kasir/transaksi/struk/'.$t['id_transaksi']) ?>" target="_blank">
        <button type="button">Cetak Struk</button>
    </a>

<?php endif; ?>

<hr>

<!-- 🔥 SATU BUTTON SAJA -->
<a href="<?= base_url('kasir/transaksi') ?>">
    <button type="button">Kembali</button>
</a>

<?= $this->endSection() ?>