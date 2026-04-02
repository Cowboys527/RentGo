<!DOCTYPE html>
<html>
<head>
    <title>Kasir Panel - RentGo</title>
    <link rel="stylesheet" href="<?= base_url('css/admin_sidebar.css') ?>">
    <link rel="preload" as="image" href="<?= base_url('img/logo.png') ?>">

    <!-- Material Icons -->
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
                <a href="/kasir/dashboard">
                    <span class="material-icons">dashboard</span>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="/kasir/transaksi">
                    <span class="material-icons">assignment</span>
                    Daftar Transaksi
                </a>
            </li>
        </ul>

        <a href="/logout" class="logout-btn">Logout</a>

    </div>

    <div class="content">
        <?= $this->renderSection('content') ?>
    </div>

</div>

</body>
</html>