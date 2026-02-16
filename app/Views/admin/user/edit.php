<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<div style="margin-left:220px; padding:20px;">
<h2>Edit User</h2>

<form action="/admin/user/update/<?= $user['id_user']; ?>" method="post">

Username:<br>
<input type="text" name="username"
       value="<?= $user['username']; ?>"><br><br>

Nama:<br>
<input type="text" name="nama"
       value="<?= $user['nama']; ?>"><br><br>

Role:<br>
<select name="role">
<option value="admin"
<?= $user['role']=='admin'?'selected':'' ?>>Admin</option>

<option value="kasir"
<?= $user['role']=='kasir'?'selected':'' ?>>Kasir</option>

<option value="owner"
<?= $user['role']=='owner'?'selected':'' ?>>Owner</option>
</select><br><br>

<button type="submit">Update</button>
<a href="/admin/user">Batal</a>
</form>
</div>

<?= $this->endSection() ?>