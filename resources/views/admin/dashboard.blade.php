<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --blue: #2563eb;
            --blue-light: #eff6ff;
            --blue-mid: #bfdbfe;
            --indigo: #4f46e5;
            --surface: #ffffff;
            --bg: #f4f6fb;
            --border: #e5e7eb;
            --text: #111827;
            --muted: #6b7280;
            --green: #16a34a;
            --green-bg: #dcfce7;
            --yellow: #d97706;
            --yellow-bg: #fffbeb;
            --red: #dc2626;
            --red-bg: #fee2e2;
            --purple: #7c3aed;
            --purple-bg: #f5f3ff;
            --orange: #ea580c;
            --orange-bg: #fff7ed;
            --shadow: 0 1px 3px rgba(0,0,0,.07), 0 4px 16px rgba(0,0,0,.05);
            --shadow-md: 0 4px 20px rgba(0,0,0,.08);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            min-height: 100vh;
        }

        /* ── SIDEBAR ── */
        aside {
            width: 260px;
            background: var(--surface);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            flex-shrink: 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 24px 20px;
            border-bottom: 1px solid var(--border);
        }

        .brand-icon {
            width: 42px; height: 42px;
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(79,70,229,.25);
        }

        .brand-icon i { color: #fff; font-size: 18px; }
        .brand-title { font-size: 15px; font-weight: 800; color: var(--text); }
        .brand-sub { font-size: 11px; color: var(--muted); margin-top: 1px; }

        nav {
            flex: 1;
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 2px;
            overflow-y: auto;
        }

        .nav-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .08em;
            color: var(--muted);
            text-transform: uppercase;
            padding: 12px 12px 6px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 500;
            color: var(--muted);
            text-decoration: none;
            transition: background .15s, color .15s, transform .15s;
        }

        .nav-link i { width: 18px; text-align: center; font-size: 14px; flex-shrink: 0; }

        .nav-link:hover {
            background: var(--bg);
            color: var(--text);
            transform: translateX(3px);
        }

        .nav-link.active {
            background: var(--blue-light);
            color: var(--blue);
            font-weight: 600;
        }

        .sidebar-footer {
            padding: 12px;
            border-top: 1px solid var(--border);
        }

        .logout-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            border: none;
            background: none;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 500;
            color: #ef4444;
            cursor: pointer;
            font-family: inherit;
            transition: background .15s;
        }

        .logout-btn:hover { background: #fef2f2; }

        /* ── MAIN ── */
        main {
            flex: 1;
            padding: 36px 40px;
            overflow-x: hidden;
        }

        /* Page header */
        .page-header { margin-bottom: 32px; }
        .page-title { font-size: 26px; font-weight: 800; color: var(--text); }
        .page-sub { font-size: 13px; color: var(--muted); margin-top: 5px; }
        .page-sub strong { color: var(--text); font-weight: 700; }

        /* ── STAT CARDS ── */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 36px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 22px 24px;
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            gap: 16px;
            transition: transform .2s, box-shadow .2s;
            text-decoration: none;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .stat-icon {
            width: 46px; height: 46px;
            border-radius: 13px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .stat-tag {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 4px 9px;
            border-radius: 20px;
        }

        .stat-label { font-size: 13px; font-weight: 600; color: var(--muted); }
        .stat-value { font-size: 36px; font-weight: 800; color: var(--text); line-height: 1; margin-top: 4px; }

        .stat-footer {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            color: var(--muted);
            padding-top: 12px;
            border-top: 1px solid var(--border);
        }

        /* ── QUICK ACCESS ── */
        .section-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-title i { color: var(--muted); font-size: 14px; }

        .quick-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 36px;
        }

        .quick-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 18px 20px;
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            box-shadow: var(--shadow);
            transition: transform .15s, box-shadow .15s, border-color .15s;
        }

        .quick-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--blue-mid);
        }

        .quick-icon {
            width: 40px; height: 40px;
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .quick-name { font-size: 13.5px; font-weight: 700; color: var(--text); }
        .quick-desc { font-size: 12px; color: var(--muted); margin-top: 2px; }

        .quick-arrow {
            margin-left: auto;
            color: #d1d5db;
            font-size: 12px;
            flex-shrink: 0;
            transition: color .15s, transform .15s;
        }

        .quick-card:hover .quick-arrow { color: var(--blue); transform: translateX(2px); }

        /* ── RECENT TABLE ── */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .card-head {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-head-title { font-size: 14px; font-weight: 700; }

        .view-all {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--blue);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap .15s;
        }

        .view-all:hover { gap: 7px; }

        table { width: 100%; border-collapse: collapse; }

        thead tr { background: #f9fafb; border-bottom: 1px solid var(--border); }

        th {
            padding: 11px 20px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--muted);
            text-align: left;
            white-space: nowrap;
        }

        td {
            padding: 13px 20px;
            font-size: 13.5px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
        }

        tbody tr { transition: background .12s; }
        tbody tr:hover { background: #fafbff; }
        tbody tr:last-child td { border-bottom: none; }

        .user-cell { display: flex; align-items: center; gap: 10px; }

        .avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 12px; font-weight: 700;
            flex-shrink: 0;
        }

        .badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
        }

        .badge::before { content: ''; width: 5px; height: 5px; border-radius: 50%; background: currentColor; opacity: .7; }
        .badge-pending  { background: var(--yellow-bg); color: var(--yellow); }
        .badge-approved { background: var(--blue-light); color: var(--blue); }
        .badge-returned { background: var(--green-bg);  color: var(--green); }
        .badge-rejected { background: var(--red-bg);    color: var(--red); }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<aside>
    <div class="brand">
        <div class="brand-icon"><i class="fas fa-book-open"></i></div>
        <div>
            <div class="brand-title">Perpustakaan</div>
            <div class="brand-sub">Admin Panel</div>
        </div>
    </div>

    <nav>
        <div class="nav-label">Menu Utama</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link active">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="{{ route('admin.users') }}" class="nav-link">
            <i class="fas fa-users"></i> Manajemen User
        </a>
        <a href="{{ url('/admin/books') }}" class="nav-link">
            <i class="fas fa-book"></i> Data Buku
        </a>
        <a href="{{ route('admin.categories.index') }}" class="nav-link">
            <i class="fas fa-tags"></i> Kategori Buku
        </a>

        <div class="nav-label">Menu Tambahan</div>
        <a href="{{ route('admin.borrowings.index') }}" class="nav-link">
            <i class="fas fa-handshake"></i> Riwayat Peminjaman
        </a>
        <a href="{{ route('admin.ratings.index') }}" class="nav-link">
            <i class="fas fa-star"></i> Ulasan Buku
        </a>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</aside>

<!-- MAIN -->
<main>

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-title">Dashboard</div>
        <div class="page-sub">
            Selamat datang kembali, <strong>{{ auth()->user()->name }}</strong> 👋
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="stats-grid">

        <!-- Total User -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon" style="background:var(--blue-light)">
                    <i class="fas fa-users" style="color:var(--blue)"></i>
                </div>
                <span class="stat-tag" style="background:var(--blue-light); color:var(--blue)">Total</span>
            </div>
            <div>
                <div class="stat-label">Total User</div>
                <div class="stat-value">{{ $totalUser }}</div>
            </div>
            <div class="stat-footer">
                <i class="fas fa-arrow-right" style="font-size:10px"></i>
                <a href="{{ route('admin.users') }}" style="color:var(--blue); font-weight:600; text-decoration:none; font-size:12px">Lihat semua user</a>
            </div>
        </div>

        <!-- Total Petugas -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon" style="background:var(--green-bg)">
                    <i class="fas fa-user-shield" style="color:var(--green)"></i>
                </div>
                <span class="stat-tag" style="background:var(--green-bg); color:var(--green)">Staff</span>
            </div>
            <div>
                <div class="stat-label">Total Petugas</div>
                <div class="stat-value">{{ $totalPetugas }}</div>
            </div>
            <div class="stat-footer">
                <i class="fas fa-arrow-right" style="font-size:10px"></i>
                <a href="{{ route('admin.users') }}" style="color:var(--green); font-weight:600; text-decoration:none; font-size:12px">Kelola petugas</a>
            </div>
        </div>

        <!-- Total Peminjaman -->
        <div class="stat-card">
            <div class="stat-top">
                <div class="stat-icon" style="background:var(--purple-bg)">
                    <i class="fas fa-book-reader" style="color:var(--purple)"></i>
                </div>
                <span class="stat-tag" style="background:var(--purple-bg); color:var(--purple)">Active</span>
            </div>
            <div>
                <div class="stat-label">Total Peminjaman</div>
                <div class="stat-value">{{ $totalBorrowing }}</div>
            </div>
            <div class="stat-footer">
                <i class="fas fa-arrow-right" style="font-size:10px"></i>
                <a href="{{ route('admin.borrowings.index') }}" style="color:var(--purple); font-weight:600; text-decoration:none; font-size:12px">Lihat peminjaman</a>
            </div>
        </div>

    </div>

    <!-- Quick Access -->
    <div class="section-title">
        <i class="fas fa-bolt"></i> Akses Cepat
    </div>

    <div class="quick-grid">
        <a href="{{ url('/admin/books') }}" class="quick-card">
            <div class="quick-icon" style="background:var(--blue-light)">
                <i class="fas fa-book" style="color:var(--blue)"></i>
            </div>
            <div>
                <div class="quick-name">Data Buku</div>
                <div class="quick-desc">Kelola koleksi buku</div>
            </div>
            <i class="fas fa-chevron-right quick-arrow"></i>
        </a>

        <a href="{{ route('admin.categories.index') }}" class="quick-card">
            <div class="quick-icon" style="background:#fef3c7">
                <i class="fas fa-tags" style="color:var(--yellow)"></i>
            </div>
            <div>
                <div class="quick-name">Kategori Buku</div>
                <div class="quick-desc">Atur kategori koleksi</div>
            </div>
            <i class="fas fa-chevron-right quick-arrow"></i>
        </a>

        <a href="{{ route('admin.borrowings.index') }}" class="quick-card">
            <div class="quick-icon" style="background:var(--green-bg)">
                <i class="fas fa-handshake" style="color:var(--green)"></i>
            </div>
            <div>
                <div class="quick-name">Riwayat Peminjaman</div>
                <div class="quick-desc">Pantau aktivitas pinjam</div>
            </div>
            <i class="fas fa-chevron-right quick-arrow"></i>
        </a>

        <a href="{{ route('admin.users') }}" class="quick-card">
            <div class="quick-icon" style="background:var(--purple-bg)">
                <i class="fas fa-users" style="color:var(--purple)"></i>
            </div>
            <div>
                <div class="quick-name">Manajemen User</div>
                <div class="quick-desc">Kelola akun pengguna</div>
            </div>
            <i class="fas fa-chevron-right quick-arrow"></i>
        </a>

        <a href="{{ route('admin.books.create') }}" class="quick-card">
            <div class="quick-icon" style="background:var(--orange-bg)">
                <i class="fas fa-plus-circle" style="color:var(--orange)"></i>
            </div>
            <div>
                <div class="quick-name">Tambah Buku</div>
                <div class="quick-desc">Input buku baru</div>
            </div>
            <i class="fas fa-chevron-right quick-arrow"></i>
        </a>

        <a href="{{ route('admin.users.create') }}" class="quick-card">
            <div class="quick-icon" style="background:var(--blue-light)">
                <i class="fas fa-user-plus" style="color:var(--blue)"></i>
            </div>
            <div>
                <div class="quick-name">Tambah Akun</div>
                <div class="quick-desc">Buat akun petugas baru</div>
            </div>
            <i class="fas fa-chevron-right quick-arrow"></i>
        </a>
    </div>
</main>
</body>
</html>