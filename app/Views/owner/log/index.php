<?= $this->extend('layouts/owner_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/log/index.css') ?>">

<div class="page-header">
    <h2 class="page-title">Log Activity</h2>
    <p class="page-subtitle">Riwayat aktivitas sistem rental kendaraan</p>
</div>

<!-- FILTER -->
<form method="get" class="filter-bar">

    <div class="search-wrapper">
        <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
        <input type="text" name="keyword" placeholder="Cari aktivitas..."
            value="<?= $_GET['keyword'] ?? '' ?>" class="filter-input filter-search">
    </div>

    <select name="filter" class="filter-select">
        <option value="semua">Semua Aktivitas</option>
        <option value="Login">Login</option>
        <option value="transaksi">Transaksi</option>
        <option value="Logout">Logout</option>
        <option value="kendaraan">Kendaraan</option>
    </select>

    <select name="tanggal" class="filter-select">
        <option value="semua">Semua Tanggal</option>
        <option value="hari_ini">Hari Ini</option>
        <option value="minggu_ini">7 Hari</option>
    </select>

    <button type="submit" class="btn-filter">Filter</button>

    <a href="<?= base_url('owner/log') ?>" style="text-decoration:none;">
        <button type="button" class="btn-reset">Reset</button>
    </a>

</form>

<!-- LIST LOG -->
<div class="log-list">

<?php if(empty($logs)): ?>
    <div class="empty-state">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#ccc" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="M12 8v4m0 4h.01"/></svg>
        <p>Tidak ada aktivitas</p>
    </div>
<?php endif; ?>

<?php foreach($logs as $log): ?>

<?php 
    if (strpos($log['aktivitas'], 'Login') !== false) {
        $color = 'green';
        $badge_class = 'badge-login';
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11 7L9.6 8.4l2.6 2.6H2v2h10.2l-2.6 2.6L11 17l5-5-5-5zm9 12h-8v2h8c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2h-8v2h8v14z"/></svg>';
        $icon_bg = 'icon-bg-green';
    } elseif (strpos($log['aktivitas'], 'Logout') !== false) {
        $color = 'red';
        $badge_class = 'badge-logout';
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M17 7l-1.4 1.4 2.6 2.6H9v2h9.2l-2.6 2.6L17 17l5-5-5-5zM5 5h8V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H5V5z"/></svg>';
        $icon_bg = 'icon-bg-red';
    } elseif (strpos($log['aktivitas'], 'transaksi') !== false) {
        $color = 'blue';
        $badge_class = 'badge-transaksi';
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.11 0-2 .89-2 2v12c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V6c0-1.11-.89-2-2-2zm0 14H4v-6h16v6zm0-10H4V6h16v2z"/></svg>';
        $icon_bg = 'icon-bg-blue';
    } elseif (strpos($log['aktivitas'], 'kendaraan') !== false) {
        $color = 'orange';
        $badge_class = 'badge-kendaraan';
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99z"/></svg>';
        $icon_bg = 'icon-bg-orange';
    } else {
        $color = 'gray';
        $badge_class = 'badge-other';
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>';
        $icon_bg = 'icon-bg-gray';
    }
?>

<div class="log-card log-card-<?= $color ?>">
    <div class="log-icon <?= $icon_bg ?>">
        <?= $icon ?>
    </div>
    <div class="log-body">
        <div class="log-title"><?= $log['aktivitas'] ?></div>
        <div class="log-meta">
            <span class="log-meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                <?= $log['nama_user'] ?> (<?= $log['created_by_role'] ?>)
            </span>
            <span class="log-meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                <?= $log['ip_address'] ?>
            </span>
            <span class="log-meta-item">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="currentColor"><path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67V7z"/></svg>
                <?= date('d M Y H:i', strtotime($log['created_at'])) ?>
            </span>
        </div>
    </div>
    <span class="log-badge <?= $badge_class ?>">
        <?php
            if (strpos($log['aktivitas'], 'Login') !== false) echo 'Login';
            elseif (strpos($log['aktivitas'], 'Logout') !== false) echo 'Logout';
            elseif (strpos($log['aktivitas'], 'transaksi') !== false) echo 'Transaksi';
            elseif (strpos($log['aktivitas'], 'kendaraan') !== false) echo 'Kendaraan';
            else echo 'Aktivitas';
        ?>
    </span>
</div>

<?php endforeach; ?>

</div>

<!-- PAGINATION -->
<div class="pager-wrapper">
    <?= $pager->links() ?>
</div>

<?= $this->endSection() ?>