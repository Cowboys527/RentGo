<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<div style="margin-left:220px; padding:20px;">
<h2>Tambah User</h2>

<?php if(session()->getFlashdata('errors')): ?>
<div style="color:red;">
<?php foreach(session()->getFlashdata('errors') as $e): ?>
<p><?= $e ?></p>
<?php endforeach ?>
</div>
<?php endif; ?>

<form action="/admin/user/simpan" method="post">

Username:<br>
<input type="text" name="username" value="<?= old('username') ?>"><br><br>

Password:<br>
<input type="password" name="password"><br><br>

Nama:<br>
<input type="text" name="nama" value="<?= old('nama') ?>"><br><br>

Role:<br>
<select name="role">
    <option value="admin">Admin</option>
    <option value="kasir">Kasir</option>
    <option value="owner">Owner</option>
</select><br><br>

Status:<br>
<select name="status">
    <option value="aktif">Aktif</option>
    <option value="nonaktif">Nonaktif</option>
</select><br><br>

<button type="submit">Simpan</button>
<a href="/admin/user">Kembali</a>
</form>
</div>

<?= $this->endSection() ?>