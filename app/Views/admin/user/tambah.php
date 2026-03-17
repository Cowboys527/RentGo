<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/user/tambah.css') ?>">

<div class="form-container">

<div class="page-header">
    <h2 class="page-title">Tambah User</h2>
    <p class="page-subtitle">Tambahkan pengguna baru ke sistem</p>
</div>

<?php if(session()->getFlashdata('errors')): ?>
    <div class="alert-error">
        <?php foreach(session()->getFlashdata('errors') as $e): ?>
            <p><?= $e ?></p>
        <?php endforeach ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('success_user')): ?>
    <div class="alert-success">
        <?= session()->getFlashdata('success_user') ?>
    </div>
<?php endif; ?>

<div class="form-card">
    <form action="/admin/user/simpan" method="post" class="user-form">

        <div class="form-group">
            <label class="form-label">Username:</label>
            <input type="text" name="username" class="form-input" value="<?= old('username') ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Password:</label>
            <input type="password" name="password" class="form-input">
        </div>

        <div class="form-group">
            <label class="form-label">Nama:</label>
            <input type="text" name="nama" class="form-input" value="<?= old('nama') ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Role:</label>
            <select name="role" class="form-select">
                <option value="admin">Admin</option>
                <option value="kasir">Kasir</option>
                <option value="owner">Owner</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Status:</label>
            <select name="status" class="form-select">
                <option value="aktif">Aktif</option>
                <option value="nonaktif">Nonaktif</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Simpan</button>
            <a href="/admin/user" class="btn-cancel">Kembali</a>
        </div>

    </form>
</div>

</div>

<?= $this->endSection() ?>