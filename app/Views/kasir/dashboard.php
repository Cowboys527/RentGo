<?= $this->extend('layouts/kasir_sidebar') ?>
<?= $this->section('content') ?>

<h1>Dashboard Kasir</h1>
<p>Ringkasan Transaksi Hari Ini</p>

<!-- Statistik -->
<div class="statistik">

    <div class="card">
        <h3>Transaksi Hari Ini</h3>
        <h2><?= $transaksiHariIni ?></h2>
    </div>

    <div class="card">
        <h3>Kendaraan Tersedia</h3>
        <h2><?= $kendaraanTersedia ?></h2>
    </div>

    <div class="card">
        <h3>Kendaraan Disewa</h3>
        <h2><?= $kendaraanDisewa ?></h2>
    </div>

</div>

<!-- Tabel Transaksi Hari Ini (placeholder dulu) -->
<div class="tabel-transaksi">
    <h3>Daftar Transaksi Hari Ini</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Pelanggan</th>
                <th>Kendaraan</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <!-- Nanti isi dari database -->
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>