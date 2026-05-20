<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal SIMAK FIK</title>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

:root {
    --bg:           #0f1419;
    --bg-overlay:   #1a202c;
    --bg-card:      rgba(30, 41, 59, 0.6);
    --bg-card-hover: rgba(30, 41, 59, 0.8);
    --text-primary: #f8fafc;
    --text-secondary: #cbd5e1;
    --text-muted:   #94a3b8;
    --border:       rgba(148, 163, 184, 0.1);
    --border-card:  rgba(148, 163, 184, 0.15);
    --accent-mhs:   #3b82f6;
    --accent-dosen: #14b8a6;
    --accent-admin: #ef4444;
    --font-display: 'Instrument Serif', serif;
    --font:         'Plus Jakarta Sans', sans-serif;
    --radius:       18px;
    --shadow-card:  0 8px 32px rgba(0, 0, 0, 0.4), 0 2px 8px rgba(0, 0, 0, 0.2);
    --shadow-hover: 0 12px 48px rgba(0, 0, 0, 0.6), 0 4px 12px rgba(0, 0, 0, 0.3);
}

*, *::before, *::after {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: var(--font);
    background: linear-gradient(135deg, #0f1419 0%, #1a202c 100%);
    color: var(--text-primary);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}

/* ── NOISE TEXTURE OVERLAY ───────────────── */

body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.02'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 0;
    opacity: 0.4;
}

/* ── NAVBAR ──────────────────────────────── */

.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 48px;
    height: 60px;
    border-bottom: 1px solid var(--border);
    background: rgba(15, 20, 25, 0.75);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    position: sticky;
    top: 0;
    z-index: 100;
}

.navbar-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

.brand-box {
    width: 34px;
    height: 34px;
    background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: 800;
    color: #ffffff;
    letter-spacing: -0.5px;
    flex-shrink: 0;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.brand-name {
    font-size: 15px;
    font-weight: 700;
    color: var(--text-primary);
    letter-spacing: -0.3px;
}

.brand-name strong {
    font-weight: 800;
    background: linear-gradient(135deg, #3b82f6, #14b8a6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.navbar-right {
    font-size: 13px;
    color: var(--text-muted);
    font-weight: 500;
    letter-spacing: 0.2px;
}

/* ── HERO ────────────────────────────────── */

.hero {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 64px 24px 40px;
    text-align: center;
    position: relative;
    z-index: 1;
}

.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.8px;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 28px;
}

.hero-eyebrow::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #ef4444;
    flex-shrink: 0;
}

.hero-title {
    font-family: var(--font-display);
    font-size: clamp(56px, 8vw, 96px);
    font-weight: 400;
    line-height: 1.0;
    letter-spacing: -2px;
    color: var(--text-primary);
    margin-bottom: 20px;
}

.hero-title em {
    font-style: italic;
    background: linear-gradient(135deg, #3b82f6, #14b8a6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-subtitle {
    font-size: 15px;
    color: var(--text-secondary);
    max-width: 480px;
    line-height: 1.7;
    margin-bottom: 56px;
}

/* ── ROLE CARDS ──────────────────────────── */

.cards-wrapper {
    width: 100%;
    max-width: 960px;
    background: var(--bg-card);
    border: 1px solid var(--border-card);
    border-radius: 24px;
    box-shadow: var(--shadow-card);
    overflow: hidden;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
}

.role-card {
    padding: 36px 32px 40px;
    display: flex;
    flex-direction: column;
    gap: 0;
    border-right: 1px solid var(--border-card);
    transition: all 0.3s ease;
    position: relative;
    text-decoration: none;
    color: inherit;
}

.role-card:last-child {
    border-right: none;
}

.role-card:hover {
    background: var(--bg-card-hover);
    transform: translateY(-4px);
}

/* top row: number + icon */
.card-top {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    margin-bottom: 28px;
}

.card-number {
    font-size: 11px;
    font-weight: 600;
    color: var(--text-muted);
    letter-spacing: 0.5px;
    margin-top: 2px;
}

.card-icon {
    width: 52px;
    height: 52px;
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.2);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.role-card:hover .card-icon {
    background: rgba(59, 130, 246, 0.15);
    border-color: rgba(59, 130, 246, 0.3);
}

/* content */
.card-role-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.4px;
    text-transform: uppercase;
    margin-bottom: 8px;
}

.role-card.mhs    .card-role-label { color: var(--accent-mhs); }
.role-card.dosen  .card-role-label { color: var(--accent-dosen); }
.role-card.admin  .card-role-label { color: var(--accent-admin); }

.card-title {
    font-family: var(--font-display);
    font-size: 26px;
    font-weight: 400;
    color: var(--text-primary);
    letter-spacing: -0.5px;
    margin-bottom: 12px;
    line-height: 1.15;
}

.card-desc {
    font-size: 13px;
    color: var(--text-secondary);
    line-height: 1.65;
    flex: 1;
    margin-bottom: 28px;
}

/* divider + link */
.card-link {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    padding-top: 20px;
    border-top: 1px solid var(--border-card);
    transition: gap 0.2s;
}

.role-card.mhs   .card-link { color: var(--accent-mhs); }
.role-card.dosen .card-link { color: var(--accent-dosen); }
.role-card.admin .card-link { color: var(--accent-admin); }

.role-card:hover .card-link {
    gap: 10px;
}

/* ── FOOTER ──────────────────────────────── */

footer {
    padding: 28px 48px;
    text-align: center;
    font-size: 12px;
    color: var(--text-muted);
    border-top: 1px solid var(--border);
    position: relative;
    z-index: 1;
}

/* ── RESPONSIVE ──────────────────────────── */

@media (max-width: 768px) {
    .navbar {
        padding: 0 20px;
    }

    .hero {
        padding: 40px 20px 32px;
    }

    .cards-wrapper {
        grid-template-columns: 1fr;
        border-radius: 16px;
        max-width: 420px;
    }

    .role-card {
        border-right: none;
        border-bottom: 1px solid var(--border-card);
    }

    .role-card:last-child {
        border-bottom: none;
    }

    footer {
        padding: 20px;
    }
}
    </style>

</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <a href="index.php" class="navbar-brand">
            <div class="brand-box">FIK</div>
            <span class="brand-name">SIMAK <strong>2026</strong></span>
        </a>
        <span class="navbar-right">Fakultas Ilmu Komputer</span>
    </nav>

    <!-- HERO -->
    <main class="hero">

        <span class="hero-eyebrow">Sistem Informasi Manajemen Akademik</span>

        <h1 class="hero-title">
            Portal <em>SIMAK</em><br>FIK.
        </h1>

        <p class="hero-subtitle">
            Pilih peran Anda untuk mengakses layanan akademik Fakultas Ilmu Komputer.
        </p>

        <!-- ROLE CARDS -->
        <div class="cards-wrapper">

            <!-- MAHASISWA -->
            <div class="role-card mhs">
                <div class="card-top">
                    <span class="card-number">01</span>
                    <div class="card-icon">🎓</div>
                </div>
                <span class="card-role-label">Mahasiswa</span>
                <h2 class="card-title">Portal Mahasiswa</h2>
                <p class="card-desc">Ambil KRS, lihat jadwal kuliah, lihat pengumuman</p>
                <a href="login/mhs" class="card-link">Masuk →</a>
            </div>

            <!-- DOSEN -->
            <div class="role-card dosen">
                <div class="card-top">
                    <span class="card-number">02</span>
                    <div class="card-icon">🧑‍🏫</div>
                </div>
                <span class="card-role-label">Dosen</span>
                <h2 class="card-title">Portal Dosen</h2>
                <p class="card-desc">Tinjau KRS dan Feedback mahasiswa.</p>
                <a href="login/dosen" class="card-link">Masuk →</a>
            </div>

            <!-- ADMIN -->
            <div class="role-card admin">
                <div class="card-top">
                    <span class="card-number">03</span>
                    <div class="card-icon">🛠️</div>
                </div>
                <span class="card-role-label">Admin</span>
                <h2 class="card-title">Portal Admin</h2>
                <p class="card-desc">Buat pengumuman, dan kelola mata kuliah.</p>
                <a href="login/admin" class="card-link">Masuk →</a>
            </div>

        </div>

    </main>

    <footer>
        &copy; <?= date('Y') ?> &mdash; SIMAK FIK. All rights reserved.
    </footer>

</body>
</html>
