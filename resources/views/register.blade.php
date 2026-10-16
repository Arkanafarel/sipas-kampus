<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | SIPAS Kampus</title>

    <!-- Google Font Inter & Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --blue: #164780;
            --blue-dark: #103766;
            --blue-light: #eaf3ff;
            --yellow: #ffcf32;
            --yellow-hover: #f5c421;
            --text: #183456;
            --muted: #71839d;
            --border: #e1eaf5;
            --danger: #dc4545;
            --danger-bg: #fdf2f2;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #0f2d53;
            background-image: 
                radial-gradient(at 0% 0%, rgba(22, 71, 128, 0.9) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(255, 207, 50, 0.25) 0px, transparent 40%),
                radial-gradient(at 100% 100%, rgba(16, 55, 102, 0.9) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(22, 71, 128, 0.8) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--text);
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 32px 16px;
            font-size: 14px;
            position: relative;
            overflow-x: hidden;
        }

        /* Pola Grid Halus di Latar Belakang */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(255, 255, 255, 0.04) 1px, transparent 1px);
            background-size: 32px 32px;
            pointer-events: none;
            z-index: 0;
        }

        /* Lingkaran Cahaya Dekoratif (Glowing Orbs) */
        .bg-shape-1 {
            position: absolute;
            width: 380px;
            height: 380px;
            top: -100px;
            left: -100px;
            background: rgba(22, 71, 128, 0.5);
            filter: blur(90px);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .bg-shape-2 {
            position: absolute;
            width: 350px;
            height: 350px;
            bottom: -80px;
            right: -80px;
            background: rgba(255, 207, 50, 0.2);
            filter: blur(80px);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        /* Kartu Registrasi Glassmorphism */
        .register-card {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 24px;
            padding: 36px 32px;
            box-shadow: 
                0 20px 50px rgba(10, 35, 66, 0.3),
                0 2px 6px rgba(0, 0, 0, 0.05);
        }

        /* Brand Header Center */
        .brand-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            gap: 8px;
            margin-bottom: 24px;
            padding-bottom: 18px;
            border-bottom: 1px solid var(--border);
        }

        .brand-logo {
            width: 48px;
            height: 48px;
            display: grid;
            place-items: center;
            background: var(--blue);
            color: var(--yellow);
            border-radius: 50%;
            font-size: 22px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(22, 71, 128, 0.15);
        }

        .brand-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--blue);
            letter-spacing: -0.3px;
            line-height: 1.2;
            text-align: center;
        }

        .brand-subtitle {
            font-size: 11px;
            color: var(--muted);
            margin-top: 2px;
            line-height: 1.4;
            text-align: center;
        }

        .welcome-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--blue);
            margin-bottom: 6px;
            letter-spacing: -0.4px;
            text-align: center;
        }

        .welcome-subtitle {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 22px;
            line-height: 1.5;
            text-align: center;
        }

        /* Pesan Error */
        .error-alert {
            margin-bottom: 20px;
            padding: 12px 14px;
            border-radius: 12px;
            background: var(--danger-bg);
            border: 1px solid #f8d7da;
            color: var(--danger);
            font-size: 12px;
            font-weight: 500;
        }

        .error-alert ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .error-alert li {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Field Form Input */
        .field {
            margin-bottom: 16px;
        }

        .field label {
            display: block;
            margin-bottom: 6px;
            font-size: 12px;
            font-weight: 700;
            color: var(--text);
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            font-size: 15px;
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-group input {
            width: 100%;
            height: 45px;
            padding: 0 14px 0 42px;
            border: 1px solid var(--border);
            border-radius: 12px;
            outline: none;
            font-family: inherit;
            font-size: 13px;
            color: var(--text);
            background: #fafcff;
            transition: all 0.2s ease;
        }

        .input-group input:focus {
            background: #ffffff;
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(22, 71, 128, 0.08);
        }

        .input-group input:focus + .input-icon,
        .input-group input:focus ~ .input-icon {
            color: var(--blue);
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 15px;
            padding: 4px;
            display: grid;
            place-items: center;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: var(--blue);
        }

        /* Tombol Submit */
        .btn-submit {
            width: 100%;
            height: 48px;
            margin-top: 10px;
            border: 0;
            border-radius: 30px;
            background: var(--yellow);
            color: var(--blue-dark);
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(255, 207, 50, 0.35);
        }

        .btn-submit:hover {
            background: var(--yellow-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(255, 207, 50, 0.45);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Tautan Ke Login */
        .login-text {
            margin-top: 22px;
            text-align: center;
            color: var(--muted);
            font-size: 12px;
        }

        .login-text a {
            color: var(--blue);
            font-weight: 700;
            text-decoration: none;
            margin-left: 3px;
        }

        .login-text a:hover {
            text-decoration: underline;
        }

        @media (max-width: 440px) {
            .register-card {
                padding: 28px 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Elemen Dekorasi Cahaya Latar Belakang -->
    <div class="bg-shape-1"></div>
    <div class="bg-shape-2"></div>

    <main class="register-card">
        <!-- Logo Brand -->
        <div class="brand-header">
            <div class="brand-logo">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div>
                <div class="brand-title">SIPAS KAMPUS</div>
                <div class="brand-subtitle">Sistem Informasi Pengaduan dan Layanan Aspirasi Kampus</div>
            </div>
        </div>

        <!-- Judul Form -->
        <h1 class="welcome-title">Buat Akun Baru</h1>
        <p class="welcome-subtitle">Lengkapi data diri Anda untuk mendaftar layanan portal.</p>

        <!-- Pesan Error -->
        @if ($errors->any())
            <div class="error-alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <span>{{ $error }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Registrasi -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nama Lengkap -->
            <div class="field">
                <label for="name">Nama Lengkap</label>
                <div class="input-group">
                    <input id="name" type="text" name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap"
                        required autofocus>
                    <i class="fa-regular fa-user input-icon"></i>
                </div>
            </div>

            <!-- NPM -->
            <div class="field">
                <label for="npm">NPM (Nomor Pokok Mahasiswa)</label>
                <div class="input-group">
                    <input id="npm" type="text" name="npm"
                        value="{{ old('npm') }}"
                        placeholder="Contoh: 2417052013"
                        required>
                    <i class="fa-solid fa-id-card input-icon"></i>
                </div>
            </div>

            <!-- Email -->
            <div class="field">
                <label for="email">Email Mahasiswa</label>
                <div class="input-group">
                    <input id="email" type="email" name="email"
                        value="{{ old('email') }}"
                        placeholder="contoh@student.ac.id"
                        required>
                    <i class="fa-regular fa-envelope input-icon"></i>
                </div>
            </div>

            <!-- Password -->
            <div class="field">
                <label for="password">Password</label>
                <div class="input-group">
                    <input id="password" type="password" name="password"
                        placeholder="Minimal 8 karakter"
                        required minlength="8">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <button type="button" class="toggle-password" id="togglePassword" aria-label="Lihat password">
                        <i class="fa-regular fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Konfirmasi Password -->
            <div class="field">
                <label for="password_confirmation">Konfirmasi Password</label>
                <div class="input-group">
                    <input id="password_confirmation" type="password" name="password_confirmation"
                        placeholder="Ulangi password Anda"
                        required minlength="8">
                    <i class="fa-solid fa-shield-halved input-icon"></i>
                    <button type="button" class="toggle-password" id="toggleConfirmPassword" aria-label="Lihat konfirmasi password">
                        <i class="fa-regular fa-eye" id="eyeConfirmIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-submit">
                Daftar Sekarang
            </button>
        </form>

        <p class="login-text">
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </main>

    <script>
        // Toggle Show/Hide Password
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            eyeIcon.className = isPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
        });

        // Toggle Show/Hide Confirm Password
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const eyeConfirmIcon = document.getElementById('eyeConfirmIcon');

        toggleConfirmPassword.addEventListener('click', function () {
            const isPassword = confirmPasswordInput.type === 'password';
            confirmPasswordInput.type = isPassword ? 'text' : 'password';
            eyeConfirmIcon.className = isPassword ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
        });
    </script>

</body>
</html>