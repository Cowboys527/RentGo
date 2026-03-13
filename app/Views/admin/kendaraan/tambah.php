<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<div style="margin-left:220px; padding:20px;">
<h2>Tambah Kendaraan</h2>

<?php if (session()->getFlashdata('errors')): ?>
    <div style="color:red;">
        <?php foreach (session()->getFlashdata('errors') as $e): ?>
            <p><?= $e ?></p>
        <?php endforeach ?>
    </div>
<?php endif; ?>

<form action="/admin/kendaraan/simpan" method="post">

Nama Kendaraan:<br>
<input type="text" name="nama_kendaraan" value="<?= old('nama_kendaraan') ?>"><br><br>

Jenis:<br>
<input type="text" name="jenis" value="<?= old('jenis') ?>"><br><br>

Plat Nomor:<br>
<input type="text" name="plat_nomor" value="<?= old('plat_nomor') ?>"><br><br>

Harga Sewa:<br>
<input type="number" name="harga_sewa" value="<?= old('harga_sewa') ?>"><br><br>

Status:<br>
<input type="text" value="Tersedia" readonly>
<input type="hidden" name="status" value="Tersedia"><br><br>

<button type="submit">Simpan</button>
<a href="/admin/kendaraan">Kembali</a>

</form>
</div>

<?= $this->endSection() ?>