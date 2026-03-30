<?= $this->extend('layouts/kasir_sidebar') ?>
<?= $this->section('content') ?>

<h2>Buat Transaksi Rental</h2>

<form action="<?= base_url('kasir/transaksi/simpan') ?>" method="post">

<!-- ================= DATA PELANGGAN ================= -->
<h3>Data Pelanggan</h3>

<input type="text" name="nama_pelanggan" placeholder="Nama Pelanggan" required>
<input type="text" name="no_hp" placeholder="No HP" required>
<input type="text" name="alamat" placeholder="Alamat">

<br><br>

<!-- ================= DATA SEWA ================= -->
<h3>Data Sewa</h3>

<select name="id_kendaraan" id="kendaraan" required>
<option value="">-- Pilih Kendaraan --</option>
<?php foreach ($kendaraan as $k): ?>
<option 
    value="<?= $k['id_kendaraan'] ?>"
    data-harga="<?= $k['harga_sewa'] ?>"
    data-status="<?= $k['status'] ?>"
>
<?= $k['nama_kendaraan'] ?> - Rp <?= number_format($k['harga_sewa']) ?>/hari
</option>
<?php endforeach; ?>
</select>

<br><br>

<label>Status Kendaraan</label><br>
<input type="text" id="status" readonly>

<br><br>

<label>Harga / Hari</label><br>
<input type="text" id="harga" readonly>

<br><br>

<label>Tanggal Sewa</label><br>
<input type="date" name="tgl_sewa" required>

<br><br>

<label>Tanggal Kembali</label><br>
<input type="date" name="tgl_kembali" required>

<br><br>

<label>Lama Sewa (Hari)</label><br>
<input type="text" id="lama_sewa" readonly>

<br><br>

<label>Total Bayar</label><br>
<input type="text" id="total" readonly>

<br><br>

<button type="submit">Lanjut Pembayaran</button>

<a href="<?= base_url('kasir/transaksi') ?>">
    <button type="button">Kembali</button>
</a>

</form>

<!-- ================= JAVASCRIPT ================= -->
<script>
const kendaraan = document.getElementById('kendaraan');
const status = document.getElementById('status');
const harga = document.getElementById('harga');
const tglSewa = document.querySelector('[name="tgl_sewa"]');
const tglKembali = document.querySelector('[name="tgl_kembali"]');
const lama = document.getElementById('lama_sewa');
const total = document.getElementById('total');

let hargaPerHari = 0;

// Saat pilih kendaraan
kendaraan.addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];

    status.value = selected.getAttribute('data-status');
    hargaPerHari = selected.getAttribute('data-harga');

    harga.value = "Rp " + parseInt(hargaPerHari).toLocaleString();

    hitungTotal();
});

// Hitung lama sewa
function hitungHari() {
    if (tglSewa.value && tglKembali.value) {
        const start = new Date(tglSewa.value);
        const end = new Date(tglKembali.value);

        let selisih = (end - start) / (1000 * 60 * 60 * 24);

        if (selisih <= 0) selisih = 1;

        lama.value = selisih;

        return selisih;
    }
    return 0;
}

// Hitung total bayar
function hitungTotal() {
    const hari = hitungHari();

    if (hargaPerHari && hari) {
        const hasil = hargaPerHari * hari;
        total.value = "Rp " + hasil.toLocaleString();
    }
}

// Event perubahan tanggal
tglSewa.addEventListener('change', hitungTotal);
tglKembali.addEventListener('change', hitungTotal);

</script>

<?= $this->endSection() ?>