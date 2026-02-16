<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<div style="margin-left:220px; padding:20px;">
<h2> Data Transaksi</h2>

<table border="1" cellpadding="8">
<tr>
    <th>No</th>
    <th>ID User</th>
    <th>ID Kendaraan</th>
    <th>Tanggal Pinjam</th>
    <th>Tanggal Kembali</th>
    <th>Status</th>
</tr>

<?php $no=1; foreach($transaksi as $t): ?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $t['id_user']; ?></td>
    <td><?= $t['id_kendaraan']; ?></td>
    <td><?= $t['tanggal_pinjam']; ?></td>
    <td><?= $t['tanggal_kembali']; ?></td>
    <td><?= $t['status']; ?></td>
</tr>
<?php endforeach; ?>

</table>
</div>

<?= $this->endSection() ?>