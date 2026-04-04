<?= $this->extend('layouts/owner_sidebar') ?>
<?= $this->section('content') ?>

<h2>Log Activity</h2>
<p class="dashboard-subtitle">Riwayat aktivitas sistem rental kendaraan</p>

<!-- FILTER -->
<form method="get" style="margin-top:20px; display:flex; gap:10px; flex-wrap:wrap;">

    <input type="text" name="keyword" placeholder="Cari aktivitas..."
        value="<?= $_GET['keyword'] ?? '' ?>" style="padding:8px;">

    <select name="filter">
        <option value="semua">Semua Aktivitas</option>
        <option value="Login">Login</option>
        <option value="transaksi">Transaksi</option>
        <option value="Logout">Logout</option>
    </select>

    <select name="tanggal">
        <option value="semua">Semua Tanggal</option>
        <option value="hari_ini">Hari Ini</option>
        <option value="minggu_ini">7 Hari</option>
    </select>

    <button type="submit">Filter</button>

    <a href="<?= base_url('owner/log') ?>">
        <button type="button">Reset</button>
    </a>

</form>

<!-- LIST LOG -->
<div style="margin-top:20px;">

<?php if(empty($logs)): ?>
    <p>Tidak ada aktivitas</p>
<?php endif; ?>

<?php foreach($logs as $log): ?>

<?php 
    // 🎨 WARNA AKTIVITAS
    $color = '#ccc';

    if (strpos($log['aktivitas'], 'Login') !== false) {
        $color = 'green';
    } elseif (strpos($log['aktivitas'], 'Logout') !== false) {
        $color = 'red';
    } elseif (strpos($log['aktivitas'], 'transaksi') !== false) {
        $color = 'blue';
    }
?>

<div style="border-left:5px solid <?= $color ?>; background:#fff; padding:15px; margin-bottom:10px; border-radius:8px; box-shadow:0 2px 5px rgba(0,0,0,0.1);">
    
    <b>📌 <?= $log['aktivitas'] ?></b><br><br>

    👤 <b>User:</b> <?= $log['nama_user'] ?> (<?= $log['created_by_role'] ?>)<br>
    🌐 <b>IP:</b> <?= $log['ip_address'] ?><br>
    🕒 <b>Waktu:</b> <?= date('d M Y H:i', strtotime($log['created_at'])) ?>

</div>

<?php endforeach; ?>

</div>

<!-- PAGINATION -->
<div style="margin-top:20px;">
    <?= $pager->links() ?>
</div>

<?= $this->endSection() ?>