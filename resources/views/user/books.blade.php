<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Buku | Perpustakaan Digital</title>
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
            display: flex;
            flex-direction: column;
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
            padding: 8px 16px;
            background: #fff; border: 1.5px solid #e2e8f0;
            border-radius: 10px; font-size: 13px; font-weight: 500;
            color: #64748b; cursor: pointer; transition: all 0.2s;
            text-decoration: none; font-family: 'DM Sans', sans-serif;
        }
        .btn-logout:hover { border-color: #fda4af; color: var(--rose); background: #fff1f2; }

        /* ── CONTENT ── */
        .content { padding: 36px; flex: 1; }

        /* ── PAGE HERO ── */
        .page-hero {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 45%, #3730a3 100%);
            border-radius: 20px;
            padding: 30px 36px;
            margin-bottom: 28px;
            display: flex; align-items: center; justify-content: space-between;
            position: relative; overflow: hidden;
            animation: fadeUp 0.4s ease both;
        }

        .page-hero::before {
            content: '';
            position: absolute; top: -50px; right: -50px;
            width: 220px; height: 220px;
            background: radial-gradient(circle, rgba(129,140,248,0.22) 0%, transparent 70%);
            border-radius: 50%;
        }

        .page-hero::after {
            content: '';
            position: absolute; bottom: -30px; left: 25%;
            width: 160px; height: 160px;
            background: radial-gradient(circle, rgba(99,102,241,0.12) 0%, transparent 70%);
            border-radius: 50%;
        }

        .page-hero-label {
            font-size: 11px; font-weight: 600; letter-spacing: 0.1em;
            text-transform: uppercase; color: rgba(199,210,254,0.65);
            margin-bottom: 6px;
        }

        .page-hero-title {
            font-family: 'Sora', sans-serif;
            font-size: 26px; font-weight: 800;
            color: #fff; line-height: 1.15; margin-bottom: 8px;
        }

        .page-hero-sub { font-size: 13.5px; color: rgba(199,210,254,0.6); }

        .page-hero-icon {
            position: relative; z-index: 2;
            width: 72px; height: 72px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            backdrop-filter: blur(10px);
        }

        /* ── SECTION HEADER + DIVIDER ── */
        .section-header { margin-bottom: 20px; }
        .divider { display: flex; align-items: center; gap: 10px; margin-bottom: 4px; }
        .divider-line { flex: 1; height: 1px; background: #e2e8f0; }
        .section-title { font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: #0f172a; white-space: nowrap; }
        .section-sub { font-size: 13px; color: #94a3b8; }

        /* ── BOOK GRID ── */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        /* ── BOOK CARD ── */
        .book-card {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #e8edf4;
            overflow: hidden;
            display: flex; flex-direction: column;
            transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
            animation: fadeUp 0.5s ease both;
        }

        .book-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.09);
            border-color: #c7d2fe;
        }

        /* ── BOOK COVER ── */
        .book-cover {
            height: 180px;
            background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
            display: flex; align-items: center; justify-content: center;
            position: relative; overflow: hidden;
        }

        .book-cover img {
            width: 100%; height: 100%; object-fit: contain;
            transition: transform 0.35s ease;
        }

        .book-card:hover .book-cover img { transform: scale(1.06); }

        .stock-badge {
            position: absolute; top: 12px; right: 12px;
            display: flex; align-items: center; gap: 6px;
            padding: 5px 11px;
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(8px);
            border-radius: 999px;
            font-size: 11px; font-weight: 600;
            border: 1px solid;
        }

        .stock-badge.available { color: var(--emerald); border-color: rgba(5,150,105,0.2); }
        .stock-badge.empty     { color: var(--rose);    border-color: rgba(225,29,72,0.2); }

        .pulse-dot {
            width: 6px; height: 6px; border-radius: 50%;
        }

        .pulse-dot.green { background: var(--emerald); animation: pulse 1.5s infinite; }
        .pulse-dot.red   { background: var(--rose); }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        /* ── BOOK INFO ── */
        .book-info { padding: 20px; flex: 1; display: flex; flex-direction: column; }

        .book-title {
            font-family: 'Sora', sans-serif;
            font-size: 14.5px; font-weight: 700;
            color: #0f172a; margin-bottom: 4px;
            display: -webkit-box; -webkit-line-clamp: 2;
            -webkit-box-orient: vertical; overflow: hidden;
            line-height: 1.35;
        }

        .book-author { font-size: 12.5px; color: #64748b; margin-bottom: 12px; }

        .book-category {
            display: inline-flex; align-items: center;
            background: var(--indigo-xl); color: var(--indigo);
            padding: 3px 10px; border-radius: 999px;
            font-size: 11px; font-weight: 600;
            margin-bottom: 12px; width: fit-content;
        }

        .rating-row { display: flex; align-items: center; gap: 7px; margin-bottom: 18px; }
        .stars { display: flex; gap: 2px; }
        .stars i { font-size: 11px; }
        .rating-avg { font-size: 12px; font-weight: 700; color: #374151; }
        .rating-count { font-size: 11.5px; color: #94a3b8; }

        /* ── BUTTONS ── */
        .btn-primary {
            display: flex; align-items: center; justify-content: center; gap: 7px;
            width: 100%; padding: 11px 16px;
            background: linear-gradient(135deg, var(--indigo), var(--indigo-l));
            color: #fff; border: none;
            border-radius: 10px; font-size: 13px; font-weight: 600;
            cursor: pointer; text-decoration: none;
            transition: all 0.22s ease;
            box-shadow: 0 3px 10px rgba(79,70,229,0.3);
            font-family: 'DM Sans', sans-serif;
        }
        .btn-primary:hover { box-shadow: 0 6px 18px rgba(79,70,229,0.4); transform: translateY(-1px); }

        .btn-danger {
            display: flex; align-items: center; justify-content: center; gap: 7px;
            width: 100%; padding: 11px 16px;
            background: linear-gradient(135deg, var(--rose), #fb7185);
            color: #fff; border: none;
            border-radius: 10px; font-size: 13px; font-weight: 600;
            cursor: pointer; text-decoration: none;
            transition: all 0.22s ease;
            box-shadow: 0 3px 10px rgba(225,29,72,0.25);
            font-family: 'DM Sans', sans-serif;
        }
        .btn-danger:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(225,29,72,0.35); }

        .btn-warning {
            display: flex; align-items: center; justify-content: center; gap: 7px;
            width: 100%; padding: 11px 16px;
            background: #fffbeb; color: #b45309;
            border: 1.5px solid #fde68a;
            border-radius: 10px; font-size: 13px; font-weight: 600;
            cursor: not-allowed; font-family: 'DM Sans', sans-serif;
        }

        .btn-disabled {
            display: flex; align-items: center; justify-content: center; gap: 7px;
            width: 100%; padding: 11px 16px;
            background: #f8fafc; color: #94a3b8;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px; font-size: 13px; font-weight: 600;
            cursor: not-allowed; font-family: 'DM Sans', sans-serif;
        }

        /* ── SECONDARY ACTIONS ── */
        .secondary-actions { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 10px; }

        .btn-fav {
            display: flex; align-items: center; justify-content: center; gap: 6px;
            padding: 9px 12px;
            border-radius: 10px;
            font-size: 12.5px; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
            border: 1.5px solid #e2e8f0;
            background: #fff; color: #64748b;
            font-family: 'DM Sans', sans-serif;
        }
        .btn-fav:hover { border-color: #fda4af; background: #fff1f2; color: var(--rose); }
        .btn-fav.active { border-color: #fda4af; background: #fff1f2; color: var(--rose); }

        .btn-rate {
            display: flex; align-items: center; justify-content: center; gap: 6px;
            padding: 9px 12px;
            border-radius: 10px;
            font-size: 12.5px; font-weight: 600;
            cursor: pointer; transition: all 0.2s;
            border: 1.5px solid #e2e8f0;
            background: #fff; color: #64748b;
            font-family: 'DM Sans', sans-serif;
        }
        .btn-rate:hover { border-color: #fcd34d; background: #fffbeb; color: var(--amber); }

        .btn-rate-disabled {
            display: flex; align-items: center; justify-content: center; gap: 6px;
            padding: 9px 12px;
            border-radius: 10px;
            font-size: 12.5px; font-weight: 600;
            cursor: not-allowed;
            border: 1.5px solid #e2e8f0;
            background: #f8fafc; color: #cbd5e1;
            font-family: 'DM Sans', sans-serif;
        }

        /* ── RATING DROPDOWN ── */
        .rating-dropdown {
            position: absolute; bottom: calc(100% + 8px); left: 0; right: 0;
            background: #fff;
            border-radius: 14px;
            border: 1.5px solid #e2e8f0;
            box-shadow: 0 16px 40px rgba(0,0,0,0.12);
            padding: 18px;
            z-index: 50;
        }

        .rating-dropdown-title {
            font-family: 'Sora', sans-serif;
            font-size: 12px; font-weight: 700;
            color: #374151; text-align: center; margin-bottom: 12px;
        }

        .star-row { display: flex; justify-content: center; gap: 8px; margin-bottom: 12px; }
        .star-row i { font-size: 26px; cursor: pointer; transition: transform 0.15s ease, color 0.15s ease; }
        .star-row i:hover { transform: scale(1.2); }

        .rating-textarea {
            width: 100%;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            padding: 9px 12px;
            font-size: 12.5px;
            font-family: 'DM Sans', sans-serif;
            resize: none; margin-bottom: 10px; outline: none;
            transition: border-color 0.2s;
        }
        .rating-textarea:focus { border-color: var(--indigo); }

        .btn-submit-rate {
            width: 100%; padding: 9px;
            background: linear-gradient(135deg, var(--indigo), var(--indigo-l));
            color: #fff; border: none; border-radius: 8px;
            font-size: 12.5px; font-weight: 600;
            cursor: pointer; transition: opacity 0.2s;
            font-family: 'DM Sans', sans-serif;
        }
        .btn-submit-rate:hover { opacity: 0.9; }

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
        @media (max-width: 1100px) { .books-grid { grid-template-columns: 1fr 1fr; } }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-wrap { margin-left: 0; }
            .content { padding: 20px; }
            .books-grid { grid-template-columns: 1fr; }
            .page-hero-icon { display: none; }
            .topbar { padding: 0 20px; }
        }
    </style>
</head>
<body>

<!-- ═══════════════════════════════════════════
     SIDEBAR
════════════════════════════════════════════ -->
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


<!-- ═══════════════════════════════════════════
     MAIN
════════════════════════════════════════════ -->
<div class="main-wrap">

    <!-- TOP BAR -->
    <header class="topbar">
        <div class="breadcrumb">
            <i class="fas fa-house-chimney" style="font-size:12px;"></i>
            <span>›</span>
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
            <span>›</span>
            <span class="current">Katalog Buku</span>
        </div>
    </header>


    <!-- CONTENT -->
    <main class="content">

        <!-- PAGE HERO -->
        <div class="page-hero">
            <div style="position:relative; z-index:2;">
                <p class="page-hero-label">Perpustakaan Digital</p>
                <h2 class="page-hero-title">Katalog Buku</h2>
                <p class="page-hero-sub">Telusuri dan pinjam buku dari koleksi perpustakaan kami</p>
            </div>
            <div class="page-hero-icon">
                <i class="fas fa-book-open" style="font-size:30px; color:rgba(199,210,254,0.8);"></i>
            </div>
        </div>


        <!-- SECTION HEADER -->
        <div class="section-header">
            <div class="divider">
                <div class="section-title">Semua Koleksi</div>
                <div class="divider-line"></div>
                <span style="font-size:12px; color:#94a3b8; white-space:nowrap; font-weight:500;">{{ count($books) }} buku</span>
            </div>
            <p class="section-sub">Pilih buku yang ingin Anda pinjam</p>
        </div>


        <!-- BOOK GRID -->
        <div class="books-grid">

            @foreach($books as $index => $book)
            <div class="book-card" style="animation-delay: {{ min($index * 55, 400) }}ms">

                <!-- Cover -->
                <div class="book-cover">
                    @if($book->image)
                        <img src="{{ asset('storage/'.$book->image) }}" alt="{{ $book->judul }}">
                    @else
                        <i class="fas fa-book-open" style="font-size:52px; color:#c7d2fe;"></i>
                    @endif

                    @if($book->stok > 0)
                        <div class="stock-badge available">
                            <span class="pulse-dot green"></span>
                            Tersedia
                        </div>
                    @else
                        <div class="stock-badge empty">
                            <span class="pulse-dot red"></span>
                            Habis
                        </div>
                    @endif
                </div>

                <!-- Info -->
                <div class="book-info">
                    <h3 class="book-title">{{ $book->judul }}</h3>
                    <p class="book-author">{{ $book->penulis }}</p>

                    <span class="book-category">{{ $book->kategori->nama ?? 'Umum' }}</span>

                    <!-- Rating -->
                    <div class="rating-row">
                        <div class="stars">
                            @php $avg = round($book->averageRating()); @endphp
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $avg ? 'text-amber-400' : 'text-gray-200' }}"></i>
                            @endfor
                        </div>
                        <span class="rating-avg">{{ number_format($book->averageRating(), 1) }}</span>
                        <span class="rating-count">({{ $book->ratingCount() }})</span>
                    </div>

                    <!-- Spacer -->
                    <div style="flex:1;"></div>

                    <!-- Primary Action -->
                    @if ($activeBorrowing)
                        @if ($activeBorrowing->book_id === $book->id)
                            @if ($activeBorrowing->status === 'pending')
                                <div class="btn-warning">
                                    <i class="fas fa-hourglass-half"></i>
                                    Menunggu Persetujuan
                                </div>
                            @elseif ($activeBorrowing->status === 'rejected')
                                <a href="{{ route('user.borrow.create', $book) }}" class="btn-primary">
                                    <i class="fas fa-book-reader"></i>
                                    Pinjam Buku Lagi
                                </a>
                            @elseif (in_array($activeBorrowing->status, ['approved', 'dipinjam']))
                                <a href="{{ route('user.borrow.return.page', $activeBorrowing->id) }}" class="btn-danger">
                                    <i class="fas fa-undo"></i>
                                    Kembalikan Buku
                                </a>
                            @endif
                        @else
                            <div class="btn-disabled" title="Selesaikan peminjaman sebelumnya">
                                <i class="fas fa-lock"></i>
                                Pinjam Buku
                            </div>
                        @endif
                    @else
                        @if ($book->stok > 0)
                            <a href="{{ route('user.borrow.create', $book) }}" class="btn-primary">
                                <i class="fas fa-book-reader"></i>
                                Pinjam Buku
                            </a>
                        @else
                            <div class="btn-disabled">
                                <i class="fas fa-ban"></i>
                                Stok Habis
                            </div>
                        @endif
                    @endif

                    <!-- Secondary: Favorite + Rating -->
                    <div class="secondary-actions">

                        @php
                            $isFavorite = \App\Models\Favorite::where('book_id', $book->id)
                                ->where('user_id', auth()->id())
                                ->exists();
                        @endphp

                        <form method="POST"
                            action="{{ $isFavorite ? route('user.favorite.destroy', $book) : route('user.favorite.store', $book) }}"
                            onsubmit="handleFavorite(this)"
                            data-favorited="{{ $isFavorite ? '1' : '0' }}">
                            @csrf
                            @if($isFavorite) @method('DELETE') @endif
                            <button type="submit"
                                class="btn-fav favorite-btn w-full {{ $isFavorite ? 'active' : '' }}"
                                style="width:100%;">
                                <i class="{{ $isFavorite ? 'fas fa-heart' : 'far fa-heart' }}"></i>
                                {{ $isFavorite ? 'Batal' : 'Favorit' }}
                            </button>
                        </form>

                        @php
                            $hasRated = \App\Models\Rating::where('book_id', $book->id)
                                ->where('user_id', auth()->id())
                                ->exists();

                            $hasReturned = \App\Models\Borrowing::where('book_id', $book->id)
                                ->where('user_id', auth()->id())
                                ->where('status', 'returned')
                                ->exists();
                        @endphp

                        <div class="relative" style="position:relative;">

                            @if(!$hasReturned)
                                <div class="btn-rate-disabled" style="width:100%;">
                                    <i class="fas fa-lock"></i>
                                    Rating
                                </div>

                            @elseif($hasRated)
                                <div class="btn-rate-disabled" style="width:100%;">
                                    <i class="fas fa-star" style="color:#fbbf24;"></i>
                                    Rated
                                </div>

                            @else
                                <button onclick="toggleRating(event, {{ $book->id }})"
                                    id="rating-btn-{{ $book->id }}"
                                    class="btn-rate"
                                    style="width:100%;">
                                    <i class="far fa-star" style="color:#f59e0b;"></i>
                                    Rating
                                </button>

                                <!-- Dropdown -->
                                <div id="rating-{{ $book->id }}" class="rating-dropdown hidden">
                                    <p class="rating-dropdown-title">Beri Rating & Ulasan</p>

                                    <div class="star-row">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-gray-200"
                                                id="star-{{ $book->id }}-{{ $i }}"
                                                onmouseover="hoverStars({{ $book->id }}, {{ $i }})"
                                                onmouseout="resetStars({{ $book->id }})"
                                                onclick="selectRating({{ $book->id }}, {{ $i }})">
                                            </i>
                                        @endfor
                                    </div>

                                    <textarea
                                        id="review-{{ $book->id }}"
                                        class="rating-textarea"
                                        rows="3"
                                        placeholder="Tulis pengalaman membaca buku ini..."></textarea>

                                    <button onclick="submitRatingWithReview({{ $book->id }})" class="btn-submit-rate">
                                        <i class="fas fa-paper-plane" style="margin-right:5px;"></i>
                                        Kirim Ulasan
                                    </button>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

            </div>
            @endforeach

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


<script>
/* ── RATING DROPDOWN ── */
function toggleRating(e, bookId) {
    e.preventDefault();
    e.stopPropagation();
    const dropdown = document.getElementById('rating-' + bookId);
    document.querySelectorAll('[id^="rating-"]:not([id^="rating-btn"])').forEach(el => {
        if (el !== dropdown) el.classList.add('hidden');
    });
    dropdown.classList.toggle('hidden');
}

function hoverStars(bookId, rating) {
    for (let i = 1; i <= 5; i++) {
        const star = document.getElementById(`star-${bookId}-${i}`);
        star.style.color = i <= rating ? '#f59e0b' : '#e5e7eb';
    }
}

function resetStars(bookId) {
    const selected = selectedRatings[bookId] || 0;
    for (let i = 1; i <= 5; i++) {
        const star = document.getElementById(`star-${bookId}-${i}`);
        star.style.color = i <= selected ? '#f59e0b' : '#e5e7eb';
    }
}

let selectedRatings = {};

function selectRating(bookId, rating) {
    selectedRatings[bookId] = rating;
    resetStars(bookId);
}

function submitRatingWithReview(bookId) {
    const rating = selectedRatings[bookId];
    const ulasan = document.getElementById(`review-${bookId}`).value;

    if (!rating) {
        alert('Pilih bintang rating terlebih dahulu.');
        return;
    }

    fetch(`/user/rating/${bookId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ rating, ulasan })
    })
    .then(res => res.json())
    .then(data => { if (data.success) location.reload(); });
}

/* ── CLOSE DROPDOWN ON OUTSIDE CLICK ── */
document.addEventListener('click', function(e) {
    if (!e.target.closest('[onclick^="toggleRating"]') && !e.target.closest('[id^="rating-"]')) {
        document.querySelectorAll('[id^="rating-"]:not([id^="rating-btn"])').forEach(el => el.classList.add('hidden'));
    }
});

/* ── FAVORITE OPTIMISTIC UI ── */
function handleFavorite(form) {
    const btn  = form.querySelector('button');
    const icon = btn.querySelector('i');
    const isFav = form.dataset.favorited === '1';

    if (!isFav) {
        btn.classList.add('active');
        icon.className = 'fas fa-heart';
        btn.childNodes[btn.childNodes.length - 1].textContent = ' Batal';
    } else {
        btn.classList.remove('active');
        icon.className = 'far fa-heart';
        btn.childNodes[btn.childNodes.length - 1].textContent = ' Favorit';
    }
}
</script>
</body>
</html>