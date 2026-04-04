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
    <?php foreach($transaksi as $t): ?>
        <tr>
            <td><?= $t['id_transaksi'] ?></td>
            <td><?= $t['nama_pelanggan'] ?></td>
            <td><?= $t['nama_kendaraan'] ?></td>
            <td><?= $t['tgl_sewa'] ?></td>
            <td><?= $t['total_bayar'] ?></td>
            <td><?= $t['denda'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>