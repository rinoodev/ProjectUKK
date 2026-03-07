<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Smart Pustaka</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">

    <style>
        * { -webkit-font-smoothing: antialiased; box-sizing: border-box; }

        :root {
            --blue: #1a56db;
            --blue-light: #3b82f6;
            --blue-pale: #eff6ff;
            --blue-mid: #dbeafe;
            --text-primary: #0b1120;
            --text-secondary: #64748b;
            --border: #e2e8f0;
            --surface: #ffffff;
            --bg: #f8fafc;
        }

        html { scroll-behavior: smooth; }
        body {
            background: var(--bg);
            font-family: 'Sora', sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Noise texture */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
            opacity: 0.4;
        }

        /* Animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes floatGlow {
            0%, 100% { transform: translateY(0) scale(1); opacity: 0.6; }
            50%       { transform: translateY(-20px) scale(1.05); opacity: 0.9; }
        }
        @keyframes shimmer {
            0%   { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        @keyframes pulse-dot {
            0%   { box-shadow: 0 0 0 0 rgba(26,86,219,0.4); }
            70%  { box-shadow: 0 0 0 6px rgba(26,86,219,0); }
            100% { box-shadow: 0 0 0 0 rgba(26,86,219,0); }
        }

        .fade-up   { animation: fadeUp 0.75s cubic-bezier(.22,1,.36,1) both; }
        .fade-up-1 { animation-delay: 0.05s; }
        .fade-up-2 { animation-delay: 0.18s; }
        .fade-up-3 { animation-delay: 0.32s; }
        .fade-up-4 { animation-delay: 0.46s; }
        .fade-up-5 { animation-delay: 0.58s; }

        /* Header */
        .header-glass {
            background: rgba(255,255,255,0.82);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-bottom: 1px solid rgba(226,232,240,0.8);
        }
        .logo-mark {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, var(--blue) 0%, var(--blue-light) 100%);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(26,86,219,0.3);
        }

        /* Orbs */
        .hero-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            pointer-events: none;
        }
        .orb-1 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(26,86,219,0.1) 0%, transparent 70%);
            top: -80px; left: 50%;
            transform: translateX(-50%);
            animation: floatGlow 7s ease-in-out infinite;
        }
        .orb-2 {
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(59,130,246,0.09) 0%, transparent 70%);
            top: 40px; right: 5%;
            animation: floatGlow 9s ease-in-out infinite 2s;
        }
        .orb-3 {
            width: 180px; height: 180px;
            background: radial-gradient(circle, rgba(245,158,11,0.06) 0%, transparent 70%);
            bottom: 60px; left: 6%;
            animation: floatGlow 11s ease-in-out infinite 1s;
        }

        /* Grid pattern */
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(26,86,219,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(26,86,219,0.04) 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: radial-gradient(ellipse 80% 70% at 50% 20%, black 0%, transparent 80%);
            pointer-events: none;
        }

        /* Badge */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 16px;
            background: linear-gradient(90deg, var(--blue-pale), #e0f2fe);
            color: var(--blue);
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.04em;
            border: 1px solid rgba(26,86,219,0.18);
            box-shadow: 0 1px 4px rgba(26,86,219,0.08);
        }
        .badge-dot {
            width: 6px; height: 6px;
            background: var(--blue);
            border-radius: 50%;
            animation: pulse-dot 2s infinite;
        }

        /* Card */
        .login-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 28px;
            padding: 48px 44px;
            box-shadow:
                0 4px 6px -1px rgba(0,0,0,0.04),
                0 12px 48px rgba(26,86,219,0.06),
                0 1px 2px rgba(0,0,0,0.04);
            width: 100%;
            max-width: 460px;
            position: relative;
            overflow: hidden;
        }
        /* Subtle top accent */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--blue), var(--blue-light), #60a5fa);
            border-radius: 28px 28px 0 0;
        }
        /* Corner accent */
        .login-card::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 120px; height: 120px;
            background: radial-gradient(circle at top right, rgba(26,86,219,0.05), transparent 70%);
            pointer-events: none;
        }

        /* Title */
        .card-title {
            font-family: 'DM Serif Display', serif;
            font-size: 2rem;
            line-height: 1.1;
            letter-spacing: -0.02em;
            color: var(--text-primary);
        }
        .card-title .accent {
            background: linear-gradient(135deg, var(--blue) 0%, #60a5fa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Input */
        .input-group { position: relative; }
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 14px;
            pointer-events: none;
            transition: color 0.2s;
        }
        .form-input {
            width: 100%;
            padding: 13px 16px 13px 44px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-family: 'Sora', sans-serif;
            font-size: 14px;
            color: var(--text-primary);
            background: var(--bg);
            transition: all 0.2s cubic-bezier(.22,1,.36,1);
            outline: none;
        }
        .form-input::placeholder { color: #94a3b8; }
        .form-input:focus {
            border-color: var(--blue);
            background: white;
            box-shadow: 0 0 0 4px rgba(26,86,219,0.08);
        }
        .form-input:focus + .input-icon,
        .input-group:focus-within .input-icon {
            color: var(--blue);
        }

        /* Label */
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
            letter-spacing: 0.01em;
        }

        /* Error */
        .error-msg {
            font-size: 12px;
            color: #ef4444;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* Checkbox */
        .custom-checkbox {
            width: 16px; height: 16px;
            border: 1.5px solid var(--border);
            border-radius: 5px;
            background: var(--bg);
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
            appearance: none;
            -webkit-appearance: none;
            position: relative;
        }
        .custom-checkbox:checked {
            background: var(--blue);
            border-color: var(--blue);
        }
        .custom-checkbox:checked::after {
            content: '';
            position: absolute;
            left: 4px; top: 1.5px;
            width: 5px; height: 9px;
            border: 2px solid white;
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
        }
        .custom-checkbox:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(26,86,219,0.15);
        }

        /* Button */
        .btn-primary {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 13px 28px;
            background: linear-gradient(135deg, var(--blue) 0%, #2563eb 100%);
            color: #fff;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            font-family: 'Sora', sans-serif;
            transition: all 0.22s cubic-bezier(.22,1,.36,1);
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(26,86,219,0.2), 0 6px 20px rgba(26,86,219,0.18);
            position: relative;
            overflow: hidden;
        }
        .btn-primary::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.12) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(26,86,219,0.25), 0 12px 32px rgba(26,86,219,0.22);
        }
        .btn-primary:hover::after { opacity: 1; }
        .btn-primary:active { transform: translateY(0); }

        /* Divider */
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border), transparent);
        }

        /* Forgot password link */
        .link-blue {
            color: var(--blue);
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: opacity 0.2s;
        }
        .link-blue:hover { opacity: 0.75; text-decoration: underline; }

        /* Session status */
        .session-status {
            padding: 12px 16px;
            background: #f0fdf4;
            border: 1px solid rgba(22,163,74,0.2);
            border-radius: 10px;
            color: #16a34a;
            font-size: 13px;
            font-weight: 500;
        }
    </style>
</head>
<body>

<!-- MAIN -->
<main class="flex-1 relative bg-white overflow-hidden flex items-center justify-center py-20 px-4">
    <div class="hero-grid"></div>
    <div class="hero-orb orb-1"></div>
    <div class="hero-orb orb-2"></div>
    <div class="hero-orb orb-3"></div>

    <div class="relative z-10 w-full flex flex-col items-center gap-8">
        <!-- Card -->
        <div class="login-card fade-up fade-up-2">

            <!-- Title -->
            <div class="mb-8">
                <a href="/">
                <img src="{{ asset('img/logo.jpeg') }}" alt="Logo Perpustakaan Digital" class="w-22 h-22 object-contain">
                </a>
                <h1 class="card-title mb-2">
                    Masuk ke <span class="accent">Smart Pustaka</span>
                </h1>
                <p style="font-size:14px;color:var(--text-secondary);line-height:1.6;">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="link-blue">Daftar sekarang</a>
                </p>
            </div>

            <!-- Session status -->
            @if(session('status'))
                <div class="session-status mb-6 fade-up fade-up-1">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div class="fade-up fade-up-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <div class="input-group">
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="form-input"
                            placeholder="example@gmail.com"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                    @error('email')
                        <p class="error-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="fade-up fade-up-4">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <div class="input-group" style="position:relative;">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-input"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                            style="padding-right: 44px;"
                        />
                        <i class="fas fa-lock input-icon"></i>
                        <!-- Toggle visibility -->
                        <button
                            type="button"
                            onclick="togglePwd()"
                            style="position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;font-size:14px;padding:4px;transition:color 0.2s;"
                            onmouseover="this.style.color='var(--blue)'" onmouseout="this.style.color='#94a3b8'"
                            id="toggleBtn"
                        >
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="error-msg"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember me + Forgot -->
                <div class="fade-up fade-up-5 flex items-center justify-between pt-1">
                    <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                        <input type="checkbox" name="remember" id="remember_me" class="custom-checkbox">
                        <span style="font-size:13px;color:var(--text-secondary);font-weight:500;user-select:none;">Ingat saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="link-blue">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <div class="fade-up fade-up-5" style="padding-top:8px;">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-sign-in-alt text-sm"></i>
                        Login
                    </button>
                </div>

            </form>

            <!-- Divider -->
            <div class="divider" style="margin-top:28px;margin-bottom:20px;"></div>

            <!-- Register hint -->
            <p style="text-align:center;font-size:13px;color:var(--text-secondary);">
                Baru di Smart Pustaka?
                <a href="{{ route('register') }}" class="link-blue">Buat akun sekarang</a>
            </p>

        </div>

        <!-- Bottom note -->
        <p class="fade-up fade-up-5 text-center" style="font-size:12px;color:#94a3b8;animation-delay:0.7s;">
            © 2026 Smart Pustaka. Dengan masuk, kamu menyetujui
            <a href="#" style="color:var(--text-secondary);text-decoration:underline;text-underline-offset:2px;">Syarat & Ketentuan</a>
        </p>

    </div>
</main>

<script>
    function togglePwd() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }
</script>
</body>
</html>