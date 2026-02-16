<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<div style="margin-left:220px; padding:20px;">
    <h2>Edit Kendaraan</h2>

    <form action="/admin/kendaraan/update/<?= $kendaraan['id_kendaraan']; ?>" method="post">

        <label>Nama Kendaraan</label><br>
        <input type="text" name="nama_kendaraan"
               value="<?= $kendaraan['nama_kendaraan']; ?>" required><br><br>

        <label>Jenis</label><br>
        <input type="text" name="jenis"
               value="<?= $kendaraan['jenis']; ?>" required><br><br>

        <label>Plat Nomor</label><br>
        <input type="text" name="plat_nomor"
               value="<?= $kendaraan['plat_nomor']; ?>" required><br><br>

        <label>Harga Sewa</label><br>
        <input type="number" name="harga_sewa"
               value="<?= $kendaraan['harga_sewa']; ?>" required><br><br>

        <label>Status</label><br>
        <select name="status">
            <option value="Tersedia"
                <?= $kendaraan['status'] == 'Tersedia' ? 'selected' : '' ?>>
                Tersedia
            </option>

            <option value="Disewa"
                <?= $kendaraan['status'] == 'Disewa' ? 'selected' : '' ?>>
                Disewa
            </option>
        </select><br><br>

        <button type="submit">Update</button>
        <a href="/admin/kendaraan">Kembali</a>

    </form>
</div>

<?= $this->endSection() ?>
