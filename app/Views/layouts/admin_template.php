<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - RentGo</title>
    <link rel="stylesheet" href="/css/admin.css">
</head>

<body>

<div class="sidebar">
    <h2>RentGo Admin</h2>

    <ul>
        <li><a href="/admin/dashboard">Dashboard</a></li>
        <li><a href="#">Data Kendaraan</a></li>
        <li><a href="#">Data User</a></li>
        <li><a href="#">Log Aktivitas</a></li>
        <li><a href="/logout">Logout</a></li>
    </ul>
</div>

<div class="content">
    <?= $this->renderSection('content') ?>
</div>

</body>
</html>
