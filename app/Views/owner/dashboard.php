<?= $this->extend('layouts/owner_sidebar') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="<?= base_url('css/dashboard_owner.css') ?>">


<div class="page-header">
    <h2 class="page-title">Dashboard Owner</h2>
    <p class="page-subtitle">Ringkasan Transaksi Hari Ini</p>
</div>


<div class="kpi-grid">

    <div class="kpi-card">
        <div class="kpi-icon kpi-icon-blue">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
        </div>
        <div class="kpi-content">
            <div class="kpi-value">Rp <?= number_format($pendapatanHari) ?></div>
            <div class="kpi-label">Pendapatan Hari Ini</div>
        </div>
    </div>

    <div class="kpi-card">
        <div class="kpi-icon kpi-icon-green">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/></svg>
        </div>
        <div class="kpi-content">
            <div class="kpi-value kpi-value-green">Rp <?= number_format($pendapatanBulan) ?></div>
            <div class="kpi-label">Pendapatan Bulan Ini</div>
        </div>
    </div>

    <div class="kpi-card">
        <div class="kpi-icon kpi-icon-orange">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm7 13H5v-.23c0-.62.28-1.2.76-1.58C7.47 15.82 9.64 15 12 15s4.53.82 6.24 2.19c.48.38.76.97.76 1.58V19z"/></svg>
        </div>
        <div class="kpi-content">
            <div class="kpi-value kpi-value-orange"><?= $totalTransaksiHari ?></div>
            <div class="kpi-label">Total Transaksi Hari Ini</div>
        </div>
    </div>

    <div class="kpi-card">
        <div class="kpi-icon kpi-icon-purple">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.5 16c-.83 0-1.5-.67-1.5-1.5S5.67 13 6.5 13s1.5.67 1.5 1.5S7.33 16 6.5 16zm11 0c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5 1.5.67 1.5 1.5-.67 1.5-1.5 1.5zM5 11l1.5-4.5h11L19 11H5z"/></svg>
        </div>
        <div class="kpi-content">
            <div class="kpi-value kpi-value-purple"><?= $kendaraanAktif ?></div>
            <div class="kpi-label">Kendaraan Aktif</div>
        </div>
    </div>

</div>

<div class="chart-section">
    <div class="chart-header">
        <h3 class="chart-title">Grafik Pendapatan 7 Hari</h3>
        <p class="chart-subtitle">Data 7 hari terakhir</p>
    </div>
    <div class="chart-card">
        <canvas id="chartPendapatan"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const labels = <?= json_encode(array_column($grafik, 'tanggal')) ?>;
const data = <?= json_encode(array_column($grafik, 'total')) ?>;

const ctx = document.getElementById('chartPendapatan');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Pendapatan',
            data: data,
            backgroundColor: '#1976d2',
            borderRadius: 8,
            borderSkipped: false,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    font: { size: 13 },
                    color: '#555'
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: '#f0f0f0' },
                ticks: { color: '#888', font: { size: 12 } }
            },
            x: {
                grid: { display: false },
                ticks: { color: '#888', font: { size: 12 } }
            }
        }
    }
});
</script>

<?= $this->endSection() ?>