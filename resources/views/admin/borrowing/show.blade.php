<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Peminjaman | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --sidebar-w: 260px;
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
            --yellow: #b45309;
            --yellow-bg: #fef3c7;
            --red: #dc2626;
            --red-bg: #fee2e2;
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
            width: var(--sidebar-w);
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

        .nav-link.active i { color: var(--blue); }

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

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 14px;
        }

        .breadcrumb a {
            color: var(--muted);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: color .15s;
        }

        .breadcrumb a:hover { color: var(--blue); }
        .breadcrumb i.sep { font-size: 10px; color: #d1d5db; }
        .breadcrumb span { color: var(--text); font-weight: 600; }

        /* Page header */
        .page-header {
            margin-bottom: 28px;
        }

        .page-title { font-size: 26px; font-weight: 800; color: var(--text); }
        .page-sub { font-size: 13px; color: var(--muted); margin-top: 4px; }

        /* Grid layout */
        .grid {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 24px;
            align-items: start;
        }

        .left-col { display: flex; flex-direction: column; gap: 20px; }
        .right-col { display: flex; flex-direction: column; gap: 20px; }

        /* Card base */
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
            gap: 12px;
        }

        .card-head-icon {
            width: 36px; height: 36px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .card-head-title { font-size: 14px; font-weight: 700; color: var(--text); }
        .card-head-sub { font-size: 12px; color: var(--muted); margin-top: 1px; }

        .card-body { padding: 24px; }

        /* Info rows */
        .info-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            border-radius: 12px;
            border: 1px solid var(--border);
            transition: box-shadow .15s, transform .15s;
        }

        .info-item:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-1px);
        }

        .info-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .info-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 15px;
            font-weight: 700;
            color: var(--text);
        }

        .info-sub {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .info-items-stack {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        /* Avatar */
        .avatar-lg {
            width: 46px; height: 46px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 18px;
            font-weight: 800;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(79,70,229,.2);
        }

        /* Action buttons */
        .actions { display: flex; flex-wrap: wrap; gap: 10px; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            border: none;
            text-decoration: none;
            transition: background .15s, transform .1s, box-shadow .15s;
        }

        .btn:hover { transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }

        .btn-back {
            background: var(--bg);
            color: var(--text);
            border: 1.5px solid var(--border);
        }
        .btn-back:hover { background: #eaecf1; }

        .btn-approve {
            background: var(--blue);
            color: #fff;
            box-shadow: 0 2px 8px rgba(37,99,235,.25);
        }
        .btn-approve:hover { background: #1d4ed8; box-shadow: 0 4px 14px rgba(37,99,235,.35); }

        .btn-reject {
            background: var(--red);
            color: #fff;
            box-shadow: 0 2px 8px rgba(220,38,38,.2);
        }
        .btn-reject:hover { background: #b91c1c; box-shadow: 0 4px 14px rgba(220,38,38,.3); }

        /* Status display */
        .status-display {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 28px 20px;
            border-radius: 14px;
            border: 1.5px solid;
            text-align: center;
        }

        .status-circle {
            width: 64px; height: 64px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            color: #fff;
            margin-bottom: 14px;
        }

        .status-tag {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .status-name {
            font-size: 20px;
            font-weight: 800;
        }

        .status-desc {
            font-size: 12px;
            margin-top: 6px;
        }

        /* Colors per status */
        .status-approved { background: var(--blue-light); border-color: var(--blue-mid); }
        .status-approved .status-circle { background: linear-gradient(135deg, var(--blue), var(--indigo)); }
        .status-approved .status-tag, .status-approved .status-desc { color: #3b82f6; }
        .status-approved .status-name { color: var(--blue); }

        .status-returned { background: var(--green-bg); border-color: #86efac; }
        .status-returned .status-circle { background: linear-gradient(135deg, #16a34a, #15803d); }
        .status-returned .status-tag, .status-returned .status-desc { color: #22c55e; }
        .status-returned .status-name { color: var(--green); }

        .status-rejected { background: var(--red-bg); border-color: #fca5a5; }
        .status-rejected .status-circle { background: linear-gradient(135deg, var(--red), #b91c1c); }
        .status-rejected .status-tag, .status-rejected .status-desc { color: #f87171; }
        .status-rejected .status-name { color: var(--red); }

        .status-pending { background: var(--yellow-bg); border-color: #fcd34d; }
        .status-pending .status-circle { background: linear-gradient(135deg, #d97706, #b45309); }
        .status-pending .status-tag, .status-pending .status-desc { color: #f59e0b; }
        .status-pending .status-name { color: var(--yellow); }

        /* Timeline */
        .timeline { display: flex; flex-direction: column; gap: 0; }

        .tl-item {
            display: flex;
            gap: 14px;
            position: relative;
        }

        .tl-item:not(:last-child)::after {
            content: '';
            position: absolute;
            left: 15px;
            top: 32px;
            bottom: -4px;
            width: 2px;
            background: var(--border);
        }

        .tl-dot {
            width: 32px; height: 32px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-size: 12px;
            position: relative;
            z-index: 1;
            margin-top: 2px;
        }

        .tl-content { padding-bottom: 20px; }
        .tl-title { font-size: 13.5px; font-weight: 600; color: var(--text); }
        .tl-time { font-size: 12px; color: var(--muted); margin-top: 2px; }

        /* Color helpers */
        .bg-blue-subtle { background: var(--blue-light); }
        .bg-indigo-subtle { background: #eef2ff; }
        .bg-orange-subtle { background: var(--orange-bg); }
        .bg-green-subtle { background: var(--green-bg); }
        .text-blue { color: var(--blue); }
        .text-indigo { color: var(--indigo); }
        .text-orange { color: var(--orange); }
        .text-green { color: var(--green); }
        .text-muted { color: var(--muted); }
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
        <a href="{{ route('admin.dashboard') }}" class="nav-link">
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
        <a href="{{ route('admin.borrowings.index') }}" class="nav-link active">
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

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('admin.borrowings.index') }}">
            <i class="fas fa-handshake"></i> Riwayat Peminjaman
        </a>
        <i class="fas fa-chevron-right sep"></i>
        <span>Detail Peminjaman</span>
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-title">Detail Peminjaman</div>
        <div class="page-sub">Informasi lengkap peminjaman buku</div>
    </div>

    <!-- Grid -->
    <div class="grid">

        <!-- LEFT COL -->
        <div class="left-col">

            <!-- Borrowing Info Card -->
            <div class="card">
                <div class="card-head">
                    <div class="card-head-icon" style="background:var(--blue-light)">
                        <i class="fas fa-info-circle" style="color:var(--blue); font-size:16px"></i>
                    </div>
                    <div>
                        <div class="card-head-title">Informasi Peminjaman</div>
                        <div class="card-head-sub">ID: #{{ $borrowing->id }}</div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="info-items-stack">

                        <!-- Peminjam -->
                        <div class="info-item bg-blue-subtle">
                            <div class="avatar-lg">
                                {{ strtoupper(substr($borrowing->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <div class="info-label text-blue">
                                    <i class="fas fa-user" style="margin-right:4px"></i>Nama Peminjam
                                </div>
                                <div class="info-value">{{ $borrowing->user->name ?? '-' }}</div>
                            </div>
                        </div>

                        <!-- Buku -->
                        <div class="info-item bg-indigo-subtle">
                            <div class="info-icon" style="background:#e0e7ff">
                                <i class="fas fa-book" style="color:var(--indigo); font-size:20px"></i>
                            </div>
                            <div>
                                <div class="info-label text-indigo">
                                    <i class="fas fa-bookmark" style="margin-right:4px"></i>Judul Buku
                                </div>
                                <div class="info-value">{{ $borrowing->book->judul ?? '-' }}</div>
                            </div>
                        </div>

                        <!-- Dates -->
                        <div class="info-grid">
                            <!-- Tanggal Pinjam -->
                            <div class="info-item bg-blue-subtle">
                                <div class="info-icon" style="background:var(--blue-mid)">
                                    <i class="fas fa-calendar-plus" style="color:var(--blue); font-size:16px"></i>
                                </div>
                                <div>
                                    <div class="info-label text-blue">Tanggal Pinjam</div>
                                    <div class="info-value" style="font-size:14px">{{ $borrowing->created_at->format('d M Y') }}</div>
                                    <div class="info-sub">{{ $borrowing->created_at->format('H:i') }} WIB</div>
                                </div>
                            </div>

                            <!-- Tanggal Kembali -->
                            <div class="info-item bg-orange-subtle">
                                <div class="info-icon" style="background:#fed7aa">
                                    <i class="fas fa-calendar-check" style="color:var(--orange); font-size:16px"></i>
                                </div>
                                <div>
                                    <div class="info-label text-orange">Tanggal Kembali</div>
                                    @if($borrowing->returned_at)
                                        <div class="info-value" style="font-size:14px">
                                            {{ \Carbon\Carbon::parse($borrowing->returned_at)->format('d M Y') }}
                                        </div>
                                        <div class="info-sub">{{ \Carbon\Carbon::parse($borrowing->returned_at)->format('H:i') }} WIB</div>
                                    @else
                                        <div class="info-value" style="font-size:14px; color:var(--muted); font-style:italic; font-weight:500">
                                            Belum dikembalikan
                                        </div>
                                        <div class="info-sub">
                                            <i class="fas fa-hourglass-half" style="margin-right:3px"></i>Menunggu
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card">
                <div class="card-head">
                    <div class="card-head-icon" style="background:#f0fdf4">
                        <i class="fas fa-tasks" style="color:var(--green); font-size:15px"></i>
                    </div>
                    <div class="card-head-title">Aksi</div>
                </div>
                <div class="card-body">
                    <div class="actions">
                        <a href="{{ route('admin.borrowings.index') }}" class="btn btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT COL -->
        <div class="right-col">

            <!-- Status Card -->
            <div class="card">
                <div class="card-head">
                    <div class="card-head-icon" style="background:var(--blue-light)">
                        <i class="fas fa-flag" style="color:var(--blue); font-size:14px"></i>
                    </div>
                    <div class="card-head-title">Status Peminjaman</div>
                </div>
                <div class="card-body">
                    @if($borrowing->status === 'approved')
                        <div class="status-display status-approved">
                            <div class="status-circle"><i class="fas fa-check"></i></div>
                            <div class="status-tag">Status</div>
                            <div class="status-name">Disetujui</div>
                            <div class="status-desc">Peminjaman telah disetujui</div>
                        </div>
                    @elseif($borrowing->status === 'returned')
                        <div class="status-display status-returned">
                            <div class="status-circle"><i class="fas fa-check-double"></i></div>
                            <div class="status-tag">Status</div>
                            <div class="status-name">Dikembalikan</div>
                            <div class="status-desc">Buku telah dikembalikan</div>
                        </div>
                    @elseif($borrowing->status === 'rejected')
                        <div class="status-display status-rejected">
                            <div class="status-circle"><i class="fas fa-times"></i></div>
                            <div class="status-tag">Status</div>
                            <div class="status-name">Ditolak</div>
                            <div class="status-desc">Peminjaman ditolak</div>
                        </div>
                    @else
                        <div class="status-display status-pending">
                            <div class="status-circle"><i class="fas fa-hourglass-half"></i></div>
                            <div class="status-tag">Status</div>
                            <div class="status-name">Pending</div>
                            <div class="status-desc">Menunggu persetujuan admin</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Timeline Card -->
            <div class="card">
                <div class="card-head">
                    <div class="card-head-icon" style="background:var(--blue-light)">
                        <i class="fas fa-clock" style="color:var(--blue); font-size:14px"></i>
                    </div>
                    <div class="card-head-title">Timeline</div>
                </div>
                <div class="card-body" style="padding-bottom: 8px;">
                    <div class="timeline">
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--blue-light)">
                                <i class="fas fa-plus" style="color:var(--blue)"></i>
                            </div>
                            <div class="tl-content">
                                <div class="tl-title">Peminjaman dibuat</div>
                                <div class="tl-time">{{ $borrowing->created_at->format('d M Y, H:i') }} WIB</div>
                            </div>
                        </div>

                        @if($borrowing->status === 'approved' || $borrowing->status === 'returned')
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--blue-light)">
                                <i class="fas fa-check" style="color:var(--blue)"></i>
                            </div>
                            <div class="tl-content">
                                <div class="tl-title">Disetujui admin</div>
                                <div class="tl-time">—</div>
                            </div>
                        </div>
                        @endif

                        @if($borrowing->status === 'rejected')
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--red-bg)">
                                <i class="fas fa-times" style="color:var(--red)"></i>
                            </div>
                            <div class="tl-content">
                                <div class="tl-title">Ditolak admin</div>
                                <div class="tl-time">—</div>
                            </div>
                        </div>
                        @endif

                        @if($borrowing->returned_at)
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--green-bg)">
                                <i class="fas fa-book" style="color:var(--green)"></i>
                            </div>
                            <div class="tl-content" style="padding-bottom:4px">
                                <div class="tl-title">Buku dikembalikan</div>
                                <div class="tl-time">{{ \Carbon\Carbon::parse($borrowing->returned_at)->format('d M Y, H:i') }} WIB</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>
</main>

</body>
</html>