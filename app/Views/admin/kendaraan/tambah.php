<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<div style="margin-left:220px; padding:20px;">

<h2>Tambah Kendaraan</h2>

<form action="/admin/kendaraan/simpan" method="post">

Nama Kendaraan:<br>
<input type="text" name="nama_kendaraan" required><br><br>

Jenis:<br>
<input type="text" name="jenis" required><br><br>

Plat Nomor:<br>
<input type="text" name="plat_nomor" required><br><br>

Harga Sewa:<br>
<input type="number" name="harga_sewa" required><br><br>

Status:<br>
<select name="status">
    <option value="Tersedia">Tersedia</option>
    <option value="Disewa">Disewa</option>
</select><br><br>

<button type="submit">Simpan</button>
<a href="/admin/kendaraan">Kembali</a>

</form>

</div>

<?= $this->endSection() ?>