<?= $this->extend('layouts/kasir_sidebar') ?>
<?= $this->section('content') ?>

<h2>Transaksi Rental</h2>

<?php if(session()->getFlashdata('success')): ?>
<p style="color:green;"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
<p style="color:red;"><?= session()->getFlashdata('error') ?></p>
<?php endif; ?>

<a href="<?= base_url('kasir/transaksi/tambah') ?>">+ Buat Transaksi</a>

<hr>

<h3>Daftar Transaksi</h3>

<table border="1" cellpadding="8" style="border-collapse:collapse; width:100%;">
<tr>
    <th>ID</th>
    <th>Pelanggan</th>
    <th>Kendaraan</th>
    <th>Tgl Sewa</th>
    <th>Lama</th>
    <th>Total</th>
    <th>Sisa</th>
    <th>Denda</th>
    <th>Status Bayar</th>
    <th>Status Sewa</th>
    <th>Aksi</th>
</tr>

<?php foreach ($transaksi as $t): ?>
<tr>
    <td><?= $t['id_transaksi'] ?></td>
    <td><?= esc($t['nama_pelanggan']) ?></td>
    <td><?= esc($t['nama_kendaraan']) ?></td>
    <td><?= $t['tgl_sewa'] ?></td>
    <td><?= $t['lama_sewa'] ?> hari</td>
    <td>Rp <?= number_format($t['total_bayar']) ?></td>
    <td>Rp <?= number_format($t['sisa_bayar']) ?></td>
    <td>Rp <?= number_format($t['denda'] ?? 0) ?></td>
    <td><?= $t['status_bayar'] ?></td>
    <td><?= $t['status_sewa'] ?></td>
    <td>
        <a href="<?= base_url('kasir/transaksi/detail/'.$t['id_transaksi']) ?>">
            Detail
        </a>

        <!-- STATUS BERLANGSUNG -->
<?php if($t['status_sewa'] == 'Berlangsung'): ?>

    <?php if($t['status_bayar'] == 'Lunas'): ?>
        |
        <a href="<?= base_url('kasir/transaksi/kembalikan/'.$t['id_transaksi']) ?>">
            Kembalikan
        </a>
    <?php else: ?>
        |
        <span style="color:red;">Belum Lunas</span>
    <?php endif; ?>

<!-- STATUS SUDAH SELESAI -->
<?php elseif($t['status_sewa'] == 'Selesai'): ?>

    |
    <span style="color:green; font-weight:bold;">Selesai</span>

<?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>

</table>

<?= $this->endSection() ?>