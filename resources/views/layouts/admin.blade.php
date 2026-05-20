<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - SIMAK</title>

    <style>
        /* GLOBAL FIX */
        * {
            box-sizing: border-box;
        }

        html {
            background: #0b1220; 
            overflow-y: auto;
        }

        body {
            margin: 0;
            display: flex;
            font-family: 'Inter', sans-serif;
            background: #0b1220;
            color: white;
            min-height: 100vh;
            /* FIX: Ubah fit-content menjadi 100% */
            width: 100%;
            overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 240px;
            min-width: 240px;
            background: #020617;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 20px;
            position: sticky;
            top: 0;
            left: 0;
            z-index: 99;
            border-right: 1px solid #1e293b;
        }

        .logo {
            margin-bottom: 30px;
        }

        .logo-title {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 1px;
            color: #4f46e5; 
        }

        .logo-sub {
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
            letter-spacing: 1px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 10px;
            text-decoration: none;
            color: #9ca3af;
            transition: 0.2s;
            font-size: 14px;
        }

        .menu a:hover {
            background: #1e293b;
            color: white;
        }

        .menu a.active {
            background: rgba(79, 70, 229, 0.15);
            color: #818cf8;
            border: 1px solid rgba(79, 70, 229, 0.3);
            font-weight: 600;
            pointer-events: none;
            cursor: default;
        }

        /* ===== MAIN AREA ===== */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0; 
            /* FIX: Pastikan mengisi sisa ruang */
            width: 100%;
        }

        /* ===== HEADER STRIP ===== */
        .header-strip {
            background: #020617;
            padding: 20px 30px;
            flex-shrink: 0;
            border-bottom: 1px solid #1e293b;
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* FIX: Pastikan header selebar area main */
            width: 100%;
        }

        .badge-admin {
            display: inline-block;
            background: rgba(79, 70, 229, 0.15);
            color: #818cf8;
            padding: 8px 18px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 13px;
            border: 1px solid rgba(79, 70, 229, 0.3);
            white-space: nowrap;
        }

        /* ===== CONTENT AREA ===== */
        .content {
            flex: 1;
            padding: 30px;
            width: 100%;
        }

        /* ===== LOGOUT BUTTON ===== */
        .bottom {
            margin-top: auto;
            padding-bottom: 20px;
        }

        .logout {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            text-align: center;
            background: #3f1d1d;
            color: #fca5a5;
            border: 1px solid #7f1d1d;
            cursor: pointer;
            transition: 0.3s;
            font-weight: 600;
        }

        .logout:hover {
            background: #7f1d1d;
            color: white;
        }

        .card-admin {
            background: #111827;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #1f2937;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">
            <div class="logo-title">SIMAK</div>
            <div class="logo-sub">ADMIN PANEL</div>
        </div>

        <div class="menu">
            <!-- Dashboard -->
            @if(request()->is('admin/dashboard'))
                <a class="active">🏠 Dashboard</a>
            @else
                <a href="/admin/dashboard">🏠 Dashboard</a>
            @endif

            <!-- Mata Kuliah -->
            @if(request()->is('admin/matkul*'))
                <a class="active">📚 Kelola Mata Kuliah</a>
            @else
                <a href="/admin/matkul">📚 Kelola Mata Kuliah</a>
            @endif

            <!-- Pengumuman -->
            @if(request()->is('admin/pengumuman*'))
                <a class="active">📢 Pengumuman</a>
            @else
                <a href="/admin/pengumuman">📢 Pengumuman</a>
            @endif
        </div>

        <div class="bottom">
            @if(request()->is('admin/dashboard'))
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout">🚪 Keluar</button>
                </form>
            @endif
        </div>
    </div>

    <!-- MAIN AREA -->
    <div class="main">
        <!-- HEADER -->
        <div class="header-strip">
            <div class="badge-admin">SIMAK FIK 2026</div>
            <div style="font-size: 13px; color: #94a3b8;">{{ date('l, d F Y') }}</div>
        </div>

        <!-- CONTENT -->
        <div class="content">
            @yield('content')
        </div>
    </div>

</body>
</html>