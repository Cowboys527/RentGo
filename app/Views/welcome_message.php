<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentGo — Sistem Rental Kendaraan</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Custom CSS — CI4: public/assets/css/welcome.css -->
    <link rel="stylesheet" href="<?= base_url('css/welcome_message.css') ?>">
</head>
<body>

    <!-- ════ Sun ════ -->
    <div class="sun"></div>

    <!-- ════ Clouds ════ -->
    <div class="cloud cloud-1"><div class="cloud-shape"></div></div>
    <div class="cloud cloud-2"><div class="cloud-shape"></div></div>
    <div class="cloud cloud-3"><div class="cloud-shape"></div></div>

    <!-- ════ Trees ════ -->
    <div class="trees" id="treesContainer"></div>

    <!-- ════ Road Scene ════ -->
    <div class="road-scene">
        <div class="grass"></div>
        <div class="sidewalk"></div>
        <div class="road-surface">
            <div class="road-dashes"></div>
        </div>
    </div>

    <!-- ════ Animated Car (Main) ════ -->
    <div class="car-wrapper">
        <div class="car">
            <div class="exhaust">
                <div class="puff"></div>
                <div class="puff"></div>
                <div class="puff"></div>
            </div>
            <div class="car-bumper-r"></div>
            <div class="car-bumper-f"></div>
            <div class="car-body"></div>
            <div class="car-roof"></div>
            <div class="car-window-rear"></div>
            <div class="car-window-front"></div>
            <div class="car-door-line"></div>
            <div class="car-taillight"></div>
            <div class="car-headlight"></div>
            <div class="wheel wheel-rear"></div>
            <div class="wheel wheel-front"></div>
            <div class="car-label">RentGo</div>
        </div>
    </div>

    <!-- ════ Welcome Card ════ -->
    <div class="welcome-card">
        <div class="card-accent-bar"></div> 

        <!-- Logo -->
        <div class="text-center">
            <div class="logo-wrap">
                <div class="logo-icon-box">🚗</div>
                <div class="logo-text">Rent<span>Go</span></div>
            </div>

            <!-- Badge -->
            <div class="d-flex justify-content-center">
                <div class="system-badge">
                    <div class="badge-dot"></div>
                    Rental Kendaraan
                </div>
            </div>
        </div>

        <div class="card-divider"></div>

        <!-- Welcome Text -->
        <div class="text-center">
            <div class="welcome-title">Selamat Datang 👋</div>
            <p class="welcome-desc">
                Kelola pemesanan, dan melayani Anda dengan mudah.
            </p>
        </div>

        <!-- Login Button -->
        <a href="<?= base_url('login') ?>" class="btn-login">
            <span>Masuk</span>
        </a>


        <!-- Brand Strip — di dalam card, di bawah footer -->
        <div class="brand-strip">
            <span>RentGo</span>
            <div class="brand-dot"></div>
            <span>v1.0.0</span>
            <div class="brand-dot"></div>
            <span>© 2026</span>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Trees & Second Car Script -->
    <script>
        // ── Generate Trees ──
        const container = document.getElementById('treesContainer');
        const treeData = [
            { left: 3,  size: 1.0 }, { left: 8,  size: 0.8 },
            { left: 15, size: 1.2 }, { left: 22, size: 0.9 },
            { left: 30, size: 1.1 }, { left: 38, size: 0.85 },
            { left: 48, size: 1.3 }, { left: 57, size: 0.9 },
            { left: 65, size: 1.0 }, { left: 73, size: 1.15 },
            { left: 80, size: 0.8 }, { left: 87, size: 1.05 },
            { left: 93, size: 0.95 },{ left: 98, size: 1.1 },
        ];

        const greens = ['#388e3c','#43a047','#2e7d32','#1b5e20','#66bb6a'];

        treeData.forEach(t => {
            const tree  = document.createElement('div');
            tree.className = 'tree';
            tree.style.left = t.left + '%';

            const color = greens[Math.floor(Math.random() * greens.length)];
            const h     = Math.round(52 * t.size);
            const w     = Math.round(36 * t.size);

            tree.innerHTML = `
                <div class="tree-top" style="
                    border-left-width:${w/2}px;
                    border-right-width:${w/2}px;
                    border-bottom-width:${h}px;
                    border-bottom-color:${color};
                "></div>
                <div class="tree-trunk" style="
                    width:${Math.round(9*t.size)}px;
                    height:${Math.round(16*t.size)}px;
                "></div>
            `;
            container.appendChild(tree);
        });

        // ── Second Car (red, smaller, slower) ──
        const style2 = document.createElement('style');
        style2.textContent = `
            @keyframes carDrive2 { 0%{left:-120px} 100%{left:110vw} }
        `;
        document.head.appendChild(style2);

        const car2 = document.createElement('div');
        car2.style.cssText = `
            position: fixed;
            bottom: 88px;
            left: -120px;
            z-index: 8;
            transform: scale(0.55);
            transform-origin: bottom left;
            animation: carDrive2 18s linear infinite;
            animation-delay: 6s;
            opacity: 0.7;
        `;
        car2.innerHTML = document.querySelector('.car-wrapper .car').outerHTML;

        car2.querySelectorAll('.car-body, .car-roof').forEach(el => {
            el.style.background = 'linear-gradient(135deg, #e53935 0%, #ef5350 60%, #ef9a9a 100%)';
        });
        car2.querySelectorAll('.car-bumper-r, .car-bumper-f').forEach(el => {
            el.style.background = '#b71c1c';
        });
        car2.querySelector('.car-label').textContent = '';

        document.body.appendChild(car2);
    </script>

</body>
</html>