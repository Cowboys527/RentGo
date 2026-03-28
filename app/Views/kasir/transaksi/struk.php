<h2>STRUK RENTAL</h2>

<p>Nama: <?= $t['nama'] ?></p>
<p>Kendaraan: <?= $t['nama_kendaraan'] ?></p>
<p>Total: Rp <?= number_format($t['total_bayar']) ?></p>
<p>Dibayar: Rp <?= number_format($t['dp']) ?></p>
<p>Status: <?= $t['status_bayar'] ?></p>

<hr>

<p><b>Terima Kasih 🙏</b></p>

<script>
    window.print();
</script>