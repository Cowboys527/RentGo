<?= $this->extend('layouts/admin_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/user/index.css') ?>">

<div class="user-container">

<div class="page-header">
    <div class="header-left">
        <h2 class="page-title">Data User</h2>
        <p class="page-subtitle">Kelola data pengguna sistem</p>
    </div>
    <a href="/admin/user/tambah" class="btn-add">
        <span>Tambah User</span>
    </a>
</div>

<?php if(session()->getFlashdata('success_user')): ?>
    <div class="alert-success">
        <?= session()->getFlashdata('success_user') ?>
    </div>
<?php endif; ?>

<div class="filter-bar">
    <form method="get" action="/admin/user" class="search-form">
        <div class="search-box">
            <input type="text" name="keyword" class="search-input"
                   placeholder="Cari username / nama"
                   value="<?= $keyword ?? '' ?>">
            
            <select name="role" class="filter-select">
                <option value="">-- Semua Role --</option>
                <option value="admin" <?= ($role=='admin')?'selected':'' ?>>Admin</option>
                <option value="kasir" <?= ($role=='kasir')?'selected':'' ?>>Kasir</option>
                <option value="owner" <?= ($role=='owner')?'selected':'' ?>>Owner</option>
            </select>

            <button type="submit" class="btn-search">Search</button>
            <a href="/admin/user" class="btn-reset">Reset</a>
        </div>
    </form>
</div>

<div class="table-card">
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($user as $u): ?>
            <tr>
                <td><span class="table-no"><?= $no++ ?></span></td>
                <td class="td-bold"><?= esc($u['username']) ?></td>
                <td><?= esc($u['nama']) ?></td>
                <td>
                    <?php if($u['role']=='admin'): ?>
                        <span class="role-badge role-admin">Admin</span>
                    <?php elseif($u['role']=='kasir'): ?>
                        <span class="role-badge role-kasir">Kasir</span>
                    <?php else: ?>
                        <span class="role-badge role-owner">Owner</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($u['status']=='aktif'): ?>
                        <span class="status-badge status-aktif">Aktif</span>
                    <?php else: ?>
                        <span class="status-badge status-nonaktif">Nonaktif</span>
                    <?php endif; ?>
                </td>
                <td>
                    <div class="action-buttons">
                        <a href="/admin/user/edit/<?= $u['id_user'] ?>" class="btn-action btn-edit">Edit</a>
                        <a href="/admin/user/hapus/<?= $u['id_user'] ?>" 
                           class="btn-action btn-delete"
                           onclick="return confirm('Yakin hapus user?')">Hapus</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>

            <?php if(empty($user)): ?>
            <tr>
                <td colspan="6" class="empty-state">Tidak ada data</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>


<div class="pagination-wrapper">
    <?= $pager->links() ?>
</div>

</div>

<?= $this->endSection() ?>