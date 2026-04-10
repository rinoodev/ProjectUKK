<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Buku | Admin</title>
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
            --purple: #7c3aed;
            --purple-bg: #f5f3ff;
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

        /* Main card */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        .card-head {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-head-icon {
            width: 38px; height: 38px;
            background: var(--blue-light);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .card-head-icon i { color: var(--blue); font-size: 16px; }
        .card-head-title { font-size: 14px; font-weight: 700; }
        .card-head-sub { font-size: 12px; color: var(--muted); margin-top: 1px; }

        /* Book layout */
        .book-layout {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 32px;
            padding: 28px 24px;
        }

        /* Cover */
        .cover-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .cover-img {
            width: 180px;
            height: 250px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-md);
            background: #f3f4f6;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .cover-img img { width: 100%; height: 100%; object-fit: cover; }

        .cover-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            color: #9ca3af;
        }

        .cover-placeholder i { font-size: 40px; }
        .cover-placeholder span { font-size: 11px; }

        /* Stock badge */
        .stock-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12.5px;
            font-weight: 700;
        }

        .stock-ok { background: var(--green-bg); color: var(--green); }
        .stock-low { background: var(--yellow-bg); color: var(--yellow); }
        .stock-empty { background: #fee2e2; color: var(--red); }

        /* Right info */
        .book-info { display: flex; flex-direction: column; gap: 20px; }

        .book-title-section { }
        .book-title-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); margin-bottom: 4px; }
        .book-title { font-size: 22px; font-weight: 800; color: var(--text); line-height: 1.3; }

        /* Tag pills row */
        .pills-row { display: flex; flex-wrap: wrap; gap: 10px; }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 600;
            border: 1px solid;
        }

        .pill-blue { background: var(--blue-light); color: var(--blue); border-color: var(--blue-mid); }
        .pill-purple { background: var(--purple-bg); color: var(--purple); border-color: #ddd6fe; font-family: 'Courier New', monospace; }

        /* Description */
        .desc-box {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px 18px;
        }

        .desc-box-label {
            display: flex;
            align-items: center;
            gap: 7px;
            font-size: 12px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: 10px;
        }

        .desc-box-label i { color: var(--blue); }

        .desc-text {
            font-size: 13.5px;
            color: #374151;
            line-height: 1.7;
        }

        .desc-empty {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #9ca3af;
            font-style: italic;
        }

        /* Info grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .info-tile {
            padding: 14px 16px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: box-shadow .15s;
        }

        .info-tile:hover { box-shadow: var(--shadow); }

        .info-tile-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: var(--muted);
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .info-tile-label i { color: var(--blue); font-size: 11px; }
        .info-tile-value { font-size: 14px; font-weight: 700; color: var(--text); }

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
        <a href="{{ route('admin.books.index') }}" class="nav-link active">
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

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('admin.books.index') }}">
            <i class="fas fa-book"></i> Data Buku
        </a>
        <i class="fas fa-chevron-right sep"></i>
        <span>Detail Buku</span>
    </div>

    <div class="page-title">Detail Buku</div>
    <div class="page-sub">Informasi lengkap tentang buku</div>

    <div class="card">

        <!-- Card Head -->
        <div class="card-head">
            <div class="card-head-icon">
                <i class="fas fa-book"></i>
            </div>
            <div>
                <div class="card-head-title">Informasi Buku</div>
                <div class="card-head-sub">ID: #{{ $book->id }}</div>
            </div>
        </div>

        <!-- Book Layout -->
        <div class="book-layout">

            <!-- Cover Column -->
            <div class="cover-wrap">
                <div class="cover-img">
                    @if($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}">
                    @else
                        <div class="cover-placeholder">
                            <i class="fas fa-book"></i>
                            <span>Tidak ada cover</span>
                        </div>
                    @endif
                </div>

                @php $stok = $book->stok; @endphp
                @if($stok > 5)
                    <span class="stock-badge stock-ok"><i class="fas fa-check-circle"></i> {{ $stok }} Unit</span>
                @elseif($stok > 0)
                    <span class="stock-badge stock-low"><i class="fas fa-exclamation-circle"></i> {{ $stok }} Unit</span>
                @else
                    <span class="stock-badge stock-empty"><i class="fas fa-times-circle"></i> Habis</span>
                @endif
            </div>

            <!-- Info Column -->
            <div class="book-info">

                <!-- Title -->
                <div class="book-title-section">
                    <div class="book-title-label">Judul Buku</div>
                    <div class="book-title">{{ $book->judul }}</div>
                </div>

                <!-- Pills: Kategori + ISBN -->
                <div class="pills-row">
                    @if($book->categories->count() > 0)
                        @foreach($book->categories as $category)
                            <span class="pill pill-blue">
                                <i class="fas fa-tag"></i> {{ $category->nama }}
                            </span>
                        @endforeach
                    @else
                        <span class="pill" style="background:#f9fafb; color:var(--muted); border-color:var(--border)">
                            <i class="fas fa-exclamation-circle"></i> Tanpa Kategori
                        </span>
                    @endif
                    <span class="pill pill-purple">
                        <i class="fas fa-barcode"></i> {{ $book->kode_buku }}
                    </span>
                </div>

                <!-- Description -->
                <div class="desc-box">
                    <div class="desc-box-label">
                        <i class="fas fa-align-left"></i> Deskripsi Buku
                    </div>
                    @if($book->deskripsi)
                        <p class="desc-text">{{ $book->deskripsi }}</p>
                    @else
                        <div class="desc-empty">
                            <i class="fas fa-info-circle"></i> Tidak ada deskripsi buku
                        </div>
                    @endif
                </div>

                <!-- Info Grid -->
                <div class="info-grid">
                    <div class="info-tile">
                        <div class="info-tile-label"><i class="fas fa-user-edit"></i> Penulis</div>
                        <div class="info-tile-value">{{ $book->penulis }}</div>
                    </div>
                    <div class="info-tile">
                        <div class="info-tile-label"><i class="fas fa-building"></i> Penerbit</div>
                        <div class="info-tile-value">{{ $book->penerbit }}</div>
                    </div>
                    <div class="info-tile">
                        <div class="info-tile-label"><i class="fas fa-calendar"></i> Tahun Terbit</div>
                        <div class="info-tile-value">{{ $book->tahun }}</div>
                    </div>
                    <div class="info-tile">
                        <div class="info-tile-label"><i class="fas fa-layer-group"></i> Stok Tersedia</div>
                        <div class="info-tile-value">{{ $book->stok }} Unit</div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Card Footer -->
        <div class="card-footer">
            <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-edit">
                <i class="fas fa-edit"></i> Edit Buku
            </a>
            <a href="{{ route('admin.books.index') }}" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

    </div>

</main>

</body>
</html>