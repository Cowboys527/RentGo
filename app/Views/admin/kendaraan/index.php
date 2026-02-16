<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<div style="margin-left:220px; padding:20px;">

<h2>Data Kendaraan</h2>

<a href="/admin/kendaraan/tambah">
    <button>+ Tambah Kendaraan</button>
</a>

<br><br>

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

    <?php $no = 1; ?>
    <?php foreach ($kendaraan as $k): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $k['nama_kendaraan'] ?></td>
        <td><?= $k['jenis'] ?></td>
        <td><?= $k['plat_nomor'] ?></td>
        <td>Rp <?= number_format($k['harga_sewa']) ?></td>
        <td><?= $k['status'] ?></td>
        <td>
            <a href="/admin/kendaraan/edit/<?= $k['id_kendaraan'] ?>">Edit</a>
            <a href="/admin/kendaraan/hapus/<?= $k['id_kendaraan'] ?>"
               onclick="return confirm('Yakin mau hapus?')">
               Hapus
            </a>
        </td>
    </tr>
    <?php endforeach; ?>

    <?php if (empty($kendaraan)): ?>
    <tr>
        <td colspan="7" align="center">Belum ada data kendaraan</td>
    </tr>
    <?php endif; ?>

</table>

</div>

<?= $this->endSection() ?>
