<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya | Perpustakaan Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    <style>
        :root {
            --indigo:    #4f46e5;
            --indigo-l:  #6366f1;
            --indigo-xl: #e0e7ff;
            --emerald:   #059669;
            --emerald-l: #d1fae5;
            --rose:      #e11d48;
            --rose-l:    #ffe4e6;
            --text:      #0f172a;
            --text-sub:  #64748b;
            --border:    #e2e8f0;
            --surface:   #fff;
            --bg:        #f1f5f9;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            margin: 0;
            color: var(--text);
        }

        h1, h2, h3, .font-display { font-family: 'Sora', sans-serif; }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 260px;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            background: #0f172a;
            display: flex;
            flex-direction: column;
            z-index: 40;
            padding: 0 0 24px;
            overflow: hidden;
        }

        .sidebar-brand {
            padding: 28px 28px 24px;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }

        .sidebar-logo {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--indigo), var(--indigo-l));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 4px 14px rgba(79,70,229,0.45);
        }

        .sidebar nav { padding: 20px 16px; flex: 1; }

        .nav-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.1em;
            color: rgba(255,255,255,0.28);
            padding: 0 12px;
            margin: 20px 0 8px;
            text-transform: uppercase;
        }

        .nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 500;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            transition: all 0.2s ease;
            position: relative;
            margin-bottom: 2px;
        }

        .nav-item:hover { background: rgba(255,255,255,0.07); color: #fff; }

        .nav-item.active {
            background: rgba(99,102,241,0.18);
            color: #a5b4fc;
        }
        .nav-item.active .nav-icon { color: var(--indigo-l); }
        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 6px; bottom: 6px;
            width: 3px;
            background: var(--indigo-l);
            border-radius: 0 3px 3px 0;
        }

        .nav-icon { width: 18px; text-align: center; }

        .sidebar-user {
            margin: 0 16px;
            padding: 14px;
            background: rgba(255,255,255,0.06);
            border-radius: 12px;
            display: flex; align-items: center; gap: 11px;
        }

        .avatar-sm {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--indigo), var(--indigo-l));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: #fff;
            font-size: 13px;
            font-family: 'Sora', sans-serif;
            flex-shrink: 0;
        }

        /* ── MAIN ── */
        .main-wrap {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── TOP BAR ── */
        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--border);
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 36px;
            position: sticky; top: 0; z-index: 30;
        }

        .breadcrumb {
            display: flex; align-items: center; gap: 8px;
            font-size: 13px; color: #94a3b8;
        }
        .breadcrumb .current { color: #1e293b; font-weight: 600; }
        .breadcrumb a { color: #94a3b8; text-decoration: none; }
        .breadcrumb a:hover { color: var(--indigo); }

        /* ── CONTENT ── */
        .content { padding: 36px; flex: 1; }

        /* ── HERO (Profile Banner) ── */
        .profile-hero {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 45%, #3730a3 100%);
            border-radius: 20px;
            padding: 32px 40px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            gap: 24px;
            animation: fadeUp 0.4s ease both;
        }

        .profile-hero::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(129,140,248,0.25) 0%, transparent 70%);
            border-radius: 50%;
        }
        .profile-hero::after {
            content: '';
            position: absolute;
            bottom: -40px; left: 30%;
            width: 180px; height: 180px;
            background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .profile-avatar-lg {
            width: 80px; height: 80px;
            background: rgba(255,255,255,0.15);
            border: 2px solid rgba(165,180,252,0.4);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Sora', sans-serif;
            font-size: 28px;
            font-weight: 800;
            color: #e0e7ff;
            flex-shrink: 0;
            position: relative; z-index: 2;
            backdrop-filter: blur(10px);
        }

        .profile-hero-info { position: relative; z-index: 2; }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(165,180,252,0.15);
            border: 1px solid rgba(165,180,252,0.25);
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 500;
            color: #a5b4fc;
            margin-bottom: 10px;
        }

        .hero-name {
            font-family: 'Sora', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 6px;
        }

        .hero-email {
            font-size: 13px;
            color: rgba(199,210,254,0.65);
        }

        /* ── GRID LAYOUT ── */
        .profile-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        /* ── CARDS ── */
        .profile-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e8edf4;
            overflow: hidden;
            transition: all 0.25s cubic-bezier(0.4,0,0.2,1);
            animation: fadeUp 0.5s ease both;
        }

        .profile-card:hover {
            box-shadow: 0 12px 32px rgba(0,0,0,0.07);
        }

        .profile-card.full { grid-column: 1 / -1; }

        .card-header {
            padding: 20px 28px 18px;
            border-bottom: 1px solid #f0f4f8;
            display: flex;
            align-items: center;
            gap: 14px;
            background: linear-gradient(135deg, #fafbff 0%, #fff 100%);
        }

        .card-icon {
            width: 42px; height: 42px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-size: 15px;
        }

        .card-icon-indigo {
            background: var(--indigo-xl);
            color: var(--indigo);
        }
        .card-icon-gray {
            background: #f1f5f9;
            color: #475569;
        }
        .card-icon-rose {
            background: var(--rose-l);
            color: var(--rose);
        }

        .card-title {
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 2px;
        }
        .card-sub {
            font-size: 12px;
            color: var(--text-sub);
        }

        .card-body { padding: 24px 28px; }

        /* ── FORM ── */
        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 7px;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }
        .form-input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 14px;
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            background: #fff;
            transition: all 0.2s;
            outline: none;
        }
        .form-input:focus {
            border-color: var(--indigo);
            box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
        }
        .form-input::placeholder { color: #94a3b8; }

        .form-error { font-size: 12px; color: var(--rose); margin-top: 5px; }

        /* ── BUTTONS ── */
        .btn-primary {
            display: inline-flex;
            align-items: center; gap: 8px;
            padding: 10px 22px;
            background: linear-gradient(135deg, var(--indigo) 0%, var(--indigo-l) 100%);
            color: #fff;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13.5px;
            font-family: 'Sora', sans-serif;
            border: none;
            cursor: pointer;
            transition: all 0.22s cubic-bezier(.22,1,.36,1);
            box-shadow: 0 2px 8px rgba(79,70,229,0.3);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79,70,229,0.35);
        }

        .btn-danger {
            display: inline-flex;
            align-items: center; gap: 8px;
            padding: 10px 22px;
            background: var(--rose);
            color: #fff;
            border-radius: 10px;
            font-weight: 600;
            font-size: 13.5px;
            font-family: 'Sora', sans-serif;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 2px 8px rgba(225,29,72,0.25);
        }
        .btn-danger:hover {
            background: #be123c;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(225,29,72,0.3);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center; gap: 8px;
            padding: 9px 20px;
            background: transparent;
            color: var(--indigo);
            border-radius: 10px;
            font-weight: 600;
            font-size: 13.5px;
            font-family: 'Sora', sans-serif;
            border: 1.5px solid rgba(79,70,229,0.3);
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-outline:hover { background: var(--indigo-xl); border-color: var(--indigo); }

        /* ── ALERT ── */
        .alert-success {
            display: flex; align-items: center; gap: 10px;
            padding: 12px 16px;
            background: var(--emerald-l);
            border: 1px solid #6ee7b7;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            color: #065f46;
            margin-bottom: 18px;
        }

        /* ── DANGER ZONE ── */
        .danger-box {
            background: #fff8f8;
            border: 1.5px solid #fecaca;
            border-radius: 12px;
            padding: 20px;
        }

        /* ── ACCENT LINE ── */
        .profile-card.indigo-accent { border-top: 3px solid var(--indigo); }
        .profile-card.gray-accent   { border-top: 3px solid #94a3b8; }
        .profile-card.rose-accent   { border-top: 3px solid var(--rose); }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid var(--border);
            margin-top: auto;
            padding: 22px 36px;
            display: flex; align-items: center; justify-content: space-between;
            background: #fff;
        }
        .foot-brand {
            display: flex; align-items: center; gap: 10px;
            font-family: 'Sora', sans-serif; font-weight: 700; font-size: 14px; color: var(--text);
        }

        /* ── MODAL ── */
        .modal-overlay {
            position: fixed; inset: 0;
            background: rgba(11,17,32,0.55);
            backdrop-filter: blur(4px);
            z-index: 1000;
            display: none; align-items: center; justify-content: center;
        }
        .modal-overlay.open { display: flex; }
        .modal-box {
            background: #fff;
            border-radius: 20px;
            padding: 36px;
            max-width: 440px; width: 90%;
            box-shadow: 0 24px 80px rgba(0,0,0,0.18);
            animation: fadeUp 0.3s cubic-bezier(.22,1,.36,1) both;
        }
        .modal-icon {
            width: 52px; height: 52px;
            background: var(--rose-l);
            border: 1.5px solid #fecaca;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 18px;
        }

        /* ── DIVIDER ── */
        .divider { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .divider-line { flex: 1; height: 1px; background: var(--border); }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .profile-card:nth-child(1) { animation-delay: 0.05s; }
        .profile-card:nth-child(2) { animation-delay: 0.12s; }
        .profile-card:nth-child(3) { animation-delay: 0.19s; }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .profile-grid { grid-template-columns: 1fr; }
            .profile-card.full { grid-column: auto; }
        }
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-wrap { margin-left: 0; }
            .content { padding: 20px; }
            .topbar { padding: 0 20px; }
            .profile-hero { flex-direction: column; text-align: center; padding: 28px 24px; }
        }

        /* ── UNVERIFIED EMAIL NOTICE ── */
        .email-notice {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            color: #92400e;
            margin-bottom: 18px;
            display: flex; align-items: center; gap: 8px;
        }
    </style>
</head>
<body>

<!-- ═══════════════════ SIDEBAR ═══════════════════ -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <div style="display:flex; align-items:center; gap:12px;">
            <div class="sidebar-logo">
                <i class="fas fa-book-open" style="color:#fff; font-size:17px;"></i>
            </div>
            <div>
                <div style="font-family:'Sora',sans-serif; font-weight:800; font-size:14px; color:#fff; line-height:1.2;">Smart Pustaka</div>
                <div style="font-size:11px; color:rgba(255,255,255,0.4);">Perpustakaan Digital</div>
            </div>
        </div>
    </div>

    <nav>
        <div class="nav-label">Menu</div>

        <a href="{{ route('user.dashboard') }}" class="nav-item">
            <i class="fas fa-house-chimney nav-icon"></i>
            Dashboard
        </a>
        <a href="{{ route('user.books') }}" class="nav-item">
            <i class="fas fa-book nav-icon"></i>
            Katalog Buku
        </a>
        <a href="{{ route('user.favorites') }}" class="nav-item">
            <i class="fas fa-heart nav-icon"></i>
            Buku Favorit
        </a>
        <a href="{{ route('user.borrowing.index') }}" class="nav-item">
            <i class="fas fa-clock-rotate-left nav-icon"></i>
            Riwayat Peminjaman
        </a>

        <div class="nav-label">Akun</div>
        <a href="{{ url('/profile') }}" class="nav-item active">
            <i class="fas fa-user nav-icon"></i>
            Profil Saya
        </a>
    </nav>

    <div class="sidebar-user">
        <div class="avatar-sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <div style="flex:1; min-width:0;">
            <div style="font-size:13px; font-weight:600; color:#e2e8f0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ auth()->user()->name }}</div>
            <div style="font-size:11px; color:rgba(255,255,255,0.35);">Anggota Aktif</div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background:none; border:none; color:rgba(255,255,255,0.4); cursor:pointer; padding:4px; transition:color 0.2s;"
                    onmouseover="this.style.color='#fda4af'" onmouseout="this.style.color='rgba(255,255,255,0.4)'">
                <i class="fas fa-right-from-bracket" style="font-size:14px;"></i>
            </button>
        </form>
    </div>
</aside>


<!-- ═══════════════════ MAIN ═══════════════════ -->
<div class="main-wrap">

    <!-- TOP BAR -->
    <header class="topbar">
        <div class="breadcrumb">
            <i class="fas fa-house-chimney" style="font-size:12px;"></i>
            <span>›</span>
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
            <span>›</span>
            <span class="current">Profil Saya</span>
        </div>
    </header>

    <!-- CONTENT -->
    <main class="content">

        <!-- PROFILE HERO -->
        <div class="profile-hero">
            <div class="profile-avatar-lg">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>
            <div class="profile-hero-info">
                <div class="hero-badge">
                    <i class="fas fa-circle-check" style="font-size:10px;"></i>
                    Anggota Aktif
                </div>
                <h2 class="hero-name">{{ auth()->user()->name ?? 'Pengguna' }}</h2>
                <p class="hero-email">
                    <i class="fas fa-envelope" style="font-size:11px; margin-right:5px; opacity:0.7;"></i>
                    {{ auth()->user()->email ?? '' }}
                </p>
            </div>
        </div>


        <!-- SECTION LABEL -->
        <div class="divider">
            <div class="font-display" style="font-size:15px; font-weight:700; color:var(--text); white-space:nowrap;">Pengaturan Akun</div>
            <div class="divider-line"></div>
        </div>


        <!-- CARDS GRID -->
        <div class="profile-grid">

            <!-- ── 1. Profile Info ── -->
            <div class="profile-card indigo-accent">
                <div class="card-header">
                    <div class="card-icon card-icon-indigo">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <div class="card-title">Informasi Profil</div>
                        <div class="card-sub">Perbarui nama dan alamat email</div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status') === 'profile-updated')
                        <div class="alert-success">
                            <i class="fas fa-circle-check"></i>
                            Profil berhasil diperbarui.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input id="name" name="name" type="text" class="form-input"
                                   value="{{ old('name', $user->name) }}" required autofocus>
                            @error('name') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input id="email" name="email" type="email" class="form-input"
                                   value="{{ old('email', $user->email) }}" required>
                            @error('email') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="email-notice" style="margin-top:14px;">
                                <i class="fas fa-triangle-exclamation" style="color:#f59e0b; flex-shrink:0;"></i>
                                Email belum diverifikasi.
                                <form method="POST" action="{{ route('verification.send') }}" style="display:inline; margin:0;">
                                    @csrf
                                    <button type="submit" style="background:none; border:none; color:var(--indigo); font-weight:600; cursor:pointer; font-family:'DM Sans',sans-serif; font-size:13px; padding:0;">
                                        Kirim ulang
                                    </button>
                                </form>
                            </div>
                        @endif

                        <div style="display:flex; justify-content:flex-end; margin-top:22px;">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-check" style="font-size:11px;"></i>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ── 2. Change Password ── -->
            <div class="profile-card gray-accent">
                <div class="card-header">
                    <div class="card-icon card-icon-gray">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <div class="card-title">Ubah Password</div>
                        <div class="card-sub">Gunakan password yang kuat</div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status') === 'password-updated')
                        <div class="alert-success">
                            <i class="fas fa-circle-check"></i>
                            Password berhasil diperbarui.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="current_password" class="form-label">Password Saat Ini</label>
                            <input id="current_password" name="current_password" type="password"
                                   class="form-input" autocomplete="current-password" placeholder="••••••••">
                            @error('current_password', 'updatePassword')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Password Baru</label>
                            <input id="password" name="password" type="password"
                                   class="form-input" autocomplete="new-password" placeholder="••••••••">
                            @error('password', 'updatePassword')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group" style="margin-bottom:0;">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                   class="form-input" autocomplete="new-password" placeholder="••••••••">
                            @error('password_confirmation', 'updatePassword')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div style="display:flex; justify-content:flex-end; margin-top:22px;">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-shield-halved" style="font-size:11px;"></i>
                                Simpan Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ── 3. Delete Account (full width) ── -->
            <div class="profile-card full rose-accent">
                <div class="card-header">
                    <div class="card-icon card-icon-rose">
                        <i class="fas fa-trash-can"></i>
                    </div>
                    <div>
                        <div class="card-title" style="color:var(--rose);">Hapus Akun</div>
                        <div class="card-sub">Tindakan ini permanen dan tidak dapat dibatalkan</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="danger-box">
                        <p style="font-size:13.5px; color:#7f1d1d; line-height:1.7; margin-bottom:18px;">
                            Setelah akun Anda dihapus, semua data dan resource terkait akan hilang secara permanen.
                            Pastikan Anda telah mengunduh semua data penting sebelum melanjutkan.
                        </p>
                        <button type="button" class="btn-danger"
                                onclick="document.getElementById('deleteModal').classList.add('open')">
                            <i class="fas fa-trash-can" style="font-size:11px;"></i>
                            Hapus Akun Saya
                        </button>
                    </div>
                </div>
            </div>

        </div><!-- end .profile-grid -->

    </main>

    <!-- FOOTER -->
    <footer>
        <div class="foot-brand">
            <div style="width:30px; height:30px; background:linear-gradient(135deg,var(--indigo),var(--indigo-l)); border-radius:8px; display:flex; align-items:center; justify-content:center;">
                <i class="fas fa-book-open" style="color:#fff; font-size:12px;"></i>
            </div>
            Perpustakaan Digital
        </div>
        <p style="font-size:12px; color:#94a3b8;">© 2026 Perpustakaan Digital. Hak cipta dilindungi.</p>
    </footer>

</div><!-- end .main-wrap -->


<!-- ═══════════════════ DELETE MODAL ═══════════════════ -->
<div id="deleteModal" class="modal-overlay" onclick="if(event.target===this)this.classList.remove('open')">
    <div class="modal-box">
        <div class="modal-icon">
            <i class="fas fa-triangle-exclamation" style="color:var(--rose); font-size:20px;"></i>
        </div>
        <h3 style="font-family:'Sora',sans-serif; font-size:1.3rem; font-weight:800; margin-bottom:10px; color:var(--text);">
            Yakin ingin menghapus akun?
        </h3>
        <p style="font-size:13px; color:var(--text-sub); line-height:1.7; margin-bottom:24px;">
            Setelah akun dihapus, semua data akan hilang secara permanen. Masukkan password Anda untuk mengonfirmasi tindakan ini.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <div class="form-group" style="margin-bottom:20px;">
                <label for="modal_password" class="form-label">Password</label>
                <input id="modal_password" name="password" type="password"
                       class="form-input" placeholder="Masukkan password Anda">
                @error('password', 'userDeletion')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div style="display:flex; gap:10px; justify-content:flex-end;">
                <button type="button" class="btn-outline"
                        onclick="document.getElementById('deleteModal').classList.remove('open')">
                    Batal
                </button>
                <button type="submit" class="btn-danger">
                    <i class="fas fa-trash-can" style="font-size:11px;"></i>
                    Ya, Hapus Akun
                </button>
            </div>
        </form>
    </div>
</div>

</body>
</html>