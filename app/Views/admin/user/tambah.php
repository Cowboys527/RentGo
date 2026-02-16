<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<div style="margin-left:220px; padding:20px;">
<h2>Tambah User</h2>

<form action="/admin/user/simpan" method="post">

Username:<br>
<input type="text" name="username" required><br><br>

Password:<br>
<input type="password" name="password" required><br><br>

Nama:<br>
<input type="text" name="nama" required><br><br>

Role:<br>
<select name="role" required>
    <option value="admin">Admin</option>
    <option value="kasir">Kasir</option>
    <option value="owner">Owner</option>
</select><br><br>

<button type="submit">Simpan</button>
<a href="/admin/user">Kembali</a>
</form>
</div>

<?= $this->endSection() ?>