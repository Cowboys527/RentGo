<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<div style="margin-left:220px; padding:20px;">
<h2>Data User</h2>

<a href="/admin/user/tambah">+ Tambah User</a>

<table border="1" cellpadding="8">
<tr>
    <th>No</th>
    <th>Username</th>
    <th>Role</th>
    <th>Aksi</th>
</tr>

<?php $no=1; foreach($user as $u): ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $u['username']; ?></td>
    <td><?= $u['role']; ?></td>
    <td>
        <a href="/admin/user/edit/<?= $u['id_user']; ?>">Edit</a> |
        <a href="/admin/user/hapus/<?= $u['id_user']; ?>">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>

</table>
</div>

<?= $this->endSection() ?>