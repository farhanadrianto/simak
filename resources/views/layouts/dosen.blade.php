<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Dosen - SIMAK</title>

    <style>
        /* ===== GLOBAL RESET & FIX ===== */
        * {
            box-sizing: border-box;
        }

        html {
            background: #f8fafc; /* Latar belakang Off-White super bersih */
            overflow-y: auto;
        }

        body {
            margin: 0;
            display: flex;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f8fafc;
            color: #0f172a; /* Teks utama gelap elegan */
            min-height: 100vh;
            width: 100%;
            overflow-x: hidden;
        }

        /* ===== SIDEBAR COMPONENT ===== */
        .sidebar {
            width: 260px;
            min-width: 260px;
            background: #1c253c; /* Putih bersih kontras */
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 30px 20px;
            position: sticky;
            top: 0;
            left: 0;
            z-index: 99;
            border-right: 1px solid #e2e8f0;
            box-shadow: 4px 0 16px rgba(148, 163, 184, 0.03);
        }

        .logo {
            margin-bottom: 35px;
            padding-left: 8px;
        }

        .logo-title {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 1px;
            color: #1e40af; /* Aksen Biru Royal Khas Dosen */
        }

        .logo-sub {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            margin-top: 6px;
            letter-spacing: 1.2px;
        }

        /* ===== NAVIGATION MENU ===== */
        .menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 10px;
            text-decoration: none;
            color: #475569;
            transition: all 0.2s ease;
            font-size: 14px;
            font-weight: 600;
        }

        .menu a:hover {
            background: #f1f5f9;
            color: #1e40af;
        }

        .menu a.active {
            background: #eff6ff; /* Latar aktif biru lembut */
            color: #1d4ed8; /* Teks aktif biru tegas */
            font-weight: 700;
            border-left: 4px solid #2563eb;
            border-radius: 4px 10px 10px 4px;
            padding-left: 12px; /* Penyesuaian padding karena ada border kiri */
            pointer-events: none;
            cursor: default;
        }

        /* ===== MAIN AREA CONTENT ===== */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            width: 100%; 
        }

        /* ===== HEADER NAVBAR STRIP ===== */
        .header-strip {
            background: #ffffff;
            padding: 0 40px;
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e2e8f0;
            width: 100%;
        }

        .badge-dosen {
            display: inline-block;
            background: #eff6ff;
            color: #1e40af;
            padding: 8px 18px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 12px;
            letter-spacing: 0.5px;
            border: 1px solid rgba(37, 99, 235, 0.15);
            white-space: nowrap;
        }

        .date-info {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
        }

        /* ===== CONTENT BODY AREA ===== */
        .content {
            flex: 1;
            padding: 40px;
            width: 100%;
        }

        /* ===== SYSTEM LOGOUT SYSTEM ===== */
        .bottom {
            margin-top: auto;
            padding-top: 20px;
        }

        .logout {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid rgba(239, 68, 68, 0.2);
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 700;
            font-size: 14px;
        }

        .logout:hover {
            background: #e11d48;
            color: #ffffff;
            border-color: #e11d48;
            box-shadow: 0 4px 12px rgba(225, 29, 72, 0.15);
        }
    </style>
</head>

<body>

    <!-- SIDEBAR NAVIGATION -->
    <div class="sidebar">
        <div class="logo">
            <div class="logo-title">SIMAK</div>
            <div class="logo-sub">FAKULTAS ILMU KOMPUTER</div>
        </div>

        <div class="menu">
            {{-- Beranda --}}
            @if(request()->routeIs('dosen.dashboard'))
                <a class="active">🏠 Beranda</a>
            @else
                <a href="{{ route('dosen.dashboard') }}">🏠 Beranda</a>
            @endif

            {{-- Feedback Mahasiswa --}}
            @if(request()->is('dosen/feedback*'))
                <a class="active">💬 Feedback Mahasiswa</a>
            @else
                <a href="{{ route('dosen.feedback') }}">💬 Feedback Mahasiswa</a>
            @endif

            {{-- Approve KRS --}}
            @if(request()->is('dosen/approve-krs*'))
                <a class="active">📋 Approve KRS</a>
            @else
                <a href="{{ route('dosen.approve') }}">📋 Approve KRS</a>
            @endif

            {{-- Profil Saya --}}
            @if(request()->routeIs('dosen.profile'))
                <a class="active">👤 Profil Saya</a>
            @else
                <a href="{{ route('dosen.profile') }}">👤 Profil Saya</a>
            @endif
        </div>

        <div class="bottom">
            {{-- Logout Button --}}
            @if(request()->routeIs('dosen.dashboard'))
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout">🚪 Keluar</button>
                </form>
            @endif
        </div>
    </div>

    <!-- MAIN INTERFACE AREA -->
    <div class="main">
        <!-- TOP NAVBAR STRIP -->
        <div class="header-strip">
            <div class="badge-dosen">PORTAL DOSEN FIK</div>
            <div class="date-info">
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
            </div>
        </div>

        <!-- YIELD INNER CONTENT Component -->
        <div class="content">
            @yield('content')
        </div>
    </div>

</body>
</html>