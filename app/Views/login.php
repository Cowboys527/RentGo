<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — RentGo</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('css/login.css') ?>">
</head>
<body>

    <!-- Background -->
    <div class="sun"></div>
    <div class="cloud cloud-1"><div class="cloud-shape"></div></div>
    <div class="cloud cloud-2"><div class="cloud-shape"></div></div>
    <div class="cloud cloud-3"><div class="cloud-shape"></div></div>

   <div class="login-container">

    <!-- LEFT SIDE -->
    <div class="login-left">

        <!-- Phone Mockup -->
        <div class="phone-mockup">
            <div class="phone-screen">

                <div class="phone-logo">RentGo</div>
                <div class="phone-subtitle">
                    Welcome to<br>Vehicle Rental
                </div>

                <svg class="phone-car-img" viewBox="0 0 200 120" fill="none">
                    <rect x="20" y="60" width="160" height="35" rx="6" fill="#E3F2FD"/>
                    <rect x="50" y="35" width="100" height="30" rx="12" fill="#BBDEFB"/>
                    <circle cx="60" cy="100" r="15" fill="#37474F"/>
                    <circle cx="140" cy="100" r="15" fill="#37474F"/>
                    <circle cx="60" cy="100" r="8" fill="#78909C"/>
                    <circle cx="140" cy="100" r="8" fill="#78909C"/>
                </svg>

                <button class="phone-btn">Rent</button>
            </div>
        </div>

        <!-- Car Illustration -->
        <svg class="car-illustration" viewBox="0 0 400 200" fill="none">
            <ellipse cx="200" cy="180" rx="180" ry="20" fill="rgba(0,0,0,0.08)"/>

            <path d="M80 120 L60 140 L340 140 L320 120 Z" fill="#1976D2"/>
            <rect x="60" y="140" width="280" height="40" rx="8" fill="#1976D2"/>

            <path d="M140 80 L100 120 L300 120 L260 80 Z"
                  fill="#1565C0" stroke="#0D47A1" stroke-width="2"/>

            <path d="M145 85 L110 115 L185 115 L180 85 Z"
                  fill="#B3E5FC" opacity="0.7"/>

            <path d="M215 85 L210 115 L285 115 L255 85 Z"
                  fill="#B3E5FC" opacity="0.7"/>

            <circle cx="120" cy="175" r="28" fill="#212121"/>
            <circle cx="120" cy="175" r="18" fill="#424242"/>
            <circle cx="120" cy="175" r="10" fill="#757575"/>

            <circle cx="280" cy="175" r="28" fill="#212121"/>
            <circle cx="280" cy="175" r="18" fill="#424242"/>
            <circle cx="280" cy="175" r="10" fill="#757575"/>

            <ellipse cx="330" cy="150" rx="8" ry="6" fill="#FFF9C4"/>

            <line x1="200" y1="120" x2="200" y2="160"
                  stroke="rgba(255,255,255,0.2)" stroke-width="2"/>
        </svg>

    </div>
    <!-- END LEFT SIDE -->


    <!-- RIGHT SIDE -->
    <div class="login-right">

        <div class="login-header">
            <h1 class="login-title">Rent<span>Go</span></h1>
            <p class="login-subtitle">Sistem Rental Kendaraan</p>
        </div>

        <div class="login-divider"></div>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/login') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" name="username"
                    class="form-control"
                    placeholder="Masukkan username"
                    required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                    class="form-control"
                    placeholder="Masukkan password"
                    required>
            </div>

            <button type="submit" class="btn-submit">Login</button>
            <div class="back-link">
              <a href="<?= base_url('/') ?>">← Keluar</a>
            </div>

        </form>

    </div>
    <!-- END RIGHT SIDE -->

</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
