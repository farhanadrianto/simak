<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal SIMAK FIK</title>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        :root {
            /* Tema warna disesuaikan: Latar belakang medium-light, card putih bersih */
            --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #334155 100%);
            --bg-card: #ffffff;
            
            --text-title: #1e293b;
            --text-desc: #64748b;
            --border-color: #e2e8f0;

            /* Aksen warna disesuaikan dengan tema halaman login masing-masing role */
            --accent-mhs-start: #1e3a8a;
            --accent-mhs-end: #3b82f6;
            
            --accent-dosen-start: #4c1d95;
            --accent-dosen-end: #7c3aed;
            
            --accent-admin-start: #667eea;
            --accent-admin-end: #764ba2;

            --font: 'Plus Jakarta Sans', sans-serif;
            --radius: 16px;
            --shadow-card: 0 10px 30px rgba(0, 0, 0, 0.15), 0 1px 3px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 20px 40px rgba(30, 58, 138, 0.25);
        }

        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font);
            background: var(--bg-gradient);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── NAVBAR ──────────────────────────────── */
        .navbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 48px;
            height: 65px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(15, 23, 42, 0.6);
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
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 800;
            color: #ffffff;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .brand-name {
            font-size: 16px;
            font-weight: 700;
            color: #ffffff;
        }

        .brand-name strong {
            font-weight: 800;
            color: #38bdf8;
        }

        .navbar-right {
            font-size: 13px;
            color: #cbd5e1;
            font-weight: 500;
        }

        /* ── HERO ────────────────────────────────── */
        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            text-align: center;
        }

        .hero-title {
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -1px;
            margin-bottom: 12px;
        }

        .hero-title em {
            font-style: normal;
            background: linear-gradient(135deg, #38bdf8, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 15px;
            color: #e2e8f0;
            max-width: 520px;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        /* ── ROLE CARDS CONTAINER ────────────────── */
        .cards-wrapper {
            width: 100%;
            max-width: 1000px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            padding: 10px;
        }

        /* ── INDIVIDUAL CARD (WHITE THEME) ───────── */
        .role-card {
            background: var(--bg-card);
            border-radius: var(--radius);
            padding: 35px 30px;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
            box-shadow: var(--shadow-card);
            transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1), box-shadow 0.3s ease;
            border: 1px solid var(--border-color);
        }

        .role-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
        }

        /* Card Top Header */
        .card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .card-logo-letter {
            font-size: 36px;
            font-weight: 800;
        }

        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        /* Card Body Content */
        .card-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-title);
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }

        .card-desc {
            font-size: 14px;
            color: var(--text-desc);
            line-height: 1.6;
            flex: 1;
            margin-bottom: 30px;
        }

        /* Card Button style action */
        .card-btn {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            text-align: center;
            transition: opacity 0.2s;
        }

        .role-card:hover .card-btn {
            opacity: 0.9;
        }

        /* ── SPECIFIC ROLE STYLES ───────────────── */
        
        /* 1. Mahasiswa (Biru Navy) */
        .role-card.mhs .card-logo-letter { color: var(--accent-mhs-start); }
        .role-card.mhs .card-icon { 
            background: rgba(30, 58, 138, 0.1); 
        }
        .role-card.mhs .card-btn {
            background: linear-gradient(135deg, var(--accent-mhs-start) 0%, var(--accent-mhs-end) 100%);
        }

        /* 2. Dosen (Ungu) */
        .role-card.dosen .card-logo-letter { color: var(--accent-dosen-start); }
        .role-card.dosen .card-icon { 
            background: rgba(76, 29, 149, 0.1); 
        }
        .role-card.dosen .card-btn {
            background: linear-gradient(135deg, var(--accent-dosen-start) 0%, var(--accent-dosen-end) 100%);
        }

        /* 3. Admin (Indigo/Purple Gradient) */
        .role-card.admin .card-logo-letter { color: var(--accent-admin-start); }
        .role-card.admin .card-icon { 
            background: rgba(102, 126, 234, 0.1); 
        }
        .role-card.admin .card-btn {
            background: linear-gradient(135deg, var(--accent-admin-start) 0%, var(--accent-admin-end) 100%);
        }

        /* ── FOOTER ──────────────────────────────── */
        footer {
            padding: 24px 48px;
            text-align: center;
            font-size: 13px;
            color: #cbd5e1;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(15, 23, 42, 0.4);
        }

        /* ── RESPONSIVE ──────────────────────────── */
        @media (max-width: 900px) {
            .cards-wrapper {
                grid-template-columns: 1fr;
                max-width: 400px;
                gap: 20px;
            }
            .navbar {
                padding: 0 24px;
            }
            .hero {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="#" class="navbar-brand">
            <div class="brand-box">FIK</div>
            <span class="brand-name">SIMAK <strong>2026</strong></span>
        </a>
        <span class="navbar-right">Fakultas Ilmu Komputer</span>
    </nav>

    <main class="hero">
        <h1 class="hero-title">
            Portal <em>SIMAK</em> FIK
        </h1>
        <p class="hero-subtitle">
            Selamat datang. Silakan pilih jenis akun Anda untuk melanjutkan akses layanan Sistem Informasi Manajemen Akademik.
        </p>

        <div class="cards-wrapper">

            <a href="login/mhs" class="role-card mhs">
                <div class="card-top">
                    <div class="card-logo-letter">M</div>
                    <div class="card-icon">🎓</div>
                </div>
                <h2 class="card-title">Mahasiswa</h2>
                <p class="card-desc">Akses pengisian KRS, lihat jadwal perkuliahan, nilai akademik, serta papan pengumuman mahasiswa.</p>
                <div class="card-btn">Masuk Portal Mhs →</div>
            </a>

            <a href="login/dosen" class="role-card dosen">
                <div class="card-top">
                    <div class="card-logo-letter">D</div>
                    <div class="card-icon">🧑‍🏫</div>
                </div>
                <h2 class="card-title">Dosen</h2>
                <p class="card-desc">Manajemen perwalian mahasiswa, peninjauan rencana studi (KRS), serta pengisian nilai dan feedback.</p>
                <div class="card-btn">Masuk Portal Dosen →</div>
            </a>

            <a href="login/admin" class="role-card admin">
                <div class="card-top">
                    <div class="card-logo-letter">A</div> <div class="card-icon">🛠️</div>
                </div>
                <h2 class="card-title">Admin</h2>
                <p class="card-desc">Kelola data kurikulum, sinkronisasi jadwal mata kuliah, manajemen akun pengguna, serta publikasi pengumuman.</p>
                <div class="card-btn">Masuk Portal Admin →</div>
            </a>

        </div>
    </main>

    <footer>
        &copy; 2026 &mdash; SIMAK FIK. All rights reserved.
    </footer>

</body>
</html>