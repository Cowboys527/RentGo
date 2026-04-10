<h3>Laporan Transaksi</h3>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pelanggan</th>
            <th>Kendaraan</th>
            <th>Tgl</th>
            <th>Total</th>
            <th>Denda</th>
        </tr>
    </thead>

    <tbody>

    <?php 
    $totalPendapatan = 0; 
    ?>

    <?php foreach($transaksi as $t): ?>
        <?php $totalPendapatan += $t['total_bayar']; ?>
        <tr>
            <td><?= $t['id_transaksi'] ?></td>
            <td><?= $t['nama_pelanggan'] ?></td>
            <td><?= $t['nama_kendaraan'] ?></td>
            <td><?= $t['tgl_sewa'] ?></td>
            <td>Rp <?= number_format($t['total_bayar']) ?></td>
            <td>Rp <?= number_format($t['denda'] ?? 0) ?></td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="4" align="left"><strong>Total Pendapatan</strong></td>
        <td colspan="2">
            <strong>Rp <?= number_format($totalPendapatan) ?></strong>
        </td>
    </tr>

    </tbody>
</table>