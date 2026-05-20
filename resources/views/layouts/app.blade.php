<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem KRS Mahasiswa</title>
    <!-- Tambahkan CSS lo di sini -->
    <style>
        body { background-color: #0f172a; font-family: sans-serif; }
    </style>
</head>
<body>
    <nav style="padding: 20px; background: #1e293b; color: white; margin-bottom: 20px;">
        <div class="container">
            <strong>Portal Mahasiswa</strong>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer style="margin-top: 50px; text-align: center; color: #64748b; padding: 20px;">
        &copy; 2024 Sistem Informasi Akademik
    </footer>
</body>
</html>