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

<form method="post" action="<?= base_url('kasir/transaksi/kembalikan/proses/'.$t['id_transaksi']) ?>">
    <button type="submit" style="background:green; color:white; padding:10px;">
        Konfirmasi Pengembalian
    </button>
</form>

<br>

<a href="<?= base_url('kasir/transaksi') ?>">
    <button type="button">Kembali</button>
</a>

<?= $this->endSection() ?>