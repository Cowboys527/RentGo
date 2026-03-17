<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/user/edit.css') ?>">

<div class="form-container">

<div class="page-header">
    <h2 class="page-title">Edit User</h2>
    <p class="page-subtitle">Perbarui data pengguna</p>
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
    <form action="/admin/user/update/<?= $user['id_user'] ?>" method="post" class="user-form">

        <div class="form-group">
            <label class="form-label">Username:</label>
            <input type="text" name="username" class="form-input"
                   value="<?= old('username',$user['username']) ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Password (kosongkan jika tidak diubah):</label>
            <input type="password" name="password" class="form-input">
        </div>

        <div class="form-group">
            <label class="form-label">Nama:</label>
            <input type="text" name="nama" class="form-input"
                   value="<?= old('nama',$user['nama']) ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Role:</label>
            <select name="role" class="form-select">
                <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
                <option value="kasir" <?= $user['role']=='kasir'?'selected':'' ?>>Kasir</option>
                <option value="owner" <?= $user['role']=='owner'?'selected':'' ?>>Owner</option>
            </select>
        </div>

        <div class="form-group">
            <label class="form-label">Status:</label>
            <select name="status" class="form-select">
                <option value="aktif" <?= $user['status']=='aktif'?'selected':'' ?>>Aktif</option>
                <option value="nonaktif" <?= $user['status']=='nonaktif'?'selected':'' ?>>Nonaktif</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Update</button>
            <a href="/admin/user" class="btn-cancel">Batal</a>
        </div>

    </form>
</div>

</div>

<?= $this->endSection() ?>