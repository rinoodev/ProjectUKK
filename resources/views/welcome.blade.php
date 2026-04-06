<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Digital</title>
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
            --gold: #f59e0b;
        }

        html { scroll-behavior: smooth; }
        body {
            background: var(--bg);
            font-family: 'Sora', sans-serif;
            color: var(--text-primary);
        }

        /* ── Noise texture overlay ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 9999;
            opacity: 0.4;
        }

        /* ── Animations ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes floatGlow {
            0%, 100% { transform: translateY(0) scale(1); opacity: 0.6; }
            50% { transform: translateY(-20px) scale(1.05); opacity: 0.9; }
        }
        @keyframes spin-slow { to { transform: rotate(360deg); } }
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }

        .fade-up      { animation: fadeUp 0.75s cubic-bezier(.22,1,.36,1) both; }
        .fade-up-1    { animation-delay: 0.05s; }
        .fade-up-2    { animation-delay: 0.18s; }
        .fade-up-3    { animation-delay: 0.32s; }
        .fade-up-4    { animation-delay: 0.46s; }

        /* ── Header ── */
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

        /* ── Badge ── */
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
            box-shadow: 0 0 0 0 rgba(26,86,219,0.4);
        }
        @keyframes pulse-dot {
            0%   { box-shadow: 0 0 0 0 rgba(26,86,219,0.4); }
            70%  { box-shadow: 0 0 0 6px rgba(26,86,219,0); }
            100% { box-shadow: 0 0 0 0 rgba(26,86,219,0); }
        }

        /* ── Buttons ── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            background: linear-gradient(135deg, var(--blue) 0%, #2563eb 100%);
            color: #fff;
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.22s cubic-bezier(.22,1,.36,1);
            border: none;
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

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            background: var(--surface);
            color: var(--text-primary);
            border-radius: 12px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.22s cubic-bezier(.22,1,.36,1);
            border: 1.5px solid var(--border);
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }
        .btn-secondary:hover {
            border-color: #94a3b8;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }
        .btn-outline-blue {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            background: transparent;
            color: var(--blue);
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            border: 1.5px solid rgba(26,86,219,0.3);
        }
        .btn-outline-blue:hover {
            background: var(--blue-pale);
            border-color: var(--blue);
        }
        .btn-ghost-red {
            display: inline-flex;
            align-items: center;
            padding: 9px 20px;
            background: transparent;
            color: #ef4444;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            border: 1.5px solid rgba(239,68,68,0.3);
        }
        .btn-ghost-red:hover { background: #fef2f2; }

        /* ── Hero decorations ── */
        .hero-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(70px);
            pointer-events: none;
        }
        .orb-1 {
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(26,86,219,0.12) 0%, transparent 70%);
            top: -100px; left: 50%;
            transform: translateX(-50%);
            animation: floatGlow 7s ease-in-out infinite;
        }
        .orb-2 {
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(59,130,246,0.1) 0%, transparent 70%);
            top: 20px; right: 5%;
            animation: floatGlow 9s ease-in-out infinite 2s;
        }
        .orb-3 {
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(245,158,11,0.07) 0%, transparent 70%);
            top: 60px; left: 8%;
            animation: floatGlow 11s ease-in-out infinite 1s;
        }

        /* Decorative grid pattern in hero */
        .hero-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(26,86,219,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(26,86,219,0.04) 1px, transparent 1px);
            background-size: 48px 48px;
            mask-image: radial-gradient(ellipse 80% 60% at 50% 0%, black 0%, transparent 80%);
            pointer-events: none;
        }

        /* Hero title font */
        .hero-title {
            font-family: 'DM Serif Display', serif;
            font-size: clamp(2.8rem, 5.5vw, 4.2rem);
            line-height: 1.08;
            letter-spacing: -0.02em;
            color: var(--text-primary);
        }
        .hero-title .accent {
            background: linear-gradient(135deg, var(--blue) 0%, #60a5fa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Shimmer text */
        .shimmer-text {
            background: linear-gradient(90deg, var(--blue) 25%, #60a5fa 50%, var(--blue) 75%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 3s linear infinite;
        }

        /* ── Stats ── */
        .stat-wrapper {
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 32px 48px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.03);
            display: inline-flex;
            gap: 0;
        }
        .stat-item {
            padding: 0 40px;
            text-align: center;
        }
        .stat-item + .stat-item {
            border-left: 1px solid var(--border);
        }
        .stat-num {
            font-family: 'DM Serif Display', serif;
            font-size: 2.2rem;
            color: var(--text-primary);
            line-height: 1;
        }
        .stat-label {
            font-size: 12px;
            color: var(--text-secondary);
            margin-top: 6px;
            font-weight: 500;
            letter-spacing: 0.03em;
        }

        /* ── Features ── */
        .section-eyebrow {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--blue);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .section-eyebrow::before,
        .section-eyebrow::after {
            content: '';
            width: 24px; height: 1px;
            background: rgba(26,86,219,0.4);
        }
        .section-title {
            font-family: 'DM Serif Display', serif;
            font-size: 2.4rem;
            line-height: 1.15;
            letter-spacing: -0.02em;
            color: var(--text-primary);
        }

        .feature-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 36px;
            transition: all 0.3s cubic-bezier(.22,1,.36,1);
            position: relative;
            overflow: hidden;
        }
        .feature-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(26,86,219,0.04) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .feature-card:hover {
            border-color: rgba(26,86,219,0.3);
            box-shadow: 0 8px 40px rgba(26,86,219,0.1);
            transform: translateY(-5px);
        }
        .feature-card:hover::before { opacity: 1; }

        /* Decorative corner accent */
        .feature-card::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 80px; height: 80px;
            background: linear-gradient(225deg, rgba(26,86,219,0.06) 0%, transparent 60%);
            border-radius: 0 20px 0 80px;
            transition: opacity 0.3s;
        }

        .icon-box {
            width: 52px; height: 52px;
            background: linear-gradient(135deg, var(--blue-pale) 0%, #dbeafe 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
            border: 1px solid rgba(26,86,219,0.12);
            box-shadow: 0 2px 8px rgba(26,86,219,0.08);
        }
        .icon-box i { font-size: 18px; }

        /* ── Steps ── */
        .step-num {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, var(--blue) 0%, #2563eb 100%);
            color: white;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            font-weight: 700;
            font-family: 'DM Serif Display', serif;
            margin: 0 auto 20px;
            box-shadow: 0 6px 20px rgba(26,86,219,0.35);
            position: relative;
        }
        .step-num::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 19px;
            background: linear-gradient(135deg, rgba(26,86,219,0.2), transparent);
            z-index: -1;
        }

        /* Step connector line */
        .steps-grid {
            position: relative;
        }
        .steps-grid::before {
            content: '';
            position: absolute;
            top: 28px;
            left: calc(12.5%);
            right: calc(12.5%);
            height: 1.5px;
            background: linear-gradient(90deg, transparent, var(--blue-mid), var(--blue-mid), transparent);
            z-index: 0;
        }

        /* ── Book cards ── */
        .book-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(.22,1,.36,1);
            position: relative;
        }
        .book-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            border-color: rgba(26,86,219,0.2);
        }
        .book-cover {
            height: 200px;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        .book-cover::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 50px;
            background: linear-gradient(to top, rgba(255,255,255,0.5), transparent);
        }
        .book-cover img {
            width: 100%; height: 100%;
            object-fit: contain;
            transition: transform 0.4s;
        }
        .book-card:hover .book-cover img { transform: scale(1.04); }

        .book-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.03em;
        }
        .book-badge-cat {
            background: linear-gradient(90deg, #eff6ff, #dbeafe);
            color: var(--blue);
            border: 1px solid rgba(26,86,219,0.15);
        }
        .book-badge-available {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid rgba(22,163,74,0.2);
        }
        .book-badge-out {
            background: #fff1f2;
            color: #e11d48;
            border: 1px solid rgba(225,29,72,0.2);
        }

        /* Star rating */
        .stars { color: var(--gold); letter-spacing: 1px; }
        .stars-empty { color: #e2e8f0; }

        /* ── CTA section ── */
        .cta-section {
            background: linear-gradient(135deg, #0f2a6b 0%, #1a56db 45%, #2563eb 75%, #3b82f6 100%);
            position: relative;
            overflow: hidden;
        }
        .cta-section::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 400px; height: 400px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.08);
        }
        .cta-section::after {
            content: '';
            position: absolute;
            bottom: -120px; left: -60px;
            width: 350px; height: 350px;
            background: rgba(255,255,255,0.03);
            border-radius: 50%;
            border: 1px solid rgba(255,255,255,0.06);
        }
        .cta-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 48px 48px;
        }
        .btn-cta-white {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 36px;
            background: white;
            color: var(--blue);
            border-radius: 14px;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.25s cubic-bezier(.22,1,.36,1);
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            border: none;
        }
        .btn-cta-white:hover {
            background: #f8fafc;
            transform: translateY(-3px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.25);
        }

        /* ── Scroll reveal ── */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }
        .reveal-delay-1 { transition-delay: 0.1s; }
        .reveal-delay-2 { transition-delay: 0.2s; }
        .reveal-delay-3 { transition-delay: 0.3s; }

        /* ── Divider ── */
        .fancy-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border), transparent);
            margin: 0;
        }

        /* ── Footer ── */
        footer {
            background: white;
            border-top: 1px solid var(--border);
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header class="header-glass sticky top-0 z-50">
    <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-3">
            <div class="logo-mark">
                <i class="fas fa-book-open text-white text-sm"></i>
            </div>
            <span class="text-base font-bold text-gray-900 tracking-tight">Smart Pustaka</span>
        </div>

        <div class="flex gap-2 items-center">
            @auth
                <a href="{{ auth()->user()->role === 'admin' ? url('/admin/dashboard') : url('/') }}"
                class="btn-primary" style="padding:9px 20px;font-size:14px;">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn-ghost-red">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-outline-blue">Login</a>
                <a href="{{ route('register') }}" class="btn-primary" style="padding:9px 20px;font-size:14px;">Register</a>
            @endauth
        </div>
    </div>
</header>

<!-- HERO -->
<section class="bg-white relative overflow-hidden" style="min-height: 90vh; display: flex; align-items: center;">
    <div class="hero-grid"></div>
    <div class="hero-orb orb-1"></div>
    <div class="hero-orb orb-2"></div>
    <div class="hero-orb orb-3"></div>

    <div class="max-w-6xl mx-auto px-6 py-28 relative w-full">
        <div class="text-center space-y-8 max-w-3xl mx-auto">

            <div class="fade-up fade-up-1">
                <span class="badge">
                    <span class="badge-dot"></span>
                    Platform Perpustakaan Modern
                </span>
            </div>

            <h1 class="hero-title fade-up fade-up-2">
                Akses Ribuan Buku Digital<br/>
                <em class="accent not-italic">Kapan Saja, Di Mana Saja</em>
            </h1>

            <p class="fade-up fade-up-3 text-gray-500 text-lg max-w-xl mx-auto leading-relaxed" style="font-weight:400;">
                Sistem perpustakaan digital yang memudahkan pencarian, peminjaman,
                dan pengelolaan koleksi buku secara online dengan manajemen terintegrasi.
            </p>

            <div class="fade-up fade-up-4 flex flex-wrap justify-center gap-3 pt-2">
                <a href="/register" class="btn-primary">
                    Mulai Sekarang
                    <i class="fas fa-arrow-right text-sm"></i>
                </a>
                <a href="/login" class="btn-secondary">
                    Sudah Punya Akun
                </a>
            </div>

            <!-- Stats -->
            <div class="fade-up fade-up-4" style="animation-delay:0.6s; padding-top: 3.5rem;">
                <div class="stat-wrapper">
                    <div class="stat-item">
                        <div class="stat-num shimmer-text">
                            {{ $totalBooks }}+
                        </div>
                        <div class="stat-label">Koleksi Buku</div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-num shimmer-text">
                            {{ $totalUsers }}+
                        </div>
                        <div class="stat-label">Anggota Aktif</div>
                    </div>

                    <div class="stat-item">
                        <div class="stat-num shimmer-text">
                            {{ $avgRating }}/5
                        </div>
                        <div class="stat-label">Rating Pengguna</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="fancy-divider"></div>

<!-- FEATURES -->
<section class="py-28" style="background: var(--bg);">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <p class="section-eyebrow mb-4">Fitur</p>
            <h2 class="section-title mb-4">Fitur Unggulan</h2>
            <p class="text-gray-500" style="font-size:15px;">Kemudahan akses dan pengelolaan Smart Pustaka</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <div class="feature-card reveal reveal-delay-1">
                <div class="icon-box">
                    <i class="fas fa-book-open text-blue-600"></i>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-900 tracking-tight">Koleksi Lengkap</h3>
                <p class="text-gray-500 leading-relaxed text-sm">
                    Akses ribuan koleksi buku digital dari berbagai kategori yang terus diperbarui setiap bulannya.
                </p>
            </div>

            <div class="feature-card reveal reveal-delay-2">
                <div class="icon-box">
                    <i class="fas fa-bolt text-blue-600"></i>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-900 tracking-tight">Peminjaman Mudah</h3>
                <p class="text-gray-500 leading-relaxed text-sm">
                    Ajukan peminjaman buku secara online kapan saja tanpa perlu datang ke perpustakaan fisik.
                </p>
            </div>

            <div class="feature-card reveal reveal-delay-3">
                <div class="icon-box">
                    <i class="fas fa-star text-blue-600"></i>
                </div>
                <h3 class="font-bold text-xl mb-3 text-gray-900 tracking-tight">Rating & Ulasan</h3>
                <p class="text-gray-500 leading-relaxed text-sm">
                    Beri rating dan ulasan untuk membantu pengguna lain menemukan buku terbaik pilihan komunitas.
                </p>
            </div>
        </div>
    </div>
</section>

<div class="fancy-divider"></div>

<!-- HOW IT WORKS -->
<section class="py-28 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <p class="section-eyebrow mb-4">Panduan</p>
            <h2 class="section-title mb-4">Cara Menggunakan</h2>
            <p class="text-gray-500" style="font-size:15px;">Langkah mudah untuk memulai</p>
        </div>

        <div class="grid md:grid-cols-4 gap-8 steps-grid">
            <div class="text-center reveal reveal-delay-1" style="position:relative; z-index:1;">
                <div class="step-num">1</div>
                <h4 class="font-semibold text-gray-900 mb-2 tracking-tight">Daftar Akun</h4>
                <p class="text-gray-400 text-sm leading-relaxed">Buat akun gratis dengan mudah dalam hitungan menit</p>
            </div>
            <div class="text-center reveal reveal-delay-2" style="position:relative; z-index:1;">
                <div class="step-num">2</div>
                <h4 class="font-semibold text-gray-900 mb-2 tracking-tight">Cari Buku</h4>
                <p class="text-gray-400 text-sm leading-relaxed">Temukan buku yang Anda inginkan dari ribuan koleksi</p>
            </div>
            <div class="text-center reveal reveal-delay-3" style="position:relative; z-index:1;">
                <div class="step-num">3</div>
                <h4 class="font-semibold text-gray-900 mb-2 tracking-tight">Ajukan Pinjam</h4>
                <p class="text-gray-400 text-sm leading-relaxed">Pinjam buku secara online, konfirmasi instan</p>
            </div>
            <div class="text-center reveal" style="transition-delay:0.4s; position:relative; z-index:1;">
                <div class="step-num">4</div>
                <h4 class="font-semibold text-gray-900 mb-2 tracking-tight">Baca & Review</h4>
                <p class="text-gray-400 text-sm leading-relaxed">Nikmati bacaan dan bagikan pengalaman Anda</p>
            </div>
        </div>
    </div>
</section>

<div class="fancy-divider"></div>

<!-- BUKU TERBARU -->
<section class="py-28" style="background: var(--bg);">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-16 reveal">
            <p class="section-eyebrow mb-4">Koleksi</p>
            <h2 class="section-title mb-4">Buku Terbaru</h2>
            <p class="text-gray-500" style="font-size:15px;">Jelajahi sebagian koleksi yang tersedia di Smart Pustaka</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach($books as $book)
            <div class="book-card reveal reveal-delay-{{ $loop->index % 3 + 1 }}">
                <div class="book-cover">
                    @if($book->image)
                        <img src="{{ asset('storage/'.$book->image) }}" alt="{{ $book->judul }}">
                    @else
                        <div style="display:flex; flex-direction:column; align-items:center; gap:8px;">
                            <i class="fas fa-book-open text-blue-300" style="font-size:2.5rem;"></i>
                        </div>
                    @endif
                </div>

                <div class="p-5">
                    <h4 class="font-semibold text-gray-900 mb-1" style="font-size:15px; line-height:1.4; overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">
                        {{ $book->judul }}
                    </h4>
                    <p class="text-sm text-gray-400 mb-3" style="font-weight:500;">{{ $book->penulis }}</p>

                    <div class="flex items-center justify-between flex-wrap gap-2">
                        <span class="book-badge book-badge-cat">
                            {{ $book->kategori->nama ?? 'Umum' }}
                        </span>
                        @if($book->stok > 0)
                            <span class="book-badge book-badge-available">
                                <i class="fas fa-circle" style="font-size:6px; margin-right:4px;"></i>Tersedia
                            </span>
                        @else
                            <span class="book-badge book-badge-out">
                                <i class="fas fa-circle" style="font-size:6px; margin-right:4px;"></i>Habis
                            </span>
                        @endif
                    </div>

                    @php
                        $avg = $book->ratings_avg_rating ?? 0;
                        $rounded = round($avg);
                    @endphp
                    <div class="flex items-center gap-2 mt-3 pt-3" style="border-top: 1px solid var(--border);">
                        <div>
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= $rounded)
                                    <span class="stars" style="font-size:13px;">★</span>
                                @else
                                    <span class="stars-empty" style="font-size:13px;">★</span>
                                @endif
                            @endfor
                        </div>
                        <span class="text-xs text-gray-400 font-medium">{{ number_format($avg, 1) }} · {{ $book->ratings_count }} ulasan</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-14">
            <a href="{{ route('login') }}" class="btn-primary" style="padding: 14px 36px; font-size: 15px;">
                <i class="fas fa-book-open text-sm"></i>
                Lihat Semua Buku
            </a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section py-28">
    <div class="cta-grid"></div>
    <div class="max-w-4xl mx-auto px-6 text-center text-white relative z-10 reveal">
        <div style="margin-bottom:16px;">
            <span style="display:inline-flex; align-items:center; gap:6px; background:rgba(255,255,255,0.12); border:1px solid rgba(255,255,255,0.2); border-radius:999px; padding:6px 16px; font-size:12px; font-weight:600; letter-spacing:0.05em; text-transform:uppercase;">
                <i class="fas fa-rocket text-xs" style="color:#fbbf24;"></i>
                Daftar Gratis
            </span>
        </div>
        <h2 style="font-family:'DM Serif Display',serif; font-size:3rem; line-height:1.1; letter-spacing:-0.02em; margin-bottom:20px;">
            Bergabunglah Sekarang
        </h2>
        <p style="color:rgba(255,255,255,0.7); margin-bottom:40px; font-size:17px; max-width:480px; margin-left:auto; margin-right:auto; line-height:1.7;">
            Dapatkan akses penuh ke ribuan koleksi buku digital secara gratis
        </p>
        <a href="/register" class="btn-cta-white">
            Daftar Sekarang
            <i class="fas fa-arrow-right text-sm"></i>
        </a>
    </div>
</section>

<!-- FOOTER -->
<footer class="py-8">
    <div class="max-w-6xl mx-auto px-6 flex flex-col items-center gap-3">
        <div class="flex items-center gap-2">
            <div class="logo-mark" style="width:24px;height:24px;border-radius:7px;">
                <i class="fas fa-book-open text-white" style="font-size:10px;"></i>
            </div>
            <span style="font-size:13px; font-weight:700; color:var(--text-primary);">Smart Pustaka</span>
        </div>
        <p class="text-sm text-gray-400">© 2026 Smart Pustaka. All rights reserved.</p>
    </div>
</footer>

<script>
    // Scroll reveal
    const reveals = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });
    reveals.forEach(el => observer.observe(el));
</script>

</body>
</html>