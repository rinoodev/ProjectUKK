<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Peminjaman | Perpustakaan Digital</title>
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
            --amber:     #d97706;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            margin: 0;
        }

        h1, h2, h3, h4, .font-display { font-family: 'Sora', sans-serif; }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 260px;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            background: #0f172a;
            display: flex; flex-direction: column;
            z-index: 40;
            padding: 0 0 24px;
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
            font-size: 10px; font-weight: 600;
            letter-spacing: 0.1em; color: rgba(255,255,255,0.28);
            padding: 0 12px; margin: 20px 0 8px;
            text-transform: uppercase;
        }

        .nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 14px; border-radius: 10px;
            font-size: 13.5px; font-weight: 500;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            transition: all 0.2s ease;
            position: relative; margin-bottom: 2px;
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
            margin: 0 16px; padding: 14px;
            background: rgba(255,255,255,0.06);
            border-radius: 12px;
            display: flex; align-items: center; gap: 11px;
        }

        .avatar-sm {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--indigo), var(--indigo-l));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: #fff; font-size: 13px;
            font-family: 'Sora', sans-serif; flex-shrink: 0;
        }

        /* ── MAIN ── */
        .main-wrap {
            margin-left: 260px;
            min-height: 100vh;
            display: flex; flex-direction: column;
        }

        /* ── TOP BAR ── */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 36px;
            position: sticky; top: 0; z-index: 30;
        }

        .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #94a3b8; }
        .breadcrumb .current { color: #1e293b; font-weight: 600; }
        .breadcrumb a { color: #94a3b8; text-decoration: none; transition: color 0.2s; }
        .breadcrumb a:hover { color: var(--indigo); }

        .topbar-right { display: flex; align-items: center; gap: 10px; }

        .btn-logout {
            display: flex; align-items: center; gap: 7px;
            padding: 8px 16px; background: #fff;
            border: 1.5px solid #e2e8f0; border-radius: 10px;
            font-size: 13px; font-weight: 500; color: #64748b;
            cursor: pointer; transition: all 0.2s;
            text-decoration: none; font-family: 'DM Sans', sans-serif;
        }
        .btn-logout:hover { border-color: #fda4af; color: var(--rose); background: #fff1f2; }

        /* ── CONTENT ── */
        .content { padding: 36px; flex: 1; }

        /* ── PAGE HERO ── */
        .page-hero {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 45%, #3730a3 100%);
            border-radius: 20px;
            padding: 28px 36px;
            margin-bottom: 28px;
            display: flex; align-items: center; justify-content: space-between;
            position: relative; overflow: hidden;
            animation: fadeUp 0.4s ease both;
        }

        .page-hero::before {
            content: '';
            position: absolute; top: -50px; right: -50px;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(129,140,248,0.22) 0%, transparent 70%);
            border-radius: 50%;
        }

        .page-hero-label {
            font-size: 11px; font-weight: 600; letter-spacing: 0.1em;
            text-transform: uppercase; color: rgba(199,210,254,0.65);
            margin-bottom: 6px;
        }

        .page-hero-title {
            font-family: 'Sora', sans-serif;
            font-size: 24px; font-weight: 800;
            color: #fff; line-height: 1.15; margin-bottom: 6px;
        }

        .page-hero-sub { font-size: 13px; color: rgba(199,210,254,0.6); }

        .page-hero-icon {
            position: relative; z-index: 2;
            width: 64px; height: 64px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            backdrop-filter: blur(10px);
        }

        /* ── LAYOUT GRID ── */
        .borrow-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 20px;
            margin-bottom: 20px;
            animation: fadeUp 0.5s ease both;
            animation-delay: 0.1s;
        }

        /* ── CARD BASE ── */
        .card {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #e8edf4;
            overflow: hidden;
        }

        .card-header {
            padding: 18px 22px 16px;
            border-bottom: 1px solid #f1f5f9;
            display: flex; align-items: center; gap: 9px;
        }

        .card-header-icon {
            width: 32px; height: 32px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; color: #fff;
            flex-shrink: 0;
        }

        .card-header-icon.indigo  { background: linear-gradient(135deg, var(--indigo), var(--indigo-l)); }
        .card-header-icon.amber   { background: linear-gradient(135deg, #d97706, #f59e0b); }

        .card-header-title {
            font-family: 'Sora', sans-serif;
            font-size: 14px; font-weight: 700; color: #0f172a;
            flex: 1;
        }

        .card-header-count {
            font-size: 11px; font-weight: 700;
            background: var(--indigo-xl); color: var(--indigo);
            padding: 3px 9px; border-radius: 999px;
        }

        /* ── BOOK DETAIL CARD ── */
        .book-cover-wrap {
            margin: 16px;
            border-radius: 12px; overflow: hidden;
            background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
            height: 200px;
            display: flex; align-items: center; justify-content: center;
        }

        .book-cover-wrap img {
            width: 100%; height: 100%; object-fit: contain;
            transition: transform 0.35s ease;
        }

        .book-cover-wrap:hover img { transform: scale(1.04); }

        .book-meta { padding: 0 16px 16px; }

        .book-title-main {
            font-family: 'Sora', sans-serif;
            font-size: 15px; font-weight: 800;
            color: #0f172a; margin-bottom: 3px; line-height: 1.3;
        }

        .book-author-main { font-size: 13px; color: #64748b; margin-bottom: 14px; }

        .meta-divider { height: 1px; background: #f1f5f9; margin: 12px 0; }

        .meta-row {
            display: flex; align-items: flex-start; gap: 10px;
            margin-bottom: 10px;
        }
        .meta-row:last-child { margin-bottom: 0; }

        .meta-icon {
            width: 28px; height: 28px;
            background: var(--indigo-xl);
            border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; margin-top: 1px;
        }
        .meta-icon i { color: var(--indigo); font-size: 10px; }

        .meta-label { font-size: 10.5px; color: #94a3b8; margin-bottom: 1px; }
        .meta-value { font-size: 12.5px; font-weight: 600; color: #374151; }
        .meta-value.long { font-weight: 400; color: #64748b; line-height: 1.5; }

        .stock-status {
            margin: 0 16px 16px;
            padding: 10px 14px;
            border-radius: 10px;
            display: flex; align-items: center; gap: 8px;
            font-size: 12px; font-weight: 600;
        }
        .stock-status.available { background: var(--emerald-l); color: var(--emerald); border: 1px solid rgba(5,150,105,0.2); }
        .stock-status.empty     { background: var(--rose-l);    color: var(--rose);    border: 1px solid rgba(225,29,72,0.2); }

        .pulse-dot { width: 7px; height: 7px; border-radius: 50%; background: currentColor; }
        .pulse-dot.anim { animation: pulse 1.5s infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.35; } }

        /* ── FORM CARD ── */
        .form-body { padding: 22px; }

        .borrower-box {
            background: linear-gradient(135deg, #eef2ff, #e0e7ff);
            border: 1.5px solid #c7d2fe;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 22px;
            display: flex; align-items: center; gap: 12px;
        }

        .borrower-avatar {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--indigo), var(--indigo-l));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-family: 'Sora', sans-serif;
            font-weight: 800; color: #fff; font-size: 15px;
            flex-shrink: 0;
            box-shadow: 0 3px 10px rgba(79,70,229,0.3);
        }

        .borrower-label { font-size: 10.5px; color: #6366f1; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 2px; }
        .borrower-name  { font-family: 'Sora', sans-serif; font-size: 14px; font-weight: 700; color: #312e81; }
        .borrower-email { font-size: 12px; color: #6366f1; }

        .field-group { margin-bottom: 18px; }

        .field-label {
            display: block;
            font-size: 12.5px; font-weight: 700;
            color: #374151; margin-bottom: 7px;
        }

        .field-input {
            width: 100%;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 13.5px;
            font-family: 'DM Sans', sans-serif;
            color: #0f172a; outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fff;
        }
        .field-input:focus {
            border-color: var(--indigo);
            box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
        }

        .warning-box {
            background: #fffbeb;
            border: 1.5px solid #fde68a;
            border-radius: 12px;
            padding: 14px 16px;
            display: flex; gap: 12px;
            margin-bottom: 24px;
        }

        .warning-icon {
            width: 32px; height: 32px;
            background: #fef3c7; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .warning-title { font-family: 'Sora', sans-serif; font-size: 12.5px; font-weight: 700; color: #92400e; margin-bottom: 6px; }
        .warning-list  { list-style: none; padding: 0; margin: 0; }
        .warning-list li { font-size: 12px; color: #a16207; margin-bottom: 3px; display: flex; align-items: center; gap: 6px; }
        .warning-list li::before { content: '•'; color: #f59e0b; font-size: 14px; }

        .form-actions { display: flex; gap: 12px; }

        .btn-cancel {
            display: flex; align-items: center; justify-content: center; gap: 7px;
            padding: 12px 22px;
            background: #fff; border: 1.5px solid #e2e8f0;
            border-radius: 10px; font-size: 13.5px; font-weight: 600;
            color: #64748b; cursor: pointer; text-decoration: none;
            transition: all 0.2s; font-family: 'DM Sans', sans-serif;
        }
        .btn-cancel:hover { border-color: #cbd5e1; background: #f8fafc; color: #374151; }

        .btn-confirm {
            flex: 1;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            padding: 12px 22px;
            background: linear-gradient(135deg, var(--indigo), var(--indigo-l));
            border: none; border-radius: 10px;
            font-size: 13.5px; font-weight: 700;
            color: #fff; cursor: pointer;
            transition: all 0.22s ease;
            box-shadow: 0 4px 14px rgba(79,70,229,0.35);
            font-family: 'DM Sans', sans-serif;
        }
        .btn-confirm:hover { transform: translateY(-1px); box-shadow: 0 7px 20px rgba(79,70,229,0.45); }

        /* ── REVIEWS SECTION ── */
        .reviews-card {
            animation: fadeUp 0.5s ease both;
            animation-delay: 0.2s;
        }

        .reviews-body { padding: 22px; }

        /* Rating summary bar */
        .rating-summary {
            display: flex; align-items: center; gap: 24px;
            padding: 20px 22px;
            background: linear-gradient(135deg, #fafafa, #f8fafc);
            border-bottom: 1px solid #f1f5f9;
        }

        .rating-big {
            text-align: center; flex-shrink: 0;
        }

        .rating-big-num {
            font-family: 'Sora', sans-serif;
            font-size: 42px; font-weight: 800;
            color: #0f172a; line-height: 1;
            margin-bottom: 6px;
        }

        .rating-big-stars { display: flex; gap: 3px; justify-content: center; margin-bottom: 4px; }
        .rating-big-stars i { font-size: 14px; color: #fbbf24; }
        .rating-big-count { font-size: 11.5px; color: #94a3b8; }

        .rating-bars { flex: 1; }

        .bar-row {
            display: flex; align-items: center; gap: 10px;
            margin-bottom: 6px;
        }
        .bar-row:last-child { margin-bottom: 0; }

        .bar-label { font-size: 11.5px; color: #64748b; width: 36px; text-align: right; flex-shrink: 0; }
        .bar-track { flex: 1; height: 6px; background: #e2e8f0; border-radius: 999px; overflow: hidden; }
        .bar-fill  { height: 100%; background: linear-gradient(90deg, #fbbf24, #f59e0b); border-radius: 999px; transition: width 0.6s ease; }
        .bar-count { font-size: 11px; color: #94a3b8; width: 20px; flex-shrink: 0; }

        /* Review list */
        .review-item {
            padding: 18px 0;
            border-bottom: 1px solid #f1f5f9;
            animation: fadeUp 0.4s ease both;
        }
        .review-item:last-child { border-bottom: none; padding-bottom: 0; }

        .review-top {
            display: flex; align-items: flex-start; justify-content: space-between;
            margin-bottom: 8px;
        }

        .reviewer-info { display: flex; align-items: center; gap: 10px; }

        .reviewer-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--indigo), var(--indigo-l));
            display: flex; align-items: center; justify-content: center;
            font-family: 'Sora', sans-serif;
            font-weight: 700; color: #fff; font-size: 13px;
            flex-shrink: 0;
        }

        .reviewer-name  { font-family: 'Sora', sans-serif; font-size: 13px; font-weight: 700; color: #0f172a; }
        .reviewer-date  { font-size: 11.5px; color: #94a3b8; }

        .review-stars { display: flex; gap: 2px; }
        .review-stars i { font-size: 11px; color: #fbbf24; }
        .review-stars i.empty { color: #e2e8f0; }

        .review-text { font-size: 13px; color: #4b5563; line-height: 1.6; padding-left: 46px; }

        .empty-reviews {
            text-align: center; padding: 40px 20px;
        }

        .empty-reviews-icon {
            width: 56px; height: 56px;
            background: #fef3c7; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 12px;
        }

        .empty-reviews-title { font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 700; color: #374151; margin-bottom: 4px; }
        .empty-reviews-sub { font-size: 13px; color: #94a3b8; }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid #e2e8f0;
            padding: 22px 36px;
            display: flex; align-items: center; justify-content: space-between;
        }

        footer .foot-brand {
            display: flex; align-items: center; gap: 10px;
            font-family: 'Sora', sans-serif; font-weight: 700; font-size: 14px; color: #0f172a;
        }

        /* ── ANIMATION ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 900px) { .borrow-grid { grid-template-columns: 1fr; } }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-wrap { margin-left: 0; }
            .content { padding: 20px; }
            .page-hero-icon { display: none; }
            .topbar { padding: 0 20px; }
            .form-actions { flex-direction: column; }
            .rating-summary { flex-direction: column; gap: 16px; }
        }
    </style>
</head>
<body>

<!-- ═══════════════════════════════════════
     SIDEBAR
═══════════════════════════════════════ -->
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

        <a href="{{ route('user.books') }}" class="nav-item active">
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


<!-- ═══════════════════════════════════════
     MAIN
═══════════════════════════════════════ -->
<div class="main-wrap">

    <!-- TOP BAR -->
    <header class="topbar">
        <div class="breadcrumb">
            <i class="fas fa-house-chimney" style="font-size:12px;"></i>
            <span>›</span>
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
            <span>›</span>
            <a href="{{ route('user.books') }}">Katalog Buku</a>
            <span>›</span>
            <span class="current">Form Peminjaman</span>
        </div>

        <div class="topbar-right">
            <div style="display:flex; align-items:center; gap:8px; padding:7px 14px; background:#f8fafc; border:1.5px solid #e2e8f0; border-radius:10px;">
                <div style="width:26px; height:26px; background:linear-gradient(135deg, var(--indigo), var(--indigo-l)); border-radius:50%; display:flex; align-items:center; justify-content:center;">
                    <span style="color:#fff; font-weight:700; font-size:11px; font-family:'Sora',sans-serif;">{{ substr(auth()->user()->name, 0, 1) }}</span>
                </div>
                <span style="font-size:13px; font-weight:600; color:#374151;">{{ auth()->user()->name }}</span>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn-logout" type="submit">
                    <i class="fas fa-sign-out-alt" style="font-size:12px;"></i>
                    Keluar
                </button>
            </form>
        </div>
    </header>


    <!-- CONTENT -->
    <main class="content">

        <!-- PAGE HERO -->
        <div class="page-hero">
            <div style="position:relative; z-index:2;">
                <p class="page-hero-label">Katalog Buku</p>
                <h2 class="page-hero-title">Form Peminjaman</h2>
                <p class="page-hero-sub">Lengkapi informasi di bawah untuk meminjam buku</p>
            </div>
            <div class="page-hero-icon">
                <i class="fas fa-clipboard-list" style="font-size:26px; color:rgba(199,210,254,0.85);"></i>
            </div>
        </div>


        <!-- ── BORROW GRID ── -->
        <div class="borrow-grid">

            <!-- BOOK DETAIL CARD -->
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon indigo"><i class="fas fa-book"></i></div>
                    <span class="card-header-title">Detail Buku</span>
                </div>

                <div class="book-cover-wrap">
                    @if($book->image)
                        <img src="{{ asset('storage/'.$book->image) }}" alt="{{ $book->judul }}">
                    @else
                        <i class="fas fa-book-open" style="font-size:52px; color:#c7d2fe;"></i>
                    @endif
                </div>

                <div class="book-meta">
                    <h4 class="book-title-main">{{ $book->judul }}</h4>
                    <p class="book-author-main">{{ $book->penulis }}</p>

                    <div class="meta-divider"></div>

                    <div class="meta-row">
                        <div class="meta-icon"><i class="fas fa-barcode"></i></div>
                        <div>
                            <div class="meta-label">Kode Buku</div>
                            <div class="meta-value">{{ $book->kode_buku ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="meta-row">
                        <div class="meta-icon"><i class="fas fa-tag"></i></div>
                        <div>
                            <div class="meta-label">Kategori</div>
                            <div class="meta-value">{{ $book->kategori->nama ?? $book->KategoriID ?? 'Umum' }}</div>
                        </div>
                    </div>

                    <div class="meta-row">
                        <div class="meta-icon"><i class="fas fa-building"></i></div>
                        <div>
                            <div class="meta-label">Penerbit</div>
                            <div class="meta-value">{{ $book->penerbit ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="meta-row">
                        <div class="meta-icon"><i class="fas fa-calendar"></i></div>
                        <div>
                            <div class="meta-label">Tahun Terbit</div>
                            <div class="meta-value">{{ $book->tahun ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="meta-row">
                        <div class="meta-icon"><i class="fas fa-layer-group"></i></div>
                        <div>
                            <div class="meta-label">Stok Tersedia</div>
                            <div class="meta-value">{{ $book->stok }} buku</div>
                        </div>
                    </div>

                    @if($book->deskripsi)
                    <div class="meta-row">
                        <div class="meta-icon"><i class="fas fa-align-left"></i></div>
                        <div>
                            <div class="meta-label">Deskripsi</div>
                            <div class="meta-value long">{{ $book->deskripsi }}</div>
                        </div>
                    </div>
                    @endif
                </div>

                @if($book->stok > 0)
                    <div class="stock-status available">
                        <span class="pulse-dot anim"></span>
                        Tersedia untuk dipinjam
                    </div>
                @else
                    <div class="stock-status empty">
                        <span class="pulse-dot"></span>
                        Stok habis
                    </div>
                @endif
            </div>


            <!-- FORM CARD -->
            <div class="card">
                <div class="card-header">
                    <div class="card-header-icon indigo"><i class="fas fa-clipboard-list"></i></div>
                    <span class="card-header-title">Informasi Peminjaman</span>
                </div>

                <div class="form-body">

                    <div class="borrower-box">
                        <div class="borrower-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                        <div>
                            <div class="borrower-label">Peminjam</div>
                            <div class="borrower-name">{{ auth()->user()->name }}</div>
                            <div class="borrower-email">{{ auth()->user()->email }}</div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('user.borrow.confirm', $book) }}">
                        @csrf

                        <div class="field-group">
                            <label class="field-label">
                                <i class="fas fa-calendar-day" style="color:var(--indigo); margin-right:5px;"></i>
                                Tanggal Pinjam
                            </label>
                            <input type="date" name="tanggal_pinjam" value="{{ date('Y-m-d') }}" class="field-input">
                        </div>

                        <div class="field-group">
                            <label class="field-label">
                                <i class="fas fa-calendar-check" style="color:var(--indigo); margin-right:5px;"></i>
                                Tanggal Kembali
                            </label>
                            <input type="date" name="due_date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="field-input">
                        </div>

                        <div class="warning-box">
                            <div class="warning-icon">
                                <i class="fas fa-triangle-exclamation" style="color:var(--amber); font-size:14px;"></i>
                            </div>
                            <div>
                                <div class="warning-title">Perhatian!</div>
                                <ul class="warning-list">
                                    <li>Pastikan mengembalikan buku tepat waktu</li>
                                    <li>Keterlambatan akan dikenakan denda</li>
                                    <li>Jaga kondisi buku dengan baik</li>
                                </ul>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="{{ route('user.books') }}" class="btn-cancel">
                                <i class="fas fa-arrow-left" style="font-size:12px;"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn-confirm">
                                <i class="fas fa-book-reader"></i>
                                Konfirmasi Peminjaman
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div><!-- end .borrow-grid -->


        <!-- ── ULASAN PEMBACA ── -->
        @php
            $ratings     = $book->ratings;
            $totalRatings = $ratings->count();
            $avgRating   = $totalRatings > 0 ? round($ratings->avg('rating'), 1) : 0;
            $avgRounded  = round($avgRating);

            // count per star
            $starCounts = [];
            for ($s = 5; $s >= 1; $s--) {
                $starCounts[$s] = $ratings->where('rating', $s)->count();
            }
        @endphp

        <div class="card reviews-card">
            <div class="card-header">
                <div class="card-header-icon amber"><i class="fas fa-star"></i></div>
                <span class="card-header-title">Ulasan Pembaca</span>
                @if($totalRatings > 0)
                    <span class="card-header-count">{{ $totalRatings }} ulasan</span>
                @endif
            </div>

            @if($totalRatings > 0)

            <!-- Rating Summary -->
            <div class="rating-summary">
                <div class="rating-big">
                    <div class="rating-big-num">{{ $avgRating }}</div>
                    <div class="rating-big-stars">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star{{ $i <= $avgRounded ? '' : '-half-alt' }}"
                               style="{{ $i <= $avgRounded ? 'color:#fbbf24' : ($i == ceil($avgRating) && $avgRating != floor($avgRating) ? 'color:#fbbf24' : 'color:#e2e8f0') }}"></i>
                        @endfor
                    </div>
                    <div class="rating-big-count">dari {{ $totalRatings }} ulasan</div>
                </div>

                <div class="rating-bars">
                    @for($s = 5; $s >= 1; $s--)
                        @php $pct = $totalRatings > 0 ? ($starCounts[$s] / $totalRatings * 100) : 0; @endphp
                        <div class="bar-row">
                            <div class="bar-label">{{ $s }} <i class="fas fa-star" style="font-size:9px; color:#fbbf24;"></i></div>
                            <div class="bar-track">
                                <div class="bar-fill" style="width: {{ $pct }}%;"></div>
                            </div>
                            <div class="bar-count">{{ $starCounts[$s] }}</div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Review List -->
            <div class="reviews-body">
                @foreach($ratings as $idx => $rating)
                <div class="review-item" style="animation-delay: {{ $idx * 60 }}ms">
                    <div class="review-top">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">{{ substr($rating->user->name, 0, 1) }}</div>
                            <div>
                                <div class="reviewer-name">{{ $rating->user->name }}</div>
                                <div class="reviewer-date">
                                    {{ $rating->created_at ? $rating->created_at->format('d M Y') : '' }}
                                </div>
                            </div>
                        </div>
                        <div class="review-stars">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $rating->rating ? '' : 'empty' }}"></i>
                            @endfor
                        </div>
                    </div>
                    @if($rating->ulasan)
                        <p class="review-text">{{ $rating->ulasan }}</p>
                    @endif
                </div>
                @endforeach
            </div>

            @else

            <!-- Empty reviews -->
            <div class="empty-reviews">
                <div class="empty-reviews-icon">
                    <i class="fas fa-star" style="font-size:22px; color:#f59e0b;"></i>
                </div>
                <div class="empty-reviews-title">Belum Ada Ulasan</div>
                <div class="empty-reviews-sub">Jadilah yang pertama memberi ulasan setelah membaca buku ini</div>
            </div>

            @endif
        </div><!-- end reviews-card -->


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


<script>
document.getElementById('ratingForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const form  = e.target;
    const data  = new FormData(form);

    fetch("{{ route('user.rating', $book) }}", {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value },
        body: data
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            document.getElementById('ratingInfo').innerHTML =
                '✓ Ulasan tersimpan — rata-rata ⭐ ' + res.avg + ' (' + res.count + ' ulasan)';
            form.reset();
            location.reload();
        }
    });
});
</script>
</body>
</html>