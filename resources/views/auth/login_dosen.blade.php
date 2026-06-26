<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dosen - SIMAK</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;

            /* 🔥 WARNA DIBEDAIN (ungu-biru) */
            background: linear-gradient(135deg, #4c1d95 0%, #1e293b 100%);

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
            color: #4c1d95;
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

        input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.3s;
        }

        input:focus {
            outline: none;
            border-color: #4c1d95;
            box-shadow: 0 0 0 3px rgba(76, 29, 149, 0.1);
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-error {
            background-color: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #4c1d95, #7c3aed);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
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

    <!-- HEADER -->
    <div class="login-header">
        <div class="login-logo">D</div>
        <h1 class="login-title">SIMAK Dosen</h1>
        <p class="login-subtitle">Sistem Informasi Akademik Dosen</p>
    </div>

    <!-- ERROR -->
    @if(session('error'))
        <div class="alert alert-error">
            ❌ {{ session('error') }}
        </div>
    @endif

    <!-- FORM -->
    <form action="{{ route('login.dosen') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>NIP</label>
            <input type="text" name="nip" placeholder="Masukkan NIP..." required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password..." required>
        </div>



        <button type="submit">Login sebagai Dosen →</button>

    </form>

    <div class="login-footer">
        © 2026 SIMAK - Sistem Informasi Manajemen Akademik
    </div>

</div>

</body>
</html>