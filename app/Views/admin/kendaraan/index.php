<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<div style="margin-left:220px; padding:20px;">

<h2>Data Kendaraan</h2>

<?php if (session()->getFlashdata('success')): ?>
    <p style="color:green"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<a href="/admin/kendaraan/tambah">
    <button>+ Tambah Kendaraan</button>
</a>

<br><br>

<!-- SEARCH -->
<form method="get" action="/admin/kendaraan">
    <input type="text" name="keyword" placeholder="Cari nama / plat nomor..."
           value="<?= $keyword ?? '' ?>">
    <button type="submit">Search</button>
    <a href="/admin/kendaraan">Reset</a>
</form>

<br>

<!-- FILTER -->
<form method="get" action="/admin/kendaraan">
    <select name="jenis">
        <option value="">-- Semua Jenis --</option>
        <option value="SUV" <?= ($jenis=='SUV')?'selected':'' ?>>SUV</option>
        <option value="Sedan" <?= ($jenis=='Sedan')?'selected':'' ?>>Sedan</option>
        <option value="MPV" <?= ($jenis=='MPV')?'selected':'' ?>>MPV</option>
        <option value="Sports Car" <?= ($jenis=='Sport Car')?'selected':'' ?>>Sports Car</option>
    </select>

    <select name="status">
        <option value="">-- Semua Status --</option>
        <option value="Tersedia" <?= ($status=='Tersedia')?'selected':'' ?>>Tersedia</option>
        <option value="Disewa" <?= ($status=='Disewa')?'selected':'' ?>>Disewa</option>
    </select>

    <button type="submit">Filter</button>
</form>

<br>

<table border="1" cellpadding="8" cellspacing="0">
<tr>
    <th>No</th>
    <th>Nama Kendaraan</th>
    <th>Jenis</th>
    <th>Plat Nomor</th>
    <th>Harga Sewa</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php $no = 1 + (5 * ($pager->getCurrentPage() - 1)); ?>
<?php foreach ($kendaraan as $k): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $k['nama_kendaraan'] ?></td>
    <td><?= $k['jenis'] ?></td>
    <td><?= $k['plat_nomor'] ?></td>
    <td>Rp <?= number_format($k['harga_sewa']) ?></td>
    <td>
        <?php if ($k['status'] == 'Tersedia'): ?>
            <span style="color:green;font-weight:bold;">● Tersedia</span>
        <?php else: ?>
            <span style="color:red;font-weight:bold;">● Disewa</span>
        <?php endif; ?>
    </td>
    <td>
        <a href="/admin/kendaraan/edit/<?= $k['id_kendaraan'] ?>">Edit</a>
        <a href="/admin/kendaraan/hapus/<?= $k['id_kendaraan'] ?>"
           onclick="return confirm('Yakin mau hapus?')">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>

<?php if (empty($kendaraan)): ?>
<tr>
    <td colspan="7" align="center">Belum ada data kendaraan</td>
</tr>
<?php endif; ?>
</table>

<div style="margin-top:15px;">
    <?= $pager->links() ?>
</div>

</div>

<?= $this->endSection() ?>