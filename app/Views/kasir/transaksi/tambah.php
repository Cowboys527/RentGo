<?= $this->extend('layouts/kasir_sidebar') ?>
<?= $this->section('content') ?>

<h2>Buat Transaksi Rental</h2>

<form action="<?= base_url('kasir/transaksi/simpan') ?>" method="post">

<h3>Data Pelanggan</h3>
<input type="text" name="nama_pelanggan" placeholder="Nama Pelanggan" required>
<input type="text" name="no_hp" placeholder="No HP" required>
<input type="text" name="alamat" placeholder="Alamat">

<h3>Data Sewa</h3>

<select name="id_kendaraan" required>
<option value="">-- Pilih Kendaraan --</option>
<?php foreach ($kendaraan as $k): ?>
<option value="<?= $k['id_kendaraan'] ?>">
<?= $k['nama_kendaraan'] ?> - Rp <?= number_format($k['harga_sewa']) ?>/hari
</option>
<?php endforeach; ?>
</select>

<br><br>

<label>Tanggal Sewa</label><br>
<input type="date" name="tgl_sewa" required>

<br><br>

<label>Tanggal Kembali</label><br>
<input type="date" name="tgl_kembali" required>

<br><br>

<button type="submit">Lanjut Pembayaran</button>

<a href="<?= base_url('kasir/transaksi') ?>">
<button type="button">Kembali</button>
</a>

</form>

<?= $this->endSection() ?>