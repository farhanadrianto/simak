<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa - SIMAK</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            /* Aksen warna biru-navy untuk membedakan dengan Admin */
            background: linear-gradient(135deg, #1e3a8a 0%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            padding: 40px;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo {
            font-size: 40px;
            font-weight: bold;
            color: #1e3a8a;
            margin-bottom: 10px;
        }

        .login-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .login-subtitle {
            font-size: 14px;
            color: #666;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
            font-family: inherit;
            color: #333;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #1e3a8a;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            animation: slideIn 0.3s ease-out;
        }

        .alert-error {
            background-color: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px 16px;
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-top: 10px;
            margin-bottom: 20px;
            font-family: inherit;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(30, 58, 138, 0.3);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Header -->
    <div class="login-header">
        <div class="login-logo">M</div>
        <h1 class="login-title">SIMAK Mahasiswa</h1>
        <p class="login-subtitle">Sistem Informasi Manajemen Akademik</p>
    </div>

    <!-- Error Alert -->
    @if(session('error'))
        <div class="alert alert-error">
            <strong>❌ Error!</strong><br>
            {{ session('error') }}
        </div>
    @endif

    <!-- Form Login -->
    <form action="{{ route('login.mhs') }}" method="POST">
        @csrf

        <!-- Input NPM -->
        <div class="form-group">
            <label for="npm">NPM</label>
            <input 
                type="text" 
                id="npm" 
                name="npm" 
                placeholder="Masukkan NPM Anda..." 
                required 
                autofocus
            >
        </div>

        <!-- Input Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                placeholder="Masukkan password..." 
                required
            >
        </div>

        <!-- Input Kode Prodi -->
        <div class="form-group">
            <label for="kode_prodi">Kode Prodi</label>
            <input 
                type="text" 
                id="kode_prodi" 
                name="kode_prodi" 
                placeholder="Contoh: 1010" 
                maxlength="4"
                required
            >
        </div>

        <!-- Submit Button -->
        <button type="submit">Login sebagai Mahasiswa →</button>
    </form>

    <!-- Footer -->
    <div class="login-footer">
        © 2026 SIMAK - Sistem Informasi Manajemen Akademik
    </div>
</div>

</body>
</html>