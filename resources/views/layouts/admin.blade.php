<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | SIMAK FIK 2026</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            display:flex;
            font-family:'Inter',system-ui,-apple-system,sans-serif;
            background:#f8fafc;
            color:#0f172a;
        }

        /* ================= SIDEBAR ================= */

        .sidebar{
            width:260px;
            height:100vh;
            background:#1c253c;
            position:fixed;
            left:0;
            top:0;

            display:flex;
            flex-direction:column;

            padding:24px 20px;
            z-index:999;
        }

        .logo{
            margin-bottom:35px;
            padding-left:8px;
        }

        .logo-title{
            font-size:20px;
            font-weight:800;
            color:#fff;
            letter-spacing:.5px;
        }

        .logo-sub{
            font-size:10px;
            color:#94a3b8;
            margin-top:4px;
            letter-spacing:1.5px;
            text-transform:uppercase;
        }

        .menu{
            flex:1;
            display:flex;
            flex-direction:column;
            gap:6px;
            overflow-y:auto;
        }

        .menu a{
            display:flex;
            align-items:center;
            gap:12px;

            padding:12px 16px;

            border-radius:12px;

            text-decoration:none;
            color:#94a3b8;

            transition:.2s;

            font-size:14px;
            font-weight:500;
        }

        .menu a:hover{
            background:#2d3748;
            color:white;
        }

        .menu a.active{
            background:#2563eb;
            color:white;
            font-weight:600;
        }

        /* ================= LOGOUT ================= */

        .bottom{
            margin-top:20px;
            padding-top:20px;
            border-top:1px solid #334155;
        }

        .logout{
            width:100%;
            padding:12px;

            border-radius:10px;

            background:#fef2f2;
            color:#991b1b;

            border:1px solid rgba(239,68,68,.2);

            cursor:pointer;

            font-size:14px;
            font-weight:700;

            transition:.2s;
        }

        .logout:hover{
            background:#e11d48;
            color:white;
            border-color:#e11d48;
            box-shadow:0 4px 12px rgba(225,29,72,.15);
        }

        /* ================= MAIN ================= */

        .main{
            margin-left:260px;
            width:calc(100% - 260px);

            display:flex;
            flex-direction:column;

            min-height:100vh;
        }

        .header-strip{
            background:white;

            height:70px;

            display:flex;
            justify-content:space-between;
            align-items:center;

            padding:0 40px;

            border-bottom:1px solid #e2e8f0;

            position:sticky;
            top:0;
            z-index:100;
        }

        .badge-admin{
            background:#eff6ff;
            color:#2563eb;

            padding:6px 16px;

            border-radius:999px;

            font-size:11px;
            font-weight:700;

            border:1px solid rgba(37,99,235,.1);
        }

        .content{
            flex:1;
            padding:40px;
            overflow-x:auto;
        }

    </style>

</head>

<body>

<div class="sidebar">

    <div class="logo">
        <div class="logo-title">SIMAK FIK</div>
        <div class="logo-sub">Administrator</div>
    </div>

    <div class="menu">

        <a href="/admin/dashboard"
        class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            🏠 Dashboard
        </a>

        <a href="/admin/matkul"
        class="{{ request()->is('admin/matkul*') ? 'active' : '' }}">
            📚 Mata Kuliah
        </a>

        <a href="/admin/pengumuman"
        class="{{ request()->is('admin/pengumuman*') ? 'active' : '' }}">
            📢 Pengumuman
        </a>

        <a href="{{ route('admin.paket') }}"
        class="{{ request()->is('admin/paket-semester*') ? 'active' : '' }}">
            📦 Paket Semester 2
        </a>

        <a href="{{ route('admin.report') }}"
        class="{{ request()->is('admin/report*') ? 'active' : '' }}">
            📊 Laporan
        </a>

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

<div class="main">

    <div class="header-strip">

        <div class="badge-admin">
            PORTAL ADMIN FIK
        </div>

        <div style="font-size:13px;color:#64748b;font-weight:500;">
            {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, DD MMMM YYYY') }}
        </div>

    </div>

    <div class="content">
        @yield('content')
    </div>

</div>

</body>
</html>