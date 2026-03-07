<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Kategori | Admin</title>
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
            --yellow: #d97706;
            --yellow-bg: #fffbeb;
            --shadow: 0 1px 3px rgba(0,0,0,.07), 0 4px 16px rgba(0,0,0,.05);
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

        .page-title { font-size: 26px; font-weight: 800; color: var(--text); }
        .page-sub { font-size: 13px; color: var(--muted); margin-top: 4px; margin-bottom: 28px; }

        /* Card */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
            max-width: 680px;
        }

        .card-head {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .card-head-icon {
            width: 46px; height: 46px;
            background: var(--blue-light);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .card-head-icon i { color: var(--blue); font-size: 20px; }

        .card-head-name { font-size: 16px; font-weight: 800; color: var(--text); }
        .card-head-slug {
            font-size: 12px;
            color: var(--muted);
            font-family: 'Courier New', monospace;
            background: var(--bg);
            padding: 2px 8px;
            border-radius: 5px;
            border: 1px solid var(--border);
            display: inline-block;
            margin-top: 4px;
        }

        /* Info rows */
        .info-table { width: 100%; }

        .info-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px 24px;
            border-bottom: 1px solid #f3f4f6;
            transition: background .12s;
        }

        .info-row:last-child { border-bottom: none; }
        .info-row:hover { background: #fafbff; }

        .info-row-icon {
            width: 36px; height: 36px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-size: 14px;
        }

        .info-row-label {
            width: 160px;
            flex-shrink: 0;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--muted);
        }

        .info-row-value {
            flex: 1;
            font-size: 14px;
            font-weight: 600;
            color: var(--text);
        }

        .slug-pill {
            font-family: 'Courier New', monospace;
            font-size: 13px;
            font-weight: 500;
            background: var(--bg);
            border: 1px solid var(--border);
            padding: 4px 10px;
            border-radius: 6px;
            color: var(--indigo);
        }

        .date-val { display: flex; align-items: center; gap: 8px; }
        .date-time {
            font-size: 12px;
            font-weight: 500;
            color: var(--muted);
            background: var(--bg);
            border: 1px solid var(--border);
            padding: 2px 8px;
            border-radius: 5px;
        }

        /* Footer */
        .card-footer {
            padding: 18px 24px;
            border-top: 1px solid var(--border);
            background: #fafbff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

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

        .btn-edit {
            background: var(--yellow);
            color: #fff;
            box-shadow: 0 2px 8px rgba(217,119,6,.25);
        }
        .btn-edit:hover { background: #b45309; box-shadow: 0 4px 14px rgba(217,119,6,.3); }

        .btn-back {
            background: var(--bg);
            color: var(--text);
            border: 1.5px solid var(--border);
        }
        .btn-back:hover { background: #eaecf1; }
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
        <a href="{{ route('admin.categories.index') }}" class="nav-link active">
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

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('admin.categories.index') }}">
            <i class="fas fa-tags"></i> Kategori Buku
        </a>
        <i class="fas fa-chevron-right sep"></i>
        <span>Detail Kategori</span>
    </div>

    <div class="page-title">Detail Kategori</div>
    <div class="page-sub">Informasi lengkap kategori buku</div>

    <div class="card">

        <!-- Card Header -->
        <div class="card-head">
            <div class="card-head-icon">
                <i class="fas fa-tag"></i>
            </div>
            <div>
                <div class="card-head-name">{{ $category->nama }}</div>
                <span class="card-head-slug">{{ $category->slug }}</span>
            </div>
        </div>

        <!-- Info Rows -->
        <div class="info-table">

            <div class="info-row">
                <div class="info-row-icon" style="background:var(--blue-light)">
                    <i class="fas fa-tag" style="color:var(--blue)"></i>
                </div>
                <div class="info-row-label">Nama Kategori</div>
                <div class="info-row-value">{{ $category->nama }}</div>
            </div>

            <div class="info-row">
                <div class="info-row-icon" style="background:#eef2ff">
                    <i class="fas fa-link" style="color:var(--indigo)"></i>
                </div>
                <div class="info-row-label">Slug</div>
                <div class="info-row-value">
                    <span class="slug-pill">{{ $category->slug }}</span>
                </div>
            </div>

            <div class="info-row">
                <div class="info-row-icon" style="background:#f0fdf4">
                    <i class="fas fa-calendar-plus" style="color:#16a34a"></i>
                </div>
                <div class="info-row-label">Tanggal Dibuat</div>
                <div class="info-row-value">
                    <div class="date-val">
                        {{ $category->created_at->format('d M Y') }}
                        <span class="date-time">{{ $category->created_at->format('H:i') }} WIB</span>
                    </div>
                </div>
            </div>

            <div class="info-row">
                <div class="info-row-icon" style="background:#fffbeb">
                    <i class="fas fa-clock" style="color:var(--yellow)"></i>
                </div>
                <div class="info-row-label">Terakhir Diupdate</div>
                <div class="info-row-value">
                    <div class="date-val">
                        {{ $category->updated_at->format('d M Y') }}
                        <span class="date-time">{{ $category->updated_at->format('H:i') }} WIB</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <div class="card-footer">
            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-edit">
                <i class="fas fa-edit"></i> Edit Kategori
            </a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</main>
</body>
</html>