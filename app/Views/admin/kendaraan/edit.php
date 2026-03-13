<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<div style="margin-left:220px; padding:20px;">
<h2>Edit Kendaraan</h2>

<?php if (session()->getFlashdata('errors')): ?>
    <div style="color:red;">
        <?php foreach (session()->getFlashdata('errors') as $e): ?>
            <p><?= $e ?></p>
        <?php endforeach ?>
    </div>
<?php endif; ?>

<form action="/admin/kendaraan/update/<?= $kendaraan['id_kendaraan'] ?>" method="post">

Nama Kendaraan:<br>
<input type="text" name="nama_kendaraan"
       value="<?= old('nama_kendaraan', $kendaraan['nama_kendaraan']) ?>"><br><br>

Jenis:<br>
<input type="text" name="jenis"
       value="<?= old('jenis', $kendaraan['jenis']) ?>"><br><br>

Plat Nomor:<br>
<input type="text" name="plat_nomor"
       value="<?= old('plat_nomor', $kendaraan['plat_nomor']) ?>"><br><br>

Harga Sewa:<br>
<input type="number" name="harga_sewa"
       value="<?= old('harga_sewa', $kendaraan['harga_sewa']) ?>"><br><br>

Status:<br>
<input type="text" value="<?= $kendaraan['status'] ?>" readonly><br>
<small>Status diatur otomatis oleh sistem transaksi</small><br><br>

<button type="submit">Update</button>
<a href="/admin/kendaraan">Kembali</a>

</form>
</div>

<?= $this->endSection() ?>