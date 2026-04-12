<!DOCTYPE html>
<html>
<head>
    <title>Owner Panel - RentGo</title>
    <link rel="stylesheet" href="<?= base_url('css/admin_sidebar.css') ?>">
    <link rel="preload" as="image" href="<?= base_url('img/logo.png') ?>">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
</head>

<body>

<div class="admin-wrapper">

    <div class="sidebar">

        <div class="logo">
            <img src="<?= base_url('img/logo.png') ?>" alt="RentGo">
        </div>

        <ul class="menu">

            <li>
                <a href="<?= base_url('owner/dashboard') ?>">
                    <span class="material-icons">dashboard</span>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="<?= base_url('owner/laporan') ?>">
                    <span class="material-icons">bar_chart</span>
                    Laporan Transaksi
                </a>
            </li>

            <li>
                <a href="<?= base_url('owner/log') ?>">
                    <span class="material-icons">history</span>
                    Log Activity
                </a>
            </li>

        </ul>

        <a href="<?= base_url('logout') ?>" class="logout-btn">Logout</a>

    </div>

    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>

</div>

</body>
</html>