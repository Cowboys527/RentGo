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

<!-- ================= FILTER ================= -->
<form method="get" style="margin-bottom:20px; display:flex; gap:10px; flex-wrap:wrap;">

    <!-- SEARCH -->
    <input type="text" name="keyword" placeholder="Cari pelanggan..."
        value="<?= $_GET['keyword'] ?? '' ?>"
        style="padding:8px; width:200px;">

    <!-- STATUS BAYAR -->
    <select name="status_bayar" style="padding:8px;">
        <option value="">-- Status Bayar --</option>
        <option value="Belum Bayar" <?= (($_GET['status_bayar'] ?? '')=='Belum Bayar')?'selected':'' ?>>Belum Bayar</option>
        <option value="DP" <?= (($_GET['status_bayar'] ?? '')=='DP')?'selected':'' ?>>DP</option>
        <option value="Lunas" <?= (($_GET['status_bayar'] ?? '')=='Lunas')?'selected':'' ?>>Lunas</option>
    </select>

    <!-- STATUS SEWA -->
    <select name="status_sewa" style="padding:8px;">
        <option value="">-- Status Sewa --</option>
        <option value="Berlangsung" <?= (($_GET['status_sewa'] ?? '')=='Berlangsung')?'selected':'' ?>>Berlangsung</option>
        <option value="Selesai" <?= (($_GET['status_sewa'] ?? '')=='Selesai')?'selected':'' ?>>Selesai</option>
    </select>

    <!-- BUTTON -->
    <button type="submit" style="padding:8px 15px; background:#2563eb; color:white;">
        Filter
    </button>

    <a href="<?= base_url('kasir/transaksi') ?>">
        <button type="button" style="padding:8px 15px; background:#6b7280; color:white;">
            Reset
        </button>
    </a>

</form>

<!-- ================= TABEL ================= -->
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

<?php if(empty($transaksi)): ?>
<tr>
    <td colspan="11" style="text-align:center;">Data tidak ditemukan</td>
</tr>
<?php endif; ?>

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

    <!-- STATUS BAYAR -->
    <td>
        <span style="
            padding:5px 10px;
            border-radius:5px;
            color:white;
            background:
            <?= $t['status_bayar']=='Lunas' ? 'green' : ($t['status_bayar']=='DP' ? 'orange' : 'red') ?>;">
            <?= $t['status_bayar'] ?>
        </span>
    </td>

    <!-- STATUS SEWA -->
    <td>
        <span style="
            padding:5px 10px;
            border-radius:5px;
            color:white;
            background:
            <?= $t['status_sewa']=='Selesai' ? 'green' : 'blue' ?>;">
            <?= $t['status_sewa'] ?>
        </span>
    </td>

    <!-- AKSI -->
    <td>
        <a href="<?= base_url('kasir/transaksi/detail/'.$t['id_transaksi']) ?>">
            Detail
        </a>

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

        <?php elseif($t['status_sewa'] == 'Selesai'): ?>

            |
            <span style="color:green; font-weight:bold;">Selesai</span>

        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>

</table>

<div style="margin-top:20px;">
    <?= $pager->links() ?>
</div>

<?= $this->endSection() ?>