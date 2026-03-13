<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<div style="margin-left:220px; padding:20px;">
<h2>Edit User</h2>

<?php if(session()->getFlashdata('errors')): ?>
<div style="color:red;">
<?php foreach(session()->getFlashdata('errors') as $e): ?>
<p><?= $e ?></p>
<?php endforeach ?>
</div>
<?php endif; ?>

<form action="/admin/user/update/<?= $user['id_user'] ?>" method="post">

Username:<br>
<input type="text" name="username"
       value="<?= old('username',$user['username']) ?>"><br><br>

Password (kosongkan jika tidak diubah):<br>
<input type="password" name="password"><br><br>

Nama:<br>
<input type="text" name="nama"
       value="<?= old('nama',$user['nama']) ?>"><br><br>

Role:<br>
<select name="role">
<option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
<option value="kasir" <?= $user['role']=='kasir'?'selected':'' ?>>Kasir</option>
<option value="owner" <?= $user['role']=='owner'?'selected':'' ?>>Owner</option>
</select><br><br>

Status:<br>
<select name="status">
<option value="aktif" <?= $user['status']=='aktif'?'selected':'' ?>>Aktif</option>
<option value="nonaktif" <?= $user['status']=='nonaktif'?'selected':'' ?>>Nonaktif</option>
</select><br><br>

<button type="submit">Update</button>
<a href="/admin/user">Batal</a>
</form>
</div>

<?= $this->endSection() ?>