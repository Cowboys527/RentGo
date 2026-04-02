<style>
body {
    font-family: monospace;
    font-size: 12px;
    width: 220px;
}

.center {
    text-align: center;
}

.line {
    border-top: 1px dashed black;
    margin: 5px 0;
}

.right {
    text-align: right;
}
</style>

<div class="center">
    <b>RENTGO</b><br>
    Struk Rental<br>
</div>

<div class="line"></div>

ID: <?= $t['id_transaksi'] ?><br>
Tanggal: <?= date('d-m-Y') ?><br>

<div class="line"></div>

Nama: <?= $t['nama'] ?><br>
Kendaraan: <?= $t['nama_kendaraan'] ?><br>

<div class="line"></div>

Total: <span class="right">Rp <?= number_format($t['total_bayar']) ?></span><br>
Bayar: <span class="right">Rp <?= number_format($t['dp']) ?></span><br>

<?php if($t['dp'] > $t['total_bayar']): ?>
Kembali: <span class="right">
Rp <?= number_format($t['dp'] - $t['total_bayar']) ?>
</span><br>
<?php endif; ?>

Sisa: <span class="right">Rp <?= number_format($t['sisa_bayar']) ?></span><br>
Denda: <span class="right">Rp <?= number_format($t['denda'] ?? 0) ?></span><br>

<div class="line"></div>

Status: <?= $t['status_bayar'] ?><br>

<div class="line"></div>

<div class="center">
    Terima Kasih
</div>