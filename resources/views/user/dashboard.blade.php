<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Perpustakaan Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    <style>
        :root {
            --indigo:   #4f46e5;
            --indigo-l: #6366f1;
            --indigo-xl: #e0e7ff;
            --emerald:  #059669;
            --emerald-l:#d1fae5;
            --rose:     #e11d48;
            --rose-l:   #ffe4e6;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            margin: 0;
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

        .nav-item:hover {
            background: rgba(255,255,255,0.07);
            color: #fff;
        }

        .nav-item.active {
            background: rgba(99,102,241,0.18);
            color: #a5b4fc;
        }

        .nav-item.active .nav-icon {
            color: var(--indigo-l);
        }

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
            font-weight: 700;
            color: #fff;
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
            border-bottom: 1px solid #e2e8f0;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 36px;
            position: sticky; top: 0; z-index: 30;
        }

        .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #94a3b8; }
        .breadcrumb .current { color: #1e293b; font-weight: 600; }

        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .btn-logout {
            display: flex; align-items: center; gap: 7px;
            padding: 8px 16px;
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            color: #64748b;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
        }
        .btn-logout:hover { border-color: #fda4af; color: var(--rose); background: #fff1f2; }

        /* ── CONTENT ── */
        .content { padding: 36px; flex: 1; }

        /* ── HERO ── */
        .hero-card {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 45%, #3730a3 100%);
            border-radius: 20px;
            padding: 36px 40px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .hero-card::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(129,140,248,0.25) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-card::after {
            content: '';
            position: absolute;
            bottom: -40px; left: 30%;
            width: 180px; height: 180px;
            background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-greeting {
            font-family: 'Sora', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: rgba(199,210,254,0.75);
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .hero-name {
            font-family: 'Sora', sans-serif;
            font-size: 32px;
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 10px;
        }

        .hero-sub {
            font-size: 14px;
            color: rgba(199,210,254,0.65);
            max-width: 380px;
        }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(165,180,252,0.15);
            border: 1px solid rgba(165,180,252,0.25);
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
            color: #a5b4fc;
            margin-bottom: 18px;
        }

        .hero-illustration {
            position: relative; z-index: 2;
            opacity: 0.9;
        }

        .hero-icon-wrap {
            width: 96px; height: 96px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 24px;
            display: flex; align-items: center; justify-content: center;
            backdrop-filter: blur(10px);
        }

        /* ── STATS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #e8edf4;
            position: relative;
            overflow: hidden;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            animation: fadeUp 0.5s ease both;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.08);
            border-color: transparent;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            border-radius: 0 0 16px 16px;
        }

        .stat-card.indigo::after { background: linear-gradient(90deg, var(--indigo), var(--indigo-l)); }
        .stat-card.emerald::after { background: linear-gradient(90deg, #059669, #34d399); }
        .stat-card.rose::after { background: linear-gradient(90deg, var(--rose), #fb7185); }

        .stat-icon-wrap {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 18px;
            transition: transform 0.25s ease;
        }

        .stat-card:hover .stat-icon-wrap { transform: scale(1.08); }

        .stat-card.indigo .stat-icon-wrap { background: var(--indigo-xl); }
        .stat-card.emerald .stat-icon-wrap { background: var(--emerald-l); }
        .stat-card.rose .stat-icon-wrap { background: var(--rose-l); }

        .stat-label { font-size: 11px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; color: #94a3b8; margin-bottom: 6px; }
        .stat-value { font-family: 'Sora', sans-serif; font-size: 38px; font-weight: 800; color: #0f172a; line-height: 1; margin-bottom: 4px; }
        .stat-desc { font-size: 12.5px; color: #94a3b8; }

        /* ── SECTION HEADER ── */
        .section-header { margin-bottom: 18px; }
        .section-title { font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: #0f172a; margin-bottom: 3px; }
        .section-sub { font-size: 13px; color: #94a3b8; }

        /* ── ACTION CARDS ── */
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }

        .action-card {
            background: #fff;
            border-radius: 16px;
            padding: 28px;
            border: 1.5px solid #e8edf4;
            text-decoration: none;
            display: flex; flex-direction: column;
            position: relative;
            overflow: hidden;
            transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
            animation: fadeUp 0.5s ease both;
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.09);
        }

        .action-card.indigo:hover { border-color: #a5b4fc; }
        .action-card.rose:hover   { border-color: #fda4af; }
        .action-card.emerald:hover { border-color: #6ee7b7; }

        .action-icon {
            width: 48px; height: 48px;
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 20px;
            font-size: 18px;
            color: #fff;
            transition: transform 0.28s ease;
        }

        .action-card:hover .action-icon { transform: scale(1.1) rotate(-5deg); }
        .action-card.indigo .action-icon  { background: linear-gradient(135deg, var(--indigo), var(--indigo-l)); box-shadow: 0 6px 16px rgba(79,70,229,0.35); }
        .action-card.rose .action-icon    { background: linear-gradient(135deg, var(--rose), #fb7185); box-shadow: 0 6px 16px rgba(225,29,72,0.3); }
        .action-card.emerald .action-icon { background: linear-gradient(135deg, #059669, #34d399); box-shadow: 0 6px 16px rgba(5,150,105,0.3); }

        .action-title { font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 700; color: #0f172a; margin-bottom: 8px; }
        .action-desc  { font-size: 13px; color: #64748b; line-height: 1.55; flex: 1; margin-bottom: 20px; }

        .action-link {
            display: inline-flex; align-items: center; gap: 7px;
            font-size: 13px; font-weight: 600;
            transition: gap 0.2s ease;
        }

        .action-card:hover .action-link { gap: 10px; }
        .action-card.indigo .action-link  { color: var(--indigo); }
        .action-card.rose .action-link    { color: var(--rose); }
        .action-card.emerald .action-link { color: var(--emerald); }

        .action-card-bg {
            position: absolute;
            bottom: -20px; right: -20px;
            width: 80px; height: 80px;
            border-radius: 50%;
            opacity: 0.05;
            font-size: 60px;
            display: flex; align-items: center; justify-content: center;
        }

        .action-card.indigo .action-card-bg { background: var(--indigo); }
        .action-card.rose   .action-card-bg { background: var(--rose); }
        .action-card.emerald .action-card-bg { background: var(--emerald); }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid #e2e8f0;
            margin-top: auto;
            padding: 22px 36px;
            display: flex; align-items: center; justify-content: space-between;
        }

        footer .foot-brand { display: flex; align-items: center; gap: 10px; font-family: 'Sora', sans-serif; font-weight: 700; font-size: 14px; color: #0f172a; }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .stat-card:nth-child(1) { animation-delay: 0.05s; }
        .stat-card:nth-child(2) { animation-delay: 0.12s; }
        .stat-card:nth-child(3) { animation-delay: 0.19s; }

        .action-card:nth-child(1) { animation-delay: 0.22s; }
        .action-card:nth-child(2) { animation-delay: 0.29s; }
        .action-card:nth-child(3) { animation-delay: 0.36s; }

        .hero-card { animation: fadeUp 0.4s ease both; }

        /* ── DIVIDER LINE ── */
        .divider { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .divider-line { flex: 1; height: 1px; background: #e2e8f0; }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .stats-grid, .actions-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-wrap { margin-left: 0; }
            .content { padding: 20px; }
            .stats-grid, .actions-grid { grid-template-columns: 1fr; }
            .hero-illustration { display: none; }
            .hero-name { font-size: 24px; }
            .topbar { padding: 0 20px; }
        }
    </style>
</head>
<body>

<!-- ═══════════════════════════════════════════════
     SIDEBAR
════════════════════════════════════════════════ -->
<aside class="sidebar">

    <!-- Brand -->
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

    <!-- Nav -->
    <nav>
        <div class="nav-label">Menu</div>

        <a href="{{ route('user.dashboard') }}" class="nav-item active">
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

        <a href="{{ (url('/profile')) }}" class="nav-item">
            <i class="fas fa-user nav-icon"></i>
            Profil Saya
        </a>
    </nav>

    <!-- User footer -->
    <div class="sidebar-user">
        <div class="avatar-sm">{{ substr(auth()->user()->name, 0, 1) }}</div>
        <div style="flex:1; min-width:0;">
            <div style="font-size:13px; font-weight:600; color:#e2e8f0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ auth()->user()->name }}</div>
            <div style="font-size:11px; color:rgba(255,255,255,0.35);">Anggota Aktif</div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background:none; border:none; color:rgba(255,255,255,0.4); cursor:pointer; padding:4px; transition:color 0.2s;" onmouseover="this.style.color='#fda4af'" onmouseout="this.style.color='rgba(255,255,255,0.4)'">
                <i class="fas fa-right-from-bracket" style="font-size:14px;"></i>
            </button>
        </form>
    </div>

</aside>


<!-- ═══════════════════════════════════════════════
     MAIN WRAPPER
════════════════════════════════════════════════ -->
<div class="main-wrap">

    <!-- ── TOP BAR ── -->
    <header class="topbar">
        <div class="breadcrumb">
            <i class="fas fa-house-chimney" style="font-size:12px;"></i>
            <span>›</span>
            <span class="current">Dashboard</span>
        </div>
    </header>


    <!-- ── CONTENT ── -->
    <main class="content">

        <!-- HERO -->
        <div class="hero-card">
            <div style="position:relative; z-index:2;">
                <div class="hero-badge">
                    <i class="fas fa-circle-check" style="font-size:10px;"></i>
                    Akun Aktif
                </div>
                <p class="hero-greeting">Selamat Datang Kembali 👋</p>
                <h2 class="hero-name">{{ auth()->user()->name }}</h2>
                <p class="hero-sub">Kelola aktivitas perpustakaan Anda dengan mudah dan efisien dari satu tempat.</p>
            </div>
            <div class="hero-illustration">
                <div class="hero-icon-wrap">
                    <i class="fas fa-book-open" style="font-size:42px; color:rgba(199,210,254,0.85);"></i>
                </div>
            </div>
        </div>


        <!-- STATS -->
        <div class="stats-grid">

            <div class="stat-card indigo">
                <div class="stat-icon-wrap">
                    <i class="fas fa-book" style="color:var(--indigo); font-size:18px;"></i>
                </div>
                <div class="stat-label">Total Buku</div>
                <div class="stat-value">{{ $totalBooks }}</div>
                <div class="stat-desc">Buku tersedia di katalog</div>
            </div>

            <div class="stat-card emerald">
                <div class="stat-icon-wrap">
                    <i class="fas fa-book-reader" style="color:var(--emerald); font-size:18px;"></i>
                </div>
                <div class="stat-label">Sedang Dipinjam</div>
                <div class="stat-value">{{ $borrowedBooks }}</div>
                <div class="stat-desc">Buku yang aktif dipinjam</div>
            </div>

            <div class="stat-card rose">
                <div class="stat-icon-wrap">
                    <i class="fas fa-heart" style="color:var(--rose); font-size:18px;"></i>
                </div>
                <div class="stat-label">Buku Favorit</div>
                <div class="stat-value">{{ $favorites }}</div>
                <div class="stat-desc">Koleksi yang tersimpan</div>
            </div>
        </div>


        <!-- QUICK ACTIONS -->
        <div class="section-header">
            <div class="divider">
                <div class="section-title" style="white-space:nowrap;">Akses Cepat</div>
                <div class="divider-line"></div>
            </div>
            <p class="section-sub">Navigasi utama sistem perpustakaan digital</p>
        </div>

        <div class="actions-grid">

            <a href="{{ route('user.books') }}" class="action-card indigo">
                <div class="action-icon">
                    <i class="fas fa-book"></i>
                </div>
                <div class="action-title">Katalog Buku</div>
                <div class="action-desc">Telusuri koleksi lengkap perpustakaan dan pinjam buku yang Anda inginkan.</div>
                <div class="action-link">
                    Lihat Katalog
                    <i class="fas fa-arrow-right" style="font-size:11px;"></i>
                </div>
                <div class="action-card-bg"></div>
            </a>

            <a href="{{ route('user.favorites') }}" class="action-card rose">
                <div class="action-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="action-title">Buku Favorit</div>
                <div class="action-desc">Kelola daftar buku yang Anda tandai dan simpan sebagai favorit.</div>
                <div class="action-link">
                    Lihat Favorit
                    <i class="fas fa-arrow-right" style="font-size:11px;"></i>
                </div>
                <div class="action-card-bg"></div>
            </a>

            <a href="{{ route('user.borrowing.index') }}" class="action-card emerald">
                <div class="action-icon">
                    <i class="fas fa-clock-rotate-left"></i>
                </div>
                <div class="action-title">Riwayat Peminjaman</div>
                <div class="action-desc">Pantau status, histori, dan tanggal pengembalian buku Anda.</div>
                <div class="action-link">
                    Lihat Riwayat
                    <i class="fas fa-arrow-right" style="font-size:11px;"></i>
                </div>
                <div class="action-card-bg"></div>
            </a>

        </div>

    </main>


    <!-- FOOTER -->
    <footer>
        <div class="foot-brand">
            <div style="width:30px; height:30px; background:linear-gradient(135deg,var(--indigo),var(--indigo-l)); border-radius:8px; display:flex; align-items:center; justify-content:center;">
                <i class="fas fa-book-open" style="color:#fff; font-size:12px;"></i>
            </div>
            Smart Pustaka
        </div>
        <p style="font-size:12px; color:#94a3b8;">© 2026 Smart Pustaka. Hak cipta dilindungi.</p>
    </footer>

</div><!-- end .main-wrap -->

</body>
</html>