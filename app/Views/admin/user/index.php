<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<div style="margin-left:220px; padding:20px;">
<h2>Data User</h2>

<form method="get" action="/admin/user">
    <input type="text" name="keyword"
           placeholder="Cari username / nama"
           value="<?= $keyword ?? '' ?>">

    <select name="role">
        <option value="">-- Semua Role --</option>
        <option value="admin" <?= ($role=='admin')?'selected':'' ?>>Admin</option>
        <option value="kasir" <?= ($role=='kasir')?'selected':'' ?>>Kasir</option>
        <option value="owner" <?= ($role=='owner')?'selected':'' ?>>Owner</option>
    </select>

    <button type="submit">Search</button>
    <a href="/admin/user">Reset</a>
</form>

<br>
<a href="/admin/user/tambah">+ Tambah User</a>
<br><br>

<table border="1" cellpadding="8" cellspacing="0">
<tr>
    <th>No</th>
    <th>Username</th>
    <th>Nama</th>
    <th>Role</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php $no=1; foreach($user as $u): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= esc($u['username']) ?></td>
    <td><?= esc($u['nama']) ?></td>

    <td>
        <?php if($u['role']=='admin'): ?>
            <span style="background:red;color:white;padding:3px 8px;border-radius:6px;">Admin</span>
        <?php elseif($u['role']=='kasir'): ?>
            <span style="background:blue;color:white;padding:3px 8px;border-radius:6px;">Kasir</span>
        <?php else: ?>
            <span style="background:green;color:white;padding:3px 8px;border-radius:6px;">Owner</span>
        <?php endif; ?>
    </td>

    <td>
        <?php if($u['status']=='aktif'): ?>
            <span style="color:green;font-weight:bold;">Aktif</span>
        <?php else: ?>
            <span style="color:red;font-weight:bold;">Nonaktif</span>
        <?php endif; ?>
    </td>

    <td>
        <a href="/admin/user/edit/<?= $u['id_user'] ?>">Edit</a> |
        <a href="/admin/user/hapus/<?= $u['id_user'] ?>"
           onclick="return confirm('Yakin hapus user?')">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>

<?php if(empty($user)): ?>
<tr>
    <td colspan="6" align="center">Tidak ada data</td>
</tr>
<?php endif; ?>
</table>

<br>
<?= $pager->links() ?>

</div>
<?= $this->endSection() ?>