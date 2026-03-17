<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/kendaraan/tambah.css') ?>">

<div class="form-container">

<div class="page-header">
    <h2 class="page-title">Tambah Kendaraan</h2>
    <p class="page-subtitle">Tambahkan data kendaraan baru</p>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert-error">
        <?php foreach (session()->getFlashdata('errors') as $e): ?>
            <p><?= $e ?></p>
        <?php endforeach ?>
    </div>
<?php endif; ?>

<div class="form-card">
    <form action="/admin/kendaraan/simpan" method="post" 
          enctype="multipart/form-data" class="kendaraan-form">

        <div class="form-group">
            <label class="form-label">Nama Kendaraan:</label>
            <input type="text" name="nama_kendaraan" class="form-input" value="<?= old('nama_kendaraan') ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Foto Kendaraan:</label>
            <input type="file" name="foto" class="form-input">
        </div>

        <div class="form-group">
            <label class="form-label">Jenis:</label>
            <input type="text" name="jenis" class="form-input" value="<?= old('jenis') ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Plat Nomor:</label>
            <input type="text" name="plat_nomor" class="form-input" value="<?= old('plat_nomor') ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Harga Sewa:</label>
            <input type="number" name="harga_sewa" class="form-input" value="<?= old('harga_sewa') ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Status:</label>
            <input type="text" value="Tersedia" class="form-input form-input-readonly" readonly>
            <input type="hidden" name="status" value="Tersedia">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan</button>
            <a href="/admin/kendaraan" class="btn-cancel">Kembali</a>
        </div>

    </form>
</div>

</div>

<?= $this->endSection() ?>