<?= $this->extend('layouts/kasir_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/transaksi/tambah.css') ?>">


<div class="page-header">
    <h2 class="page-title">Transaksi Rental</h2>
    <p class="page-subtitle">Buat transaksi sewa kendaraan baru</p>
</div>

<form action="<?= base_url('kasir/transaksi/simpan') ?>" method="post" enctype="multipart/form-data" class="form-wrapper">

    
    <div class="form-section">
        <div class="section-title">
            <div class="section-icon section-icon-blue">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
            </div>
            <h3>Data Pelanggan</h3>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" placeholder="Masukan nama pelanggan" class="form-input" required>
            </div>
            <div class="form-group">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" placeholder="Masukan nomor HP" class="form-input" required>
            </div>
        </div>

        <div class="form-row">
    <div class="form-group">
        <label class="form-label">NIK</label>
        <input 
        type="text" 
        name="nik" 
        placeholder="Masukan NIK" 
        class="form-input" 
        maxlength="16"
        pattern="[0-9]{16}"
        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
        required
     >
    </div>

    <div class="form-group">
        <label class="form-label">Foto KTP</label>
        <input type="file" name="foto_ktp" class="form-input" accept="image/*" required>
    </div>

    <div class="form-group">
    <label class="form-label">Foto SIM</label>
    <input type="file" name="foto_sim" class="form-input" accept="image/*" required>
</div>

</div>

        <div class="form-group">
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" placeholder="Masukan alamat" class="form-input">
        </div>
    </div>

    
    <div class="form-section">
        <div class="section-title">
            <div class="section-icon section-icon-orange">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
            </div>
            <h3>Data Kendaraan</h3>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label class="form-label">Pilih Kendaraan</label>
                <div class="form-group">

             <input type="hidden" name="id_kendaraan" id="id_kendaraan" required>

            <div id="openKendaraan" class="form-input form-select">
             Klik untuk pilih kendaraan
            </div>
           </div>
           
            </div>
            <div class="form-group">
                <label class="form-label">Status Kendaraan</label>
                <input type="text" id="status" class="form-input form-readonly" readonly placeholder="-">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Harga / Hari</label>
            <input type="text" id="harga" class="form-input form-readonly form-highlight" readonly placeholder="Rp 0">
        </div>
    </div>

    
    <div class="form-section">
        <div class="section-title">
            <div class="section-icon section-icon-green">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/></svg>
            </div>
            <h3>Data Sewa</h3>
        </div>

        <div class="form-row">
    <div class="form-group">
        <label class="form-label">Tanggal Sewa</label>
        <input type="date" name="tgl_sewa" class="form-input" required>
    </div>

    <div class="form-group">
        <label class="form-label">Tanggal Kembali</label>
        <input type="date" name="tgl_kembali" class="form-input" required>
    </div>

    <div class="form-group">
        <label class="form-label">Jam Ambil</label>
        <input type="time" name="jam_sewa" id="jam_sewa" class="form-input" required>
    </div>
</div>
        <div class="form-group">
            <label class="form-label">Lama Sewa (Hari)</label>
            <input type="text" id="lama_sewa" class="form-input form-readonly" readonly placeholder="0 hari">
        </div>
    </div>

   
    <div class="form-section">
        <div class="section-title">
            <div class="section-icon section-icon-purple">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
            </div>
            <h3>Total Pembayaran</h3>
        </div>

        <div class="total-box">
            <span class="total-label">Total Bayar</span>
            <input type="text" id="total" class="total-value" readonly placeholder="Rp 0">
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
            Lanjut Pembayaran
        </button>
        <a href="<?= base_url('kasir/transaksi') ?>">
            <button type="button" class="btn-back">Kembali</button>
        </a>
    </div>

</form>

<div id="overlayKendaraan" class="overlay-kendaraan">

    <div class="overlay-content">

        <div class="overlay-header">
            <h2>Pilih Kendaraan</h2>
            <button onclick="closeOverlay()">✕</button>
        </div>

        <div class="grid-kendaraan">
            <?php foreach ($kendaraan as $k): ?>
            <div class="card-kendaraan"
                data-id="<?= $k['id_kendaraan'] ?>"
                data-nama="<?= $k['nama_kendaraan'] ?>"
                data-harga="<?= $k['harga_sewa'] ?>"
                data-status="<?= $k['status'] ?>"
            >

                <img src="<?= base_url('uploads/kendaraan/'.$k['foto']) ?>">

                <h4><?= $k['nama_kendaraan'] ?></h4>
                <p>Rp <?= number_format($k['harga_sewa']) ?>/hari</p>

                <button type="button" class="btn-pilih">Pilih</button>

            </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>                                                                                  

<script>
const overlay = document.getElementById('overlayKendaraan');
const openBtn = document.getElementById('openKendaraan');
const idInput = document.getElementById('id_kendaraan');

const status = document.getElementById('status');
const harga = document.getElementById('harga');

const tglSewa = document.querySelector('[name="tgl_sewa"]');
const tglKembali = document.querySelector('[name="tgl_kembali"]');
const lama = document.getElementById('lama_sewa');
const total = document.getElementById('total');
const jamSewa = document.getElementById('jam_sewa');

let hargaPerHari = 0;

const today = new Date().toISOString().split('T')[0];
tglSewa.setAttribute('min', today);
tglKembali.setAttribute('min', today);


openBtn.addEventListener('click', () => {
    overlay.classList.add('show');
});


function closeOverlay() {
    overlay.classList.remove('show');
}


document.querySelectorAll('.card-kendaraan').forEach(card => {
    card.addEventListener('click', function() {
        const id = this.dataset.id;
        const nama = this.dataset.nama;
        const hargaData = this.dataset.harga;
        const statusData = this.dataset.status;

        idInput.value = id;
        openBtn.innerText = nama;

        status.value = statusData;
        hargaPerHari = hargaData;
        harga.value = "Rp " + parseInt(hargaData).toLocaleString();

        closeOverlay();
        hitungTotal();
    });
});


function hitungHari() {
    if (tglSewa.value && tglKembali.value) {
        const start = new Date(tglSewa.value);
        const end = new Date(tglKembali.value);

        let selisih = (end - start) / (1000 * 60 * 60 * 24);
        selisih = Math.ceil(selisih);

        if (selisih <= 0) selisih = 1;

        lama.value = selisih + " hari";
        return selisih;
    }
    return 0;
}

function hitungTotal() {
    const hari = hitungHari();

    if (hargaPerHari && hari) {
        const hasil = hargaPerHari * hari;
        total.value = "Rp " + hasil.toLocaleString();
    }
}

tglSewa.addEventListener('change', function() {
    tglKembali.setAttribute('min', this.value);
    hitungTotal();
});

tglKembali.addEventListener('change', hitungTotal);
</script>

<?= $this->endSection() ?>