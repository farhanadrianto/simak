<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa - SIMAK</title>

    <style>
        /* GLOBAL FIX */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            background: #f4f6f9; /* Mengurangi cereng, diubah ke off-white teduh */
            overflow-y: auto;
        }

        body {
            display: flex;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background: #f4f6f9; /* Background utama diturunkan kontrasnya */
            color: #1e293b; 
            min-height: 100vh;
            width: 100%;
            overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 260px;
            min-width: 260px;
            background: #1c253c; 
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 24px 20px;
            position: sticky;
            top: 0;
            left: 0;
            z-index: 99;
            border-right: 1px solid #e2e8f0; 
            box-shadow: 4px 0 24px rgba(148, 163, 184, 0.05); /* Shadow lebih natural */
        }

        .logo {
            margin-bottom: 35px;
            padding-left: 8px;
        }

        .logo-title {
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #059669; 
        }

        .logo-sub {
            font-size: 10px;
            font-weight: 700;
            color: #94a3b8;
            margin-top: 4px;
            letter-spacing: 1px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            text-decoration: none;
            color: #64748b; 
            transition: all 0.2s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .menu a:hover {
            background: #f1f5f9; 
            color: #0f172a;
        }

        .menu a.active {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%); 
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.25);
            pointer-events: none;
            cursor: default;
        }

        /* ===== MAIN AREA ===== */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0; 
            width: 100%;
        }

        /* ===== HEADER STRIP ===== */
        .header-strip {
            background: #ffffff; 
            padding: 0 40px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-shrink: 0;
            border-bottom: 1px solid #e2e8f0;
            width: 100%;
        }

        .badge-mhs {
            display: inline-block;
            background: rgba(16, 185, 129, 0.08);
            color: #059669;
            padding: 8px 18px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 12px;
            border: 1px solid rgba(16, 185, 129, 0.15);
            white-space: nowrap;
            letter-spacing: 0.5px;
        }

        .date-info {
            font-size: 13px;
            font-weight: 500;
            color: #64748b;
        }

        /* ===== CONTENT AREA ===== */
        .content {
            flex: 1;
            padding: 40px;
            width: 100%;
        }

        /* ===== BOTTOM ACTIONS (LOGOUT) ===== */
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

        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
                min-width: 80px;
                padding: 20px 10px;
                align-items: center;
            }
            .logo-sub, .menu a span, .logout-text {
                display: none;
            }
            .header-strip {
                padding: 0 20px;
            }
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">
            <div class="logo-title">SIMAK</div>
            <div class="logo-sub">FAKULTAS ILMU KOMPUTER</div>
        </div>

        <div class="menu">
            @if(request()->is('mhs/dashboard'))
                <a class="active">🏠 <span>Beranda</span></a>
            @else
                <a href="/mhs/dashboard">🏠 <span>Beranda</span></a>
            @endif

            @if(request()->is('mhs/feedback*'))
                <a class="active">💬 <span>Feedback</span></a>
            @else
                <a href="{{ route('mhs.feedback') }}">💬 <span>Feedback</span></a>
            @endif

            @if(request()->is('mhs/matkul'))
                <a class="active">📚 <span>Mata Kuliah Reguler</span></a>
            @else
                <a href="{{ route('mhs.matkul') }}">📚 <span>Mata Kuliah Reguler</span></a>
            @endif

            @if(request()->is('mhs/mku'))
                <a class="active">🎓 <span>Mata Kuliah Umum</span></a>
            @else
                <a href="{{ route('mhs.mku') }}">🎓 <span>Mata Kuliah Umum</span></a>
            @endif

            @if(request()->routeIs('mhs.krs'))
                <a class="active">📋 <span>KRS Saya</span></a>
            @else
                <a href="{{ route('mhs.krs') }}">📋 <span>KRS Saya</span></a>
            @endif

            @if(request()->routeIs('mhs.profile'))
                <a class="active">👤 <span>Profil Saya</span></a>
            @else
                <a href="{{ route('mhs.profile') }}">👤 <span>Profil Saya</span></a>
            @endif
        </div>

        <div class="bottom">
            @if(request()->is('mhs/dashboard'))
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout">🚪 <span class="logout-text">Keluar</span></button>
                </form>
            @endif
        </div>
    </div>

    <!-- MAIN AREA -->
    <div class="main">
        <div class="header-strip">
            <div class="badge-mhs">PORTAL MAHASISWA FIK</div>
            <div class="date-info">
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
            </div>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>

</body>
</html>