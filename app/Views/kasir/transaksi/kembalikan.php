<?= $this->extend('layouts/kasir_sidebar') ?>
<?= $this->section('content') ?>

<h2>Pengembalian Kendaraan</h2>

<p><b>Pelanggan:</b> <?= $t['nama'] ?></p>
<p><b>Kendaraan:</b> <?= $t['nama_kendaraan'] ?></p>
<p><b>Tanggal Kembali Rencana:</b> <?= $t['tgl_kembali_rencana'] ?></p>

<hr>

<p><b>Telat:</b> <?= $telat ?> hari</p>
<p><b>Denda:</b> Rp <?= number_format($denda) ?></p>

<hr>

<?php if(session()->getFlashdata('error')): ?>
<p style="color:red;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<form method="post" action="<?= base_url('kasir/transaksi/kembalikan/proses/'.$t['id_transaksi']) ?>">

   <p><b>Hari ini:</b> <?= date('d-m-Y') ?></p>
   
    <?php if($denda > 0): ?>
        <label>Bayar Denda:</label><br>
        <input type="number" name="bayar_denda" required placeholder="Masukkan jumlah bayar"><br><br>
    <?php else: ?>
        <p style="color:green;">Tidak ada denda</p>
    <?php endif; ?>

    <button type="submit" style="background:green; color:white; padding:10px;">
        Konfirmasi Pengembalian
    </button>
</form>

<br>

<a href="<?= base_url('kasir/transaksi') ?>">
    <button type="button">Kembali</button>
</a>

<?= $this->endSection() ?>