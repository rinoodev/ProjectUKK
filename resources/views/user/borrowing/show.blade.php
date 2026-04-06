<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Peminjaman | Perpustakaan Digital</title>
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
            --amber:    #d97706;
            --amber-l:  #fef3c7;
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
            font-weight: 700; color: #fff; font-size: 13px;
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
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 36px;
            position: sticky; top: 0; z-index: 30;
        }

        .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #94a3b8; }
        .breadcrumb .current { color: #1e293b; font-weight: 600; }

        .btn-back {
            display: flex; align-items: center; gap: 7px;
            padding: 8px 16px;
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13px; font-weight: 500; color: #64748b;
            cursor: pointer; transition: all 0.2s;
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
        }
        .btn-back:hover { border-color: #a5b4fc; color: var(--indigo); background: var(--indigo-xl); }

        /* ── CONTENT ── */
        .content { padding: 36px; flex: 1; }

        /* ── PAGE HERO ── */
        .page-hero {
            background: linear-gradient(135deg, #064e3b 0%, #059669 45%, #10b981 100%);
            border-radius: 20px;
            padding: 30px 36px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            display: flex; align-items: center; justify-content: space-between;
            animation: fadeUp 0.4s ease both;
        }

        .page-hero::before {
            content: '';
            position: absolute; top: -60px; right: -60px;
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(129,140,248,0.25) 0%, transparent 70%);
            border-radius: 50%;
        }

        .page-hero::after {
            content: '';
            position: absolute; bottom: -40px; left: 30%;
            width: 180px; height: 180px;
            background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(165,180,252,0.15);
            border: 1px solid rgba(165,180,252,0.25);
            padding: 5px 12px; border-radius: 999px;
            font-size: 11.5px; font-weight: 500; color: #a5b4fc;
            margin-bottom: 12px;
        }

        .hero-title {
            font-family: 'Sora', sans-serif;
            font-size: 26px; font-weight: 800; color: #fff;
            line-height: 1.15; margin-bottom: 6px;
        }

        .hero-sub { font-size: 13.5px; color: rgba(199,210,254,0.65); }

        .hero-icon-wrap {
            position: relative; z-index: 2;
            width: 80px; height: 80px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            backdrop-filter: blur(10px);
        }

        /* ── LAYOUT GRID ── */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 20px;
            align-items: start;
        }

        /* ── MAIN CARD ── */
        .main-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e8edf4;
            overflow: hidden;
            animation: fadeUp 0.5s ease both;
            animation-delay: 0.08s;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex; align-items: center; justify-content: space-between;
        }

        .card-title {
            font-family: 'Sora', sans-serif;
            font-size: 15px; font-weight: 700; color: #0f172a;
        }

        .card-body { padding: 24px; }

        /* ── BOOK SHOWCASE ── */
        .book-showcase {
            display: flex; align-items: flex-start; gap: 20px;
            padding: 20px;
            background: linear-gradient(135deg, #fafbff, var(--indigo-xl));
            border-radius: 14px;
            border: 1px solid #e0e7ff;
            margin-bottom: 24px;
        }

        .book-cover {
            width: 72px; height: 96px;
            background: linear-gradient(135deg, var(--indigo), var(--indigo-l));
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(79,70,229,0.3);
            position: relative;
        }

        .book-cover::after {
            content: '';
            position: absolute; left: 6px; top: 4px; bottom: 4px;
            width: 4px;
            background: rgba(255,255,255,0.2);
            border-radius: 2px;
        }

        .book-meta { flex: 1; min-width: 0; }
        .book-title {
            font-family: 'Sora', sans-serif;
            font-size: 17px; font-weight: 800; color: #0f172a;
            margin-bottom: 6px; line-height: 1.3;
        }
        .book-id { font-size: 12px; color: #94a3b8; }

        /* ── INFO ROWS ── */
        .info-row {
            display: flex; align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #f8fafc;
            gap: 16px;
        }
        .info-row:last-child { border-bottom: none; padding-bottom: 0; }

        .info-icon {
            width: 36px; height: 36px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-size: 14px;
        }

        .info-icon.indigo  { background: var(--indigo-xl); color: var(--indigo); }
        .info-icon.emerald { background: var(--emerald-l); color: var(--emerald); }
        .info-icon.amber   { background: var(--amber-l);  color: var(--amber); }
        .info-icon.rose    { background: var(--rose-l);   color: var(--rose); }

        .info-label {
            font-size: 11.5px; font-weight: 600;
            color: #94a3b8; text-transform: uppercase;
            letter-spacing: 0.07em; margin-bottom: 2px;
        }

        .info-value {
            font-size: 14px; font-weight: 600; color: #1e293b;
        }

        /* ── SIDE CARD ── */
        .side-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e8edf4;
            overflow: hidden;
            animation: fadeUp 0.5s ease both;
            animation-delay: 0.15s;
        }

        /* ── STATUS DISPLAY ── */
        .status-display {
            padding: 28px 24px;
            text-align: center;
            border-bottom: 1px solid #f1f5f9;
        }

        .status-ring {
            width: 80px; height: 80px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            font-size: 28px;
            position: relative;
        }

        .status-ring.pending  { background: var(--amber-l);  color: var(--amber); box-shadow: 0 0 0 6px rgba(217,119,6,0.1); }
        .status-ring.approved { background: var(--indigo-xl); color: var(--indigo); box-shadow: 0 0 0 6px rgba(79,70,229,0.1); }
        .status-ring.returned { background: var(--emerald-l); color: var(--emerald); box-shadow: 0 0 0 6px rgba(5,150,105,0.1); }
        .status-ring.rejected { background: var(--rose-l);   color: var(--rose); box-shadow: 0 0 0 6px rgba(225,29,72,0.1); }

        .status-label {
            font-family: 'Sora', sans-serif;
            font-size: 16px; font-weight: 800; color: #0f172a; margin-bottom: 6px;
        }

        .status-desc { font-size: 12.5px; color: #94a3b8; line-height: 1.5; }

        /* badges */
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 12px; border-radius: 999px;
            font-size: 12px; font-weight: 600;
        }
        .badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }
        .badge-pending  { background: var(--amber-l);  color: var(--amber); }
        .badge-pending::before  { background: var(--amber); }
        .badge-approved { background: var(--indigo-xl); color: var(--indigo); }
        .badge-approved::before { background: var(--indigo); }
        .badge-returned { background: var(--emerald-l); color: var(--emerald); }
        .badge-returned::before { background: var(--emerald); }
        .badge-rejected { background: var(--rose-l);   color: var(--rose); }
        .badge-rejected::before { background: var(--rose); }

        /* ── TIMELINE ── */
        .timeline { padding: 20px 24px; }
        .tl-title {
            font-family: 'Sora', sans-serif;
            font-size: 12px; font-weight: 700; color: #94a3b8;
            text-transform: uppercase; letter-spacing: 0.08em;
            margin-bottom: 16px;
        }

        .tl-item {
            display: flex; gap: 12px;
            position: relative; padding-bottom: 16px;
        }

        .tl-item:last-child { padding-bottom: 0; }

        .tl-item:not(:last-child)::before {
            content: '';
            position: absolute; left: 11px; top: 24px; bottom: 0;
            width: 1.5px; background: #e2e8f0;
        }

        .tl-dot {
            width: 24px; height: 24px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; font-size: 9px; margin-top: 1px;
        }

        .tl-dot.done   { background: var(--emerald-l); color: var(--emerald); }
        .tl-dot.active { background: var(--indigo-xl); color: var(--indigo); }
        .tl-dot.wait   { background: #f1f5f9; color: #cbd5e1; border: 1.5px dashed #e2e8f0; }

        .tl-event { font-size: 13px; font-weight: 600; color: #334155; margin-bottom: 2px; }
        .tl-date  { font-size: 11.5px; color: #94a3b8; }

        /* ── BACK BTN INSIDE CARD ── */
        .btn-back-main {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            padding: 11px 20px;
            background: var(--indigo-xl);
            color: var(--indigo);
            border-radius: 10px;
            font-size: 13.5px; font-weight: 600;
            text-decoration: none; width: 100%;
            border: 1.5px solid #c7d2fe;
            transition: all 0.2s;
            margin: 0 24px 24px;
            width: calc(100% - 48px);
        }

        .btn-back-main:hover { background: var(--indigo); color: #fff; border-color: var(--indigo); }

        /* ── DIVIDER ── */
        .divider { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .divider-line { flex: 1; height: 1px; background: #e2e8f0; }
        .section-title { font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: #0f172a; white-space: nowrap; }
        .section-sub   { font-size: 13px; color: #94a3b8; margin-bottom: 20px; }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid #e2e8f0;
            margin-top: auto;
            padding: 22px 36px;
            display: flex; align-items: center; justify-content: space-between;
        }

        footer .foot-brand {
            display: flex; align-items: center; gap: 10px;
            font-family: 'Sora', sans-serif; font-weight: 700; font-size: 14px; color: #0f172a;
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .page-hero { animation: fadeUp 0.4s ease both; }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) {
            .detail-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-wrap { margin-left: 0; }
            .content { padding: 20px; }
            .hero-icon-wrap { display: none; }
            .hero-title { font-size: 20px; }
            .topbar { padding: 0 20px; }
        }
    </style>
</head>
<body>

<!-- ═══════════════════════════════════════════════
     SIDEBAR
════════════════════════════════════════════════ -->
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

        <a href="{{ route('user.borrowing.index') }}" class="nav-item active">
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


<!-- ═══════════════════════════════════════════════
     MAIN WRAPPER
════════════════════════════════════════════════ -->
<div class="main-wrap">

    <!-- TOP BAR -->
    <header class="topbar">
        <div class="breadcrumb">
            <i class="fas fa-house-chimney" style="font-size:12px;"></i>
            <span>›</span>
            <span>Dashboard</span>
            <span>›</span>
            <a href="{{ route('user.borrowing.index') }}" style="color:#94a3b8; text-decoration:none; transition:color 0.2s;" onmouseover="this.style.color='#4f46e5'" onmouseout="this.style.color='#94a3b8'">Riwayat Peminjaman</a>
            <span>›</span>
            <span class="current">Detail</span>
        </div>
        <a href="{{ route('user.borrowing.index') }}" class="btn-back">
            <i class="fas fa-arrow-left" style="font-size:11px;"></i>
            Kembali ke Riwayat
        </a>
    </header>


    <!-- CONTENT -->
    <main class="content">

        <!-- PAGE HERO -->
        <div class="page-hero">
            <div style="position:relative; z-index:2;">
                <div class="hero-badge">
                    <i class="fas fa-file-lines" style="font-size:10px;"></i>
                    Informasi Transaksi
                </div>
                <h2 class="hero-title">Detail Peminjaman</h2>
                <p class="hero-sub">Informasi lengkap mengenai transaksi peminjaman buku Anda.</p>
            </div>
            <div class="hero-icon-wrap">
                <i class="fas fa-file-lines" style="font-size:34px; color:rgba(199,210,254,0.85);"></i>
            </div>
        </div>


        <!-- SECTION HEADER -->
        <div>
            <div class="divider">
                <div class="section-title">Informasi Peminjaman</div>
                <div class="divider-line"></div>
            </div>
            <p class="section-sub">Data lengkap transaksi peminjaman buku</p>
        </div>


        <!-- DETAIL GRID -->
        <div class="detail-grid">

            <!-- LEFT: MAIN INFO -->
            <div class="main-card">
                <div class="card-header">
                    <span class="card-title">Data Buku & Transaksi</span>
                    @if($borrowing->status === 'pending')
                        <span class="badge badge-pending">Pending</span>
                    @elseif($borrowing->status === 'approved')
                        <span class="badge badge-approved">Disetujui</span>
                    @elseif($borrowing->status === 'returned')
                        <span class="badge badge-returned">Dikembalikan</span>
                    @else
                        <span class="badge badge-rejected">Ditolak</span>
                    @endif
                </div>

                <div class="card-body">

                    <!-- Book Showcase -->
                    <div class="book-showcase">
                        <div class="book-cover">
                            <i class="fas fa-book-open" style="color:rgba(255,255,255,0.85); font-size:22px;"></i>
                        </div>
                        <div class="book-meta">
                            <div class="book-title">{{ $borrowing->book->judul ?? $borrowing->book->title ?? '-' }}</div>
                            <div class="book-id">
                                <i class="fas fa-hashtag" style="font-size:10px;"></i>
                                ID Transaksi: #{{ str_pad($borrowing->id, 5, '0', STR_PAD_LEFT) }}
                            </div>
                        </div>
                    </div>

                    <!-- Info Rows -->
                    <div class="info-row">
                        <div class="info-icon indigo">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div>
                            <div class="info-label">Tanggal Pinjam</div>
                            <div class="info-value">
                                {{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam)->translatedFormat('d F Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-icon amber">
                            <i class="fas fa-calendar-xmark"></i>
                        </div>
                        <div>
                            <div class="info-label">Pengembalian</div>
                            <div class="info-value">
                                @if($borrowing->returned_at)
                                    {{ \Carbon\Carbon::parse($borrowing->returned_at)->translatedFormat('d F Y') }}
                                    @php $daysLeft = \Carbon\Carbon::now()->diffInDays($borrowing->due_date, false); @endphp
                                    @if($borrowing->status === 'approved')
                                        @if($daysLeft < 0)
                                            <span style="font-size:11.5px; color:var(--rose); margin-left:8px;">
                                                <i class="fas fa-circle-exclamation"></i> Terlambat {{ abs($daysLeft) }} hari
                                            </span>
                                        @elseif($daysLeft <= 3)
                                            <span style="font-size:11.5px; color:var(--amber); margin-left:8px;">
                                                <i class="fas fa-triangle-exclamation"></i> {{ $daysLeft }} hari lagi
                                            </span>
                                        @endif
                                    @endif
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-icon emerald">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div>
                            <div class="info-label">Tanggal Dikembalikan</div>
                            <div class="info-value">
                                @if($borrowing->returned_at)
                                    {{ \Carbon\Carbon::parse($borrowing->returned_at)->translatedFormat('d F Y') }}
                                @else
                                    <span style="color:#94a3b8; font-style:italic; font-weight:400;">Belum dikembalikan</span>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <!-- RIGHT: STATUS + TIMELINE -->
            <div style="display:flex; flex-direction:column; gap:16px;">

                <!-- Status Card -->
                <div class="side-card">
                    <div class="status-display">
                        @if($borrowing->status === 'pending')
                            <div class="status-ring pending">
                                <i class="fas fa-hourglass-half"></i>
                            </div>
                            <div class="status-label">Menunggu Persetujuan</div>
                            <div class="status-desc">Permintaan peminjaman Anda sedang menunggu konfirmasi dari pustakawan.</div>
                        @elseif($borrowing->status === 'approved')
                            <div class="status-ring approved">
                                <i class="fas fa-book-open-reader"></i>
                            </div>
                            <div class="status-label">Sedang Dipinjam</div>
                            <div class="status-desc">Buku sedang dalam peminjaman Anda. Harap kembalikan tepat waktu.</div>
                        @elseif($borrowing->status === 'returned')
                            <div class="status-ring returned">
                                <i class="fas fa-circle-check"></i>
                            </div>
                            <div class="status-label">Selesai</div>
                            <div class="status-desc">Buku telah berhasil dikembalikan. Terima kasih!</div>
                        @else
                            <div class="status-ring rejected">
                                <i class="fas fa-circle-xmark"></i>
                            </div>
                            <div class="status-label">Ditolak</div>
                            <div class="status-desc">Permintaan peminjaman Anda tidak dapat diproses.</div>
                        @endif
                    </div>

                    <!-- Timeline -->
                    <div class="timeline">
                        <div class="tl-title">Alur Status</div>

                        <div class="tl-item">
                            <div class="tl-dot done"><i class="fas fa-check"></i></div>
                            <div>
                                <div class="tl-event">Pengajuan Dikirim</div>
                                <div class="tl-date">{{ $borrowing->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>

                        <div class="tl-item">
                            @if(in_array($borrowing->status, ['approved','returned']))
                                <div class="tl-dot done"><i class="fas fa-check"></i></div>
                            @elseif($borrowing->status === 'rejected')
                                <div class="tl-dot" style="background:var(--rose-l); color:var(--rose);"><i class="fas fa-xmark"></i></div>
                            @else
                                <div class="tl-dot active"><i class="fas fa-ellipsis"></i></div>
                            @endif
                            <div>
                                <div class="tl-event">
                                    @if($borrowing->status === 'rejected') Ditolak
                                    @elseif($borrowing->status === 'pending') Menunggu Persetujuan
                                    @else Disetujui
                                    @endif
                                </div>
                                <div class="tl-date">
                                    @if($borrowing->status === 'pending') Sedang diproses...
                                    @else {{ $borrowing->updated_at->format('d M Y, H:i') }}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="tl-item">
                            @if($borrowing->status === 'returned')
                                <div class="tl-dot done"><i class="fas fa-check"></i></div>
                            @else
                                <div class="tl-dot wait"><i class="fas fa-clock"></i></div>
                            @endif
                            <div>
                                <div class="tl-event">Buku Dikembalikan</div>
                                <div class="tl-date">
                                    @if($borrowing->returned_at)
                                        {{ \Carbon\Carbon::parse($borrowing->returned_at)->format('d M Y, H:i') }}
                                    @else
                                        Menunggu pengembalian
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>

                    <a href="{{ route('user.borrowing.index') }}" class="btn-back-main">
                        <i class="fas fa-arrow-left" style="font-size:11px;"></i>
                        Kembali ke Riwayat
                    </a>
                </div>

            </div>
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