<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman | Perpustakaan Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
            font-weight: 700;
            color: #fff;
            font-size: 13px;
            font-family: 'Sora', sans-serif;
            flex-shrink: 0;
        }
 
        .main-wrap {
            margin-left: 260px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
 
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
 
        .btn-back {
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
        .btn-back:hover { border-color: #a5b4fc; color: var(--indigo); background: var(--indigo-xl); }
 
        .content { padding: 36px; flex: 1; }
 
        .page-hero {
            background: linear-gradient(135deg, #064e3b 0%, #059669 45%, #10b981 100%);
            border-radius: 20px;
            padding: 30px 36px;
            margin-bottom: 28px;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: fadeUp 0.4s ease both;
        }
 
        .page-hero::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 260px; height: 260px;
            background: radial-gradient(circle, rgba(129,140,248,0.25) 0%, transparent 70%);
            border-radius: 50%;
        }
 
        .page-hero::after {
            content: '';
            position: absolute;
            bottom: -40px; left: 30%;
            width: 180px; height: 180px;
            background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }
 
        .hero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            background: rgba(165,180,252,0.15);
            border: 1px solid rgba(165,180,252,0.25);
            padding: 5px 12px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 500;
            color: #a5b4fc;
            margin-bottom: 12px;
        }
 
        .hero-title {
            font-family: 'Sora', sans-serif;
            font-size: 26px;
            font-weight: 800;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 6px;
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
 
        .filter-bar {
            background: #fff;
            border-radius: 14px;
            padding: 16px 20px;
            border: 1px solid #e8edf4;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            animation: fadeUp 0.45s ease both;
        }
 
        .filter-label {
            font-size: 12px;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.07em;
        }
 
        .filter-btn {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 500;
            border: 1.5px solid #e2e8f0;
            background: #fff;
            color: #64748b;
            cursor: pointer;
            transition: all 0.2s;
        }
 
        .filter-btn:hover,
        .filter-btn.active-filter { background: var(--indigo-xl); border-color: #a5b4fc; color: var(--indigo); }
 
        .filter-btn.status-pending.active-filter   { background: var(--amber-l);  border-color: #fcd34d; color: var(--amber); }
        .filter-btn.status-approved.active-filter  { background: var(--emerald-l); border-color: #6ee7b7; color: var(--emerald); }
        .filter-btn.status-returned.active-filter  { background: var(--indigo-xl); border-color: #a5b4fc; color: var(--indigo); }
        .filter-btn.status-rejected.active-filter  { background: var(--rose-l);    border-color: #fda4af; color: var(--rose); }
 
        .filter-divider { width: 1px; height: 20px; background: #e2e8f0; }
 
        /* ─── TOMBOL EXPORT BULANAN ─── */
        .btn-export-monthly {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            font-family: 'DM Sans', sans-serif;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(79,70,229,0.35);
            position: relative;
            overflow: hidden;
            white-space: nowrap;
        }
 
        .btn-export-monthly::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent);
            opacity: 0;
            transition: opacity 0.2s;
        }
 
        .btn-export-monthly:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(79,70,229,0.45);
        }
        .btn-export-monthly:hover::before { opacity: 1; }
 
        .btn-export-monthly:active { transform: translateY(0); }
 
        .btn-export-monthly .export-badge {
            background: rgba(255,255,255,0.22);
            border-radius: 5px;
            padding: 1px 7px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.04em;
        }
 
        /* spinner */
        .export-spin { display: none; animation: spin 0.7s linear infinite; }
        @keyframes spin { to { transform: rotate(360deg); } }
 
        .table-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e8edf4;
            overflow: hidden;
            animation: fadeUp 0.5s ease both;
        }
 
        .table-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }
 
        .table-header-left { display: flex; align-items: center; gap: 12px; }
 
        .table-title {
            font-family: 'Sora', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
        }
 
        .table-count {
            font-size: 12px;
            color: #94a3b8;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 3px 10px;
            font-weight: 500;
        }
 
        table { width: 100%; border-collapse: collapse; font-size: 13.5px; }
 
        thead th {
            background: #f8fafc;
            padding: 12px 16px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94a3b8;
            border-bottom: 1px solid #f1f5f9;
            white-space: nowrap;
        }
 
        tbody tr { border-bottom: 1px solid #f8fafc; transition: background 0.15s ease; }
        tbody tr:hover { background: #fafbff; }
        tbody tr:last-child { border-bottom: none; }
 
        tbody td { padding: 14px 16px; color: #334155; vertical-align: middle; }
 
        .no-col { color: #94a3b8; font-weight: 600; font-size: 12px; }
 
        .user-cell { display: flex; align-items: center; gap: 10px; }
        .user-name  { font-weight: 600; color: #0f172a; }
        .book-name  { font-weight: 600; color: #1e293b; }
 
        .date-cell { display: flex; align-items: center; gap: 6px; color: #64748b; font-size: 13px; }
        .date-cell i { color: #94a3b8; font-size: 11px; }
 
        .return-ok    { display: inline-flex; align-items: center; gap: 6px; font-size: 12.5px; color: var(--emerald); font-weight: 500; }
        .return-pending { display: inline-flex; align-items: center; gap: 6px; font-size: 12.5px; color: #94a3b8; font-style: italic; }
 
        .badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 11.5px;
            font-weight: 600;
        }
 
        .badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; }
        .badge-pending  { background: var(--amber-l);  color: var(--amber);   }
        .badge-pending::before  { background: var(--amber); }
        .badge-approved { background: var(--emerald-l); color: var(--emerald); }
        .badge-approved::before { background: var(--emerald); }
        .badge-returned { background: var(--indigo-xl); color: var(--indigo);  }
        .badge-returned::before { background: var(--indigo); }
        .badge-rejected { background: var(--rose-l);   color: var(--rose);    }
        .badge-rejected::before { background: var(--rose); }
 
        .btn-detail {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 7px 14px;
            background: var(--indigo-xl);
            color: var(--indigo);
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 600;
            text-decoration: none;
            border: 1.5px solid transparent;
            transition: all 0.2s;
            cursor: pointer;
        }
 
        .btn-detail:hover { background: var(--indigo); color: #fff; border-color: var(--indigo); }
 
        .empty-state { text-align: center; padding: 60px 20px; color: #94a3b8; }
 
        .empty-icon {
            width: 64px; height: 64px;
            background: #f8fafc;
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            font-size: 24px;
            color: #cbd5e1;
        }
 
        .empty-state p { font-family: 'Sora', sans-serif; font-size: 15px; font-weight: 700; color: #334155; margin-bottom: 6px; }
        .empty-state span { font-size: 13px; color: #94a3b8; }
 
        .pagination-wrap {
            padding: 16px 24px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
 
        .pagination-info { font-size: 13px; color: #94a3b8; }
 
        footer {
            border-top: 1px solid #e2e8f0;
            margin-top: auto;
            padding: 22px 36px;
            display: flex; align-items: center; justify-content: space-between;
        }
 
        footer .foot-brand {
            display: flex; align-items: center; gap: 10px;
            font-family: 'Sora', sans-serif;
            font-weight: 700; font-size: 14px; color: #0f172a;
        }
 
        .divider { display: flex; align-items: center; gap: 10px; margin-bottom: 20px; }
        .divider-line { flex: 1; height: 1px; background: #e2e8f0; }
        .section-title { font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: #0f172a; white-space: nowrap; }
        .section-sub   { font-size: 13px; color: #94a3b8; margin-bottom: 16px; }
 
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
 
        .filter-bar  { animation-delay: 0.08s; }
        .table-card  { animation-delay: 0.15s; }
 
        @media (max-width: 1024px) { table { min-width: 700px; } .table-card { overflow-x: auto; } }
 
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
        <a href="{{ route('user.dashboard') }}" class="nav-item"><i class="fas fa-house-chimney nav-icon"></i>Dashboard</a>
        <a href="{{ route('user.books') }}" class="nav-item"><i class="fas fa-book nav-icon"></i>Katalog Buku</a>
        <a href="{{ route('user.favorites') }}" class="nav-item"><i class="fas fa-heart nav-icon"></i>Buku Favorit</a>
        <a href="{{ route('user.borrowing.index') }}" class="nav-item active"><i class="fas fa-clock-rotate-left nav-icon"></i>Riwayat Peminjaman</a>
        <div class="nav-label">Akun</div>
        <a href="{{ (url('/profile')) }}" class="nav-item"><i class="fas fa-user nav-icon"></i>Profil Saya</a>
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

<div class="main-wrap">

    <header class="topbar">
        <div class="breadcrumb">
            <i class="fas fa-house-chimney" style="font-size:12px;"></i>
            <span>›</span>
            <span>Dashboard</span>
            <span>›</span>
            <span class="current">Riwayat Peminjaman</span>
        </div>
        <div class="topbar-right">
            <a href="{{ route('user.books') }}" class="btn-back">
                <i class="fas fa-arrow-left" style="font-size:11px;"></i>
                Kembali ke Katalog
            </a>
        </div>
    </header>

    <main class="content">

        <div class="page-hero">
            <div style="position:relative; z-index:2;">
                <div class="hero-badge">
                    <i class="fas fa-clock-rotate-left" style="font-size:10px;"></i>
                    Histori Aktivitas
                </div>
                <h2 class="hero-title">Riwayat Peminjaman</h2>
                <p class="hero-sub">Pantau status dan histori semua buku yang pernah Anda pinjam.</p>
            </div>
            <div class="hero-icon-wrap">
                <i class="fas fa-clock-rotate-left" style="font-size:36px; color:rgba(199,210,254,0.85);"></i>
            </div>
        </div>

        <div>
            <div class="divider">
                <div class="section-title">Daftar Peminjaman</div>
                <div class="divider-line"></div>
            </div>
            <p class="section-sub">Semua transaksi peminjaman buku Anda tercatat di sini</p>
        </div>

        <div class="filter-bar">
            <span class="filter-label">Filter:</span>
            <button class="filter-btn active-filter" onclick="filterTable('all', this)">Semua</button>
            <div class="filter-divider"></div>
            <button class="filter-btn status-pending"  onclick="filterTable('pending', this)">
                <i class="fas fa-circle" style="font-size:6px; color:#d97706;"></i> Pending
            </button>
            <button class="filter-btn status-approved" onclick="filterTable('approved', this)">
                <i class="fas fa-circle" style="font-size:6px; color:#059669;"></i> Disetujui
            </button>
            <button class="filter-btn status-returned" onclick="filterTable('returned', this)">
                <i class="fas fa-circle" style="font-size:6px; color:#4f46e5;"></i> Dikembalikan
            </button>
            <button class="filter-btn status-rejected" onclick="filterTable('rejected', this)">
                <i class="fas fa-circle" style="font-size:6px; color:#e11d48;"></i> Ditolak
            </button>
        </div>

        <div class="table-card">
            <div class="table-header">
                <span class="table-title">Semua Peminjaman</span>
                <button class="btn-export-monthly" id="btnExportMonthly" onclick="exportMonthlyPDF(this)">
                    <i class="fas fa-file-pdf" id="exportIcon"></i>
                    <i class="fas fa-spinner export-spin" id="exportSpin"></i>
                    Laporan Bulanan
                    <span class="export-badge">1 BULAN</span>
                </button>
            </div>

            <div style="overflow-x:auto;">
                <table id="mainTable">
                    <thead>
                        <tr>
                            <th style="width:48px;">#</th>
                            <th>Pengguna</th>
                            <th>Buku</th>
                            <th>Tgl. Pinjam</th>
                            <th>Tgl. Kembali</th>
                            <th>Status</th>
                            <th style="text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowings as $i => $item)
                        <tr data-status="{{ $item->status }}">
                            <td><span class="no-col">{{ $i + 1 }}</span></td>
                            <td>
                                <div class="user-cell">
                                    <span class="user-name">{{ $item->user->name ?? '-' }}</span>
                                </div>
                            </td>
                            <td><span class="book-name">{{ $item->book->judul ?? '-' }}</span></td>
                            <td>
                                <div class="date-cell">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $item->created_at->format('d M Y') }}
                                </div>
                            </td>
                            <td>
                                @if($item->returned_at)
                                    <div class="return-ok">
                                        <i class="fas fa-check-circle"></i>
                                        {{ \Carbon\Carbon::parse($item->returned_at)->format('d M Y') }}
                                    </div>
                                @else
                                    <div class="return-pending">
                                        <i class="fas fa-clock"></i> Belum dikembalikan
                                    </div>
                                @endif
                            </td>
                            <td>
                                @if($item->status === 'pending')
                                    <span class="badge badge-pending">Pending</span>
                                @elseif($item->status === 'approved')
                                    <span class="badge badge-approved">Disetujui</span>
                                @elseif($item->status === 'returned')
                                    <span class="badge badge-returned">Dikembalikan</span>
                                @else
                                    <span class="badge badge-rejected">Ditolak</span>
                                @endif
                            </td>
                            <td style="text-align:center;">
                                <a href="{{ route('user.borrowing.show', $item->id) }}" class="btn-detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <button onclick="exportRowToPDF(this)" class="btn-detail" style="background:#ecfeff; color:#0891b2; margin-left:4px;">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                                    <p>Belum ada riwayat peminjaman</p>
                                    <span>Pinjam buku dari katalog untuk memulai</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($borrowings->count() > 0)
            <div class="pagination-wrap">
                <span class="pagination-info">Menampilkan {{ $borrowings->count() }} data peminjaman</span>
            </div>
            @endif
        </div>

    </main>

    <footer>
        <div class="foot-brand">
            <div style="width:30px; height:30px; background:linear-gradient(135deg,var(--indigo),var(--indigo-l)); border-radius:8px; display:flex; align-items:center; justify-content:center;">
                <i class="fas fa-book-open" style="color:#fff; font-size:12px;"></i>
            </div>
            Smart Pustaka
        </div>
        <p style="font-size:12px; color:#94a3b8;">© 2026 Smart Pustaka. Hak cipta dilindungi.</p>
    </footer>

</div>

<script>
function filterTable(status, btn) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active-filter'));
    btn.classList.add('active-filter');

    const rows = document.querySelectorAll('#mainTable tbody tr[data-status]');
    let count = 0;

    rows.forEach(row => {
        if (status === 'all' || row.dataset.status === status) {
            row.style.display = ''; count++;
        } else {
            row.style.display = 'none';
        }
    });

    document.getElementById('rowCount').textContent = count + ' entri';
}

// ─────────────────────────────────────────────────────────────────────────────
//  EXPORT SINGLE ROW — STRUK STYLE (Indomaret receipt) — USER VERSION
//  Layout: portrait, struk personal per transaksi
// ─────────────────────────────────────────────────────────────────────────────
function exportRowToPDF(btn) {
    const { jsPDF } = window.jspdf;

    const row   = btn.closest('tr');
    const cells = row.querySelectorAll('td');

    const no         = cells[0].innerText.trim();
    const nama       = cells[1].innerText.trim();
    const buku       = cells[2].innerText.trim();
    const tglPinjam  = cells[3].innerText.replace(/\s+/g,' ').trim();
    const tglKembali = cells[4].innerText.replace(/\s+/g,' ').trim();
    const status     = cells[5].innerText.trim();

    const doc = new jsPDF({ orientation: 'portrait', unit: 'mm', format: 'a4' });
    const pw  = doc.internal.pageSize.getWidth();
    const ph  = doc.internal.pageSize.getHeight();

    // Warna tema — ungu/indigo (sesuai aksen user)
    const C_BG     = [247, 247, 252];   // krem ungu pucat
    const C_BLACK  = [20, 20, 25];
    const C_DARK   = [35, 35, 50];
    const C_MID    = [88, 85, 110];
    const C_LIGHT  = [158, 155, 180];
    const C_INDIGO = [79, 70, 229];
    const C_IND_D  = [55, 48, 163];
    const C_IND_L  = [224, 231, 255];
    const C_GREEN  = [5, 150, 105];
    const C_AMBER  = [217, 119, 6];
    const C_ROSE   = [225, 29, 72];
    const C_BORDER = [200, 198, 225];

    const now      = new Date();
    const dateStr  = now.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
    const timeStr  = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    const noStruk  = 'USR-' + now.getFullYear() + String(now.getMonth()+1).padStart(2,'0') + String(now.getDate()).padStart(2,'0') + '-' + no.padStart(4,'0');

    const margin  = 28;   // struk user lebih narrow — margins lebih besar
    const innerW  = pw - margin * 2;

    // ── background kertas thermal ────────────────────────────
    doc.setFillColor(...C_BG);
    doc.rect(0, 0, pw, ph, 'F');
    doc.setDrawColor(230, 228, 242);
    doc.setLineWidth(0.07);
    for (let y = 0; y < ph; y += 2.5) { doc.line(0, y, pw, y); }

    // ── notch lubang atas ────────────────────────────────────
    doc.setFillColor(228, 226, 242);
    doc.rect(0, 0, pw, 6, 'F');
    doc.setFillColor(...C_BG);
    for (let xi = 5; xi < pw; xi += 8) { doc.circle(xi, 6, 2.5, 'F'); }

    let y = 18;

    // ── HEADER INDIGO ────────────────────────────────────────
    doc.setFillColor(...C_INDIGO);
    doc.roundedRect(margin, y - 6, innerW, 26, 2, 2, 'F');

    // strip gelap bawah header
    doc.setFillColor(...C_IND_D);
    doc.rect(margin, y + 17, innerW, 3, 'F');

    doc.setFont('courier', 'bold');
    doc.setFontSize(16);
    doc.setTextColor(255, 255, 255);
    doc.text('PERPUSTAKAAN', pw / 2, y + 4, { align: 'center' });

    doc.setFont('courier', 'normal');
    doc.setFontSize(7.5);
    doc.setTextColor(199, 210, 254);
    doc.text('B U K T I   P E M I N J A M A N', pw / 2, y + 11, { align: 'center' });

    y += 30;

    // ── NO STRUK & TANGGAL CETAK ─────────────────────────────
    doc.setFont('courier', 'bold');
    doc.setFontSize(11);
    doc.setTextColor(...C_BLACK);
    doc.text('STRUK PEMINJAMAN', pw / 2, y, { align: 'center' });
    y += 5;

    doc.setFont('courier', 'normal');
    doc.setFontSize(7);
    doc.setTextColor(...C_LIGHT);
    doc.text('= '.repeat(20), pw / 2, y, { align: 'center' });
    y += 5;

    // info header struk
    const kvLine = (label, value, yPos, lColor = C_MID, vColor = C_DARK) => {
        doc.setFont('courier', 'normal');
        doc.setFontSize(7.5);
        doc.setTextColor(...lColor);
        doc.text(label, margin, yPos);
        doc.setFont('courier', 'bold');
        doc.setTextColor(...vColor);
        doc.text(String(value), pw - margin, yPos, { align: 'right' });
    };

    const dottedLine = (x1, yy, x2) => {
        doc.setDrawColor(...C_BORDER);
        doc.setLineWidth(0.3);
        let cx = x1;
        while (cx < x2) {
            doc.line(cx, yy, Math.min(cx + 1.5, x2), yy);
            cx += 3;
        }
    };

    kvLine('No. Struk',   noStruk,  y, C_MID, C_INDIGO);  y += 5;
    kvLine('Tanggal',     dateStr,  y);                    y += 5;
    kvLine('Jam Cetak',   timeStr,  y);                    y += 5;
    kvLine('Anggota',     nama,     y, C_MID, C_DARK);     y += 7;

    dottedLine(margin, y, pw - margin);
    y += 6;

    // ── DETAIL TRANSAKSI ─────────────────────────────────────
    doc.setFont('courier', 'bold');
    doc.setFontSize(8.5);
    doc.setTextColor(...C_DARK);
    doc.text('*** DETAIL TRANSAKSI ***', pw / 2, y, { align: 'center' });
    y += 7;

    // ── Judul Buku — box khusus ───────────────────────────────
    doc.setFillColor(235, 233, 255);
    doc.setDrawColor(...C_BORDER);
    doc.setLineWidth(0.4);
    doc.roundedRect(margin, y - 4, innerW, 20, 2, 2, 'FD');

    // label "JUDUL BUKU" kecil di sudut kiri atas
    doc.setFont('courier', 'bold');
    doc.setFontSize(6);
    doc.setTextColor(...C_INDIGO);
    doc.text('JUDUL BUKU', margin + 4, y + 1);

    // nilai buku — wrap jika panjang
    const bookLines = doc.splitTextToSize(buku, innerW - 10);
    doc.setFont('courier', 'bold');
    doc.setFontSize(9);
    doc.setTextColor(...C_BLACK);
    doc.text(bookLines.slice(0, 2), margin + 4, y + 7);   // max 2 baris

    y += 24;

    // ── Tabel detail kiri-kanan ───────────────────────────────
    const detailRows = [
        { label: 'No. Transaksi',   value: '#' + no.padStart(4,'0') },
        { label: 'Tgl. Peminjaman', value: tglPinjam.replace(/[^\d\s\w]/g,'').trim() },
        { label: 'Tgl. Pengembalian', value: tglKembali.replace(/[^\d\s\w]/g,'').trim() },
    ];

    detailRows.forEach((dr, idx) => {
        const rowY = y;
        if (idx % 2 === 0) {
            doc.setFillColor(240, 238, 252);
            doc.rect(margin - 1, rowY - 4, innerW + 2, 11, 'F');
        }
        doc.setFont('courier', 'normal');
        doc.setFontSize(7.5);
        doc.setTextColor(...C_MID);
        doc.text(dr.label, margin + 3, rowY + 2);

        doc.setFont('courier', 'bold');
        doc.setFontSize(7.5);
        doc.setTextColor(...C_DARK);
        doc.text(dr.value, pw - margin - 3, rowY + 2, { align: 'right' });

        y += 12;
        dottedLine(margin + 8, y - 3, pw - margin - 8);
    });

    y += 4;
    dottedLine(margin, y, pw - margin);
    y += 8;

    // ── STATUS BADGE BESAR ────────────────────────────────────
    const s = status.toLowerCase();
    let badgeBg, badgeFg, badgeLabel, badgeIcon;

    if (s.includes('kembali') || s.includes('returned')) {
        badgeBg = [209, 250, 229]; badgeFg = C_GREEN;
        badgeLabel = 'DIKEMBALIKAN'; badgeIcon = '✓';
    } else if (s.includes('setuju') || s.includes('approved')) {
        badgeBg = C_IND_L; badgeFg = C_INDIGO;
        badgeLabel = 'DISETUJUI'; badgeIcon = '●';
    } else if (s.includes('pending')) {
        badgeBg = [254, 243, 199]; badgeFg = C_AMBER;
        badgeLabel = 'PENDING'; badgeIcon = '◷';
    } else {
        badgeBg = [255, 228, 230]; badgeFg = C_ROSE;
        badgeLabel = 'DITOLAK'; badgeIcon = '✗';
    }

    const badgeW = 80; const badgeH = 14;
    const badgeX = pw / 2 - badgeW / 2;

    doc.setFillColor(...badgeBg);
    doc.roundedRect(badgeX, y, badgeW, badgeH, 3, 3, 'F');
    doc.setDrawColor(...badgeFg);
    doc.setLineWidth(0.5);
    doc.roundedRect(badgeX, y, badgeW, badgeH, 3, 3, 'D');

    doc.setFont('courier', 'bold');
    doc.setFontSize(9.5);
    doc.setTextColor(...badgeFg);
    doc.text(badgeLabel, pw / 2, y + 9, { align: 'center' });

    y += badgeH + 10;

    dottedLine(margin, y, pw - margin);
    y += 7;

    // ── PESAN PERSONAL ────────────────────────────────────────
    doc.setFont('courier', 'normal');
    doc.setFontSize(8);
    doc.setTextColor(...C_MID);
    doc.text('Terima kasih,', pw / 2, y, { align: 'center' });  y += 5;

    doc.setFont('courier', 'bold');
    doc.setFontSize(8.5);
    doc.setTextColor(...C_DARK);
    const namaShort = nama.length > 22 ? nama.slice(0,22) + '.' : nama;
    doc.text(namaShort + '!', pw / 2, y, { align: 'center' });  y += 5;

    doc.setFont('courier', 'normal');
    doc.setFontSize(7.5);
    doc.setTextColor(...C_LIGHT);
    doc.text('Simpan struk ini sebagai bukti peminjaman.', pw / 2, y, { align: 'center' });  y += 4;
    doc.text('Kembalikan buku tepat waktu ya! :)', pw / 2, y, { align: 'center' });           y += 8;

    // ── BARCODE DEKORATIF ─────────────────────────────────────
    const bcX = pw / 2 - 28;
    const bcW = 56;
    const bcY = y;
    const bcH = 9;
    const bars = [0.7,0.4,1.1,0.3,0.6,1,0.4,0.8,0.3,0.5,1.2,0.4,0.7,0.3,1,0.5,0.4,0.9,0.3,1,0.4,0.6,0.3,1.1,0.5,0.4,0.8,0.3,1,0.5];
    const totalBars = bars.reduce((a,b) => a+b, 0);
    let bx = bcX;
    let isBlk = true;
    bars.forEach(bw => {
        const w = bw * (bcW / totalBars) * bars.length / 2.5;
        if (isBlk) {
            doc.setFillColor(...C_BLACK);
            doc.rect(bx, bcY, w, bcH, 'F');
        }
        bx += w;
        isBlk = !isBlk;
    });

    y += bcH + 3;
    doc.setFont('courier', 'normal');
    doc.setFontSize(6.5);
    doc.setTextColor(...C_LIGHT);
    doc.text(noStruk, pw / 2, y, { align: 'center' });
    y += 8;

    // ── SMART PUSTAKA TAGLINE ─────────────────────────────────
    dottedLine(margin, y, pw - margin);
    y += 6;

    doc.setFont('courier', 'bold');
    doc.setFontSize(9);
    doc.setTextColor(...C_INDIGO);
    doc.text('Smart Pustaka', pw / 2, y, { align: 'center' });  y += 5;

    doc.setFont('courier', 'normal');
    doc.setFontSize(7);
    doc.setTextColor(...C_LIGHT);
    doc.text('perpustakaan.digital', pw / 2, y, { align: 'center' });  y += 5;
    doc.text('Dicetak ' + dateStr + ' pukul ' + timeStr, pw / 2, y, { align: 'center' });

    // ── notch bawah ───────────────────────────────────────────
    doc.setFillColor(228, 226, 242);
    doc.rect(0, ph - 6, pw, 6, 'F');
    doc.setFillColor(...C_BG);
    for (let xi = 5; xi < pw; xi += 8) { doc.circle(xi, ph - 6, 2.5, 'F'); }

    doc.save('struk-peminjaman-' + noStruk + '.pdf');
}
</script>
<script>
// ─────────────────────────────────────────────────────────────────────────────
//  EXPORT PDF LAPORAN BULANAN — versi bersih
//  Dependensi: jsPDF + jsPDF-AutoTable (CDN)
// ─────────────────────────────────────────────────────────────────────────────

function exportMonthlyPDF(btn) {
    btn.disabled = true;
    const icon = document.getElementById('exportIcon');
    const spin = document.getElementById('exportSpin');
    if (icon) icon.style.display = 'none';
    if (spin) spin.style.display = 'inline-block';

    setTimeout(() => {
        try { _doExportMonthly(); }
        finally {
            btn.disabled = false;
            if (icon) icon.style.display = '';
            if (spin) spin.style.display = 'none';
        }
    }, 300);
}

function _doExportMonthly() {
    const { jsPDF } = window.jspdf;

    // ── Tanggal & metadata ─────────────────────────────────────────────────────
    const now    = new Date();
    const cutoff = new Date(now);
    cutoff.setDate(cutoff.getDate() - 30);

    const fmtDate = (d) => d.toLocaleDateString('id-ID', {
        day: '2-digit', month: 'long', year: 'numeric'
    });
    const fmtMonth = (d) => d.toLocaleDateString('id-ID', {
        month: 'long', year: 'numeric'
    });

    const DATE    = fmtDate(now);
    const MONTH   = fmtMonth(now);
    const CUTOFF  = fmtDate(cutoff);
    const TIME    = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
    const RPT_NO  = 'RPT-'
        + now.getFullYear()
        + String(now.getMonth() + 1).padStart(2, '0')
        + String(now.getDate()).padStart(2, '0');

    // ── Ambil data dari tabel ──────────────────────────────────────────────────
    const allRows   = [...document.querySelectorAll('#mainTable tbody tr[data-status]')];
    const monthRows = allRows.filter(r => !r.dataset.date || new Date(r.dataset.date) >= cutoff);

    const count = { pending: 0, approved: 0, returned: 0, rejected: 0 };
    monthRows.forEach(r => {
        if (count[r.dataset.status] !== undefined) count[r.dataset.status]++;
    });
    const total = monthRows.length;

    // ── Setup dokumen ──────────────────────────────────────────────────────────
    const doc = new jsPDF({ orientation: 'portrait', unit: 'mm', format: 'a4' });
    const PW  = doc.internal.pageSize.getWidth();   // 210
    const PH  = doc.internal.pageSize.getHeight();  // 297
    const ML  = 16;  // margin kiri
    const MR  = 16;  // margin kanan
    const CW  = PW - ML - MR;  // content width

    // ── Palet — minimal: hitam, abu, satu aksen biru ───────────────────────────
    const C = {
        black:   [15,  15,  15 ],
        dark:    [40,  40,  40 ],
        mid:     [100, 100, 100],
        muted:   [150, 150, 150],
        line:    [220, 220, 220],
        bg:      [248, 248, 248],
        white:   [255, 255, 255],
        accent:  [37,  99,  235],   // biru solid — satu-satunya warna
        accentL: [219, 234, 254],   // biru muda untuk status
    };

    // status label & warna teks
    const STATUS = {
        returned: { label: 'Kembali',   r: [5,   150, 105], bg: [209, 250, 229] },
        approved: { label: 'Disetujui', r: C.accent,        bg: C.accentL       },
        pending:  { label: 'Pending',   r: [161, 98,  7  ], bg: [254, 243, 199] },
        rejected: { label: 'Ditolak',   r: [185, 28,  28 ], bg: [254, 226, 226] },
    };

    // ── Helper ─────────────────────────────────────────────────────────────────
    const sf   = (...c) => doc.setFillColor(...c);
    const sd   = (...c) => doc.setDrawColor(...c);
    const st   = (...c) => doc.setTextColor(...c);
    const font = (style, size) => { doc.setFont('helvetica', style); doc.setFontSize(size); };
    const tx   = (text, x, y, opts = {}) => doc.text(String(text), x, y, opts);
    const hln  = (y, lw = 0.25) => {
        sd(...C.line); doc.setLineWidth(lw);
        doc.line(ML, y, PW - MR, y);
    };
    const trunc = (str, max) => str.length > max ? str.slice(0, max - 1) + '…' : str;

    // ── HEADER — nama + nomor laporan, satu baris ──────────────────────────────
    function drawHeader() {
        font('bold', 11);
        st(...C.black);
        tx('Smart Pustaka', ML, 18);

        font('normal', 8);
        st(...C.muted);
        tx('Laporan Bulanan · ' + MONTH, ML, 25);

        // Nomor laporan di kanan
        font('normal', 7.5);
        tx(RPT_NO, PW - MR, 18, { align: 'right' });
        tx('Dicetak ' + DATE + ' ' + TIME, PW - MR, 25, { align: 'right' });

        // Satu garis pemisah
        hln(30, 0.4);
    }

    // ── STAT ROW — 4 angka inline, tanpa card box ──────────────────────────────
    function drawStats(y) {
        const cols = [
            { label: 'Total',     val: total          },
            { label: 'Disetujui', val: count.approved },
            { label: 'Pending',   val: count.pending  },
            { label: 'Ditolak',   val: count.rejected },
        ];

        const colW = CW / cols.length;

        cols.forEach(({ label, val }, i) => {
            const cx = ML + i * colW + colW / 2;

            font('bold', 18);
            st(...C.accent);
            tx(String(val), cx, y + 7, { align: 'center' });

            font('normal', 7);
            st(...C.muted);
            tx(label, cx, y + 13, { align: 'center' });
        });

        hln(y + 18);
        return y + 22;
    }

    // ── PERIODE ────────────────────────────────────────────────────────────────
    function drawPeriode(y) {
        font('normal', 7.5);
        st(...C.muted);
        tx('Periode: ' + CUTOFF + ' – ' + DATE, ML, y);
        tx(count.returned + ' transaksi dikembalikan', PW - MR, y, { align: 'right' });
        return y + 8;
    }

    // ── TABLE HEADER ───────────────────────────────────────────────────────────
    const COLS = [
        { label: '#',            x: ML,      w: 8  },
        { label: 'Pengguna',     x: ML + 8,  w: 38 },
        { label: 'Judul Buku',   x: ML + 46, w: 62 },
        { label: 'Tgl. Pinjam',  x: ML + 108,w: 28 },
        { label: 'Tgl. Kembali', x: ML + 136,w: 28 },
        { label: 'Status',       x: ML + 164,w: 22 },
    ];

    function drawTableHeader(y) {
        // Background abu tipis
        sf(...C.bg);
        doc.rect(ML, y - 4, CW, 10, 'F');

        font('bold', 6.5);
        st(...C.mid);
        COLS.forEach(col => tx(col.label.toUpperCase(), col.x + 1, y + 2));

        hln(y + 6, 0.3);
        return y + 8;
    }

    // ── TABLE ROW ──────────────────────────────────────────────────────────────
    const ROW_H = 10;

    function drawTableRow(row, idx, y) {
        const cells = row.querySelectorAll('td');
        const no   = cells[0]?.innerText.trim() || String(idx + 1);
        const nama = cells[1]?.innerText.trim() || '';
        const buku = cells[2]?.innerText.trim() || '';
        const tgl1 = cells[3]?.innerText.trim() || '';
        const tgl2 = cells[4]?.innerText.trim() || '';
        const stat = row.dataset.status;
        const s    = STATUS[stat] ?? STATUS.rejected;

        // Stripe genap — sangat tipis
        if (idx % 2 === 0) {
            sf(252, 252, 252);
            doc.rect(ML, y - 2, CW, ROW_H, 'F');
        }

        // No
        font('normal', 7); st(...C.muted);
        tx(no, COLS[0].x + 1, y + 4);

        // Nama — bold
        font('bold', 7.5); st(...C.dark);
        tx(trunc(nama, 20), COLS[1].x + 1, y + 4);

        // Buku
        font('normal', 7.5); st(...C.mid);
        tx(trunc(buku, 32), COLS[2].x + 1, y + 4);

        // Tanggal
        font('normal', 7); st(...C.muted);
        tx(trunc(tgl1, 14), COLS[3].x + 1, y + 4);
        tx(trunc(tgl2, 14), COLS[4].x + 1, y + 4);

        // Status pill — lebar menyesuaikan teks
        font('bold', 6); st(...s.r);
        const labelW = doc.getTextWidth(s.label);
        const padX   = 3;   // padding kiri-kanan dalam mm
        const pw     = labelW + padX * 2;
        const px     = COLS[5].x;
        sf(...s.bg);
        doc.roundedRect(px, y - 0.5, pw, 7, 1.5, 1.5, 'F');
        tx(s.label, px + pw / 2, y + 4, { align: 'center' });

        // Garis bawah tipis
        hln(y + ROW_H - 2, 0.15);

        return ROW_H;
    }

    // ── MINI HEADER (halaman ke-2+) ────────────────────────────────────────────
    function drawPageHeader() {
        font('normal', 7.5); st(...C.muted);
        tx('Smart Pustaka — Laporan Bulanan ' + MONTH, ML, 10);
        tx('Hal. ' + doc.internal.getCurrentPageInfo().pageNumber, PW - MR, 10, { align: 'right' });
        hln(13, 0.25);
    }

    // ── FOOTER — satu baris saja ───────────────────────────────────────────────
    function drawFooter() {
        const fy = PH - 10;
        hln(fy - 4, 0.25);
        font('normal', 6.5); st(...C.muted);
        tx('Dicetak otomatis · ' + RPT_NO, ML, fy);
        tx('Smart Pustaka Digital', PW - MR, fy, { align: 'right' });
    }

    // ── RENDER HALAMAN 1 ───────────────────────────────────────────────────────
    drawHeader();
    let y = 36;
    y = drawStats(y);
    y = drawPeriode(y) + 4;

    // Judul seksi
    font('bold', 7.5); st(...C.dark);
    tx('DETAIL TRANSAKSI', ML, y); y += 6;

    y = drawTableHeader(y);

    // Baris data
    if (monthRows.length === 0) {
        font('italic', 8.5); st(...C.muted);
        tx('Tidak ada data dalam 30 hari terakhir.', PW / 2, y + 12, { align: 'center' });
        y += 20;
    } else {
        monthRows.forEach((row, idx) => {
            if (y + ROW_H + 4 > PH - 18) {
                doc.addPage();
                drawPageHeader();
                y = 20;
                y = drawTableHeader(y);
            }
            y += drawTableRow(row, idx, y);
        });
    }

    // Footer semua halaman
    const totalPages = doc.internal.getNumberOfPages();
    for (let p = 1; p <= totalPages; p++) {
        doc.setPage(p);
        drawFooter();
        font('normal', 6.5); st(...C.muted);
        tx(p + ' / ' + totalPages, PW / 2, PH - 10, { align: 'center' });
    }

    // ── Simpan ─────────────────────────────────────────────────────────────────
    const fileName = 'laporan-bulanan-'
        + now.getFullYear()
        + String(now.getMonth() + 1).padStart(2, '0')
        + '.pdf';
    doc.save(fileName);
}
</script>
</body>
</html>