<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - RentGo</title>
    <link rel="stylesheet" href="/css/admin_sidebar.css">

    <!-- ICON (Material Icons) -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
</head>

<body>

<div class="admin-wrapper">

    <div class="sidebar">

        <div class="logo">
            <img src="/img/logo.png" alt="RentGo" class="logo-img">
            <h3>RentGo</h3>
        </div>

        <ul class="menu">
            <li>
                <a href="/admin/dashboard">
                    <span class="material-icons">dashboard</span>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="/admin/kendaraan">
                    <span class="material-icons">directions_car</span>
                    Data Kendaraan
                </a>
            </li>

            <li>
                <a href="/admin/user">
                    <span class="material-icons">people</span>
                    Data User
                </a>
            </li>

            <li>
                <a href="/admin/transaksi">
                    <span class="material-icons">receipt_long</span>
                    Lihat Transaksi
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
