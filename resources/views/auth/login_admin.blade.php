<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SIMAK</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            color: #667eea;
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
            margin-bottom: 20px;
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
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
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

        .alert-success {
            background-color: #efe;
            color: #3c3;
            border: 1px solid #cfc;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px 16px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-bottom: 20px;
            font-family: inherit;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            font-size: 12px;
            color: #999;
        }

        .error-text {
            color: #c33;
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }

            .login-title {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Header -->
    <div class="login-header">
        <div class="login-logo">S</div>
        <h1 class="login-title">SIMAK Admin</h1>
        <p class="login-subtitle">Sistem Informasi Manajemen Akademik</p>
    </div>

    <!-- Error Alert -->
    @if ($errors->any() || session('error'))
        <div class="alert alert-error">
            <strong>❌ Error!</strong><br>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            @else
                {{ session('error') }}
            @endif
        </div>
    @endif

    <!-- Success Alert -->
    @if (session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Form Login -->
    <form action="{{ route('login.admin.post') }}" method="POST">
        @csrf

        <!-- Input NIK -->
        <div class="form-group">
            <label for="nik">NIK (Username)</label>
            <input 
                type="text" 
                id="nik" 
                name="nik" 
                placeholder="Masukkan NIK Anda..." 
                value="{{ old('nik') }}"
                required 
                autofocus
            >
            @error('nik')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <!-- Input Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                placeholder="Masukkan password Anda..." 
                required
            >
            @error('password')
                <span class="error-text">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit">Login sebagai Admin →</button>
    </form>

    <!-- Footer -->
    <div class="login-footer">
        © 2026 SIMAK - Sistem Informasi Manajemen Akademik
    </div>
</div>

</body>
</html>
