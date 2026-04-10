<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Buku | Petugas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --blue: #39eb25; --blue-light: #eff6ff; --blue-mid: #bfdbfe; --indigo: #4f46e5;
            --accent: #16a34a; --accent-light: #dcfce7; --accent-mid: #86efac; --accent-dark: #15803d;
            --surface: #ffffff; --bg: #f4f6fb; --border: #e5e7eb; --text: #111827; --muted: #6b7280;
            --shadow: 0 1px 3px rgba(0,0,0,.07), 0 4px 16px rgba(0,0,0,.05);
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }
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
        /* SIDEBAR */
        aside { width: 260px; background: var(--surface); border-right: 1px solid var(--border); display: flex; flex-direction: column; position: sticky; top: 0; height: 100vh; flex-shrink: 0; }
        .brand { display: flex; align-items: center; gap: 12px; padding: 24px 20px; border-bottom: 1px solid var(--border); }
        .brand-icon { width: 42px; height: 42px; background: linear-gradient(135deg, var(--accent), var(--accent-dark)); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 12px rgba(22,163,74,.25); }
        .brand-icon i { color: #fff; font-size: 18px; }
        .brand-title { font-size: 15px; font-weight: 800; color: var(--text); }
        .brand-sub { font-size: 11px; color: var(--muted); margin-top: 1px; }
        nav { flex: 1; padding: 16px 12px; display: flex; flex-direction: column; gap: 2px; overflow-y: auto; }
        .nav-label { font-size: 10px; font-weight: 700; letter-spacing: .08em; color: var(--muted); text-transform: uppercase; padding: 12px 12px 6px; }
        .nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 10px; font-size: 13.5px; font-weight: 500; color: var(--muted); text-decoration: none; transition: background .15s, color .15s, transform .15s; }
        .nav-link i { width: 18px; text-align: center; font-size: 14px; flex-shrink: 0; }
        .nav-link:hover { background: var(--bg); color: var(--text); transform: translateX(3px); }
        .nav-link.active { background: var(--accent-light); color: var(--accent); font-weight: 600; }
        .sidebar-footer { padding: 12px; border-top: 1px solid var(--border); }
        .logout-btn { width: 100%; display: flex; align-items: center; gap: 10px; padding: 10px 14px; border: none; background: none; border-radius: 10px; font-size: 13.5px; font-weight: 500; color: #ef4444; cursor: pointer; font-family: inherit; transition: background .15s; }
        .logout-btn:hover { background: #fef2f2; }

        /* MAIN */
        main { flex: 1; padding: 36px 40px; overflow-x: hidden; }
        .page-title { font-size: 26px; font-weight: 800; color: var(--text); }
        .page-sub { font-size: 13px; color: var(--muted); margin-top: 4px; margin-bottom: 28px; }

        .back-link { display: inline-flex; align-items: center; gap: 7px; font-size: 13px; font-weight: 600; color: var(--muted); text-decoration: none; margin-bottom: 12px; transition: color .15s; }
        .back-link:hover { color: var(--text); }

        /* Card */
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; box-shadow: var(--shadow); max-width: 860px; }
        .card-head { padding: 18px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 14px; }
        .card-head-icon { width: 40px; height: 40px; border-radius: 11px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
        .card-head-title { font-size: 14px; font-weight: 700; color: var(--text); }
        .card-head-sub { font-size: 12px; color: var(--muted); margin-top: 2px; }
        .card-body { padding: 28px; }

        /* Detail layout */
        .detail-layout { display: grid; grid-template-columns: 200px 1fr; gap: 32px; align-items: start; }

        /* Cover */
        .cover-wrap {
            width: 200px; aspect-ratio: 3/4;
            border-radius: 12px; overflow: hidden;
            background: var(--bg);
            border: 1.5px solid var(--border);
            box-shadow: 0 4px 16px rgba(0,0,0,.08);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .cover-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .cover-placeholder { text-align: center; padding: 24px; }
        .cover-placeholder i { font-size: 40px; color: #d1d5db; display: block; margin-bottom: 8px; }
        .cover-placeholder p { font-size: 12px; color: var(--muted); font-style: italic; }

        /* Info section */
        .book-title { font-size: 22px; font-weight: 800; color: var(--text); line-height: 1.3; margin-bottom: 14px; }

        .badge-row { display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: 20px; }
        .badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 14px; border-radius: 8px; font-size: 12.5px; font-weight: 600; }
        .badge-green { background: var(--accent-light); color: var(--accent); border: 1px solid var(--accent-mid); }
        .badge-purple { background: #f5f3ff; color: #6d28d9; border: 1px solid #c4b5fd; }
        .badge i { font-size: 11px; }

        /* Description box */
        .desc-label { display: flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); margin-bottom: 10px; }
        .desc-label i { color: var(--accent); }
        .desc-box { background: var(--bg); border: 1px solid var(--border); border-radius: 10px; padding: 16px; font-size: 13.5px; line-height: 1.7; color: var(--text); }
        .desc-empty { color: var(--muted); font-style: italic; }

        /* Info grid */
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 16px; }
        .info-item { background: var(--bg); border: 1px solid var(--border); border-radius: 10px; padding: 14px 16px; }
        .info-item-label { font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); margin-bottom: 5px; display: flex; align-items: center; gap: 5px; }
        .info-item-label i { color: var(--accent); }
        .info-item-value { font-size: 14px; font-weight: 600; color: var(--text); }

        /* Stok badge */
        .stok-value { display: inline-flex; align-items: center; gap: 6px; }
        .stok-dot { width: 8px; height: 8px; border-radius: 50%; background: var(--accent); display: inline-block; }
        .stok-dot.empty { background: #ef4444; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<aside>
    <div class="brand">
        <div class="brand-icon"><i class="fas fa-user-shield"></i></div>
        <div>
            <div class="brand-title">Perpustakaan</div>
            <div class="brand-sub">Petugas Panel</div>
        </div>
    </div>
    <nav>
        <div class="nav-label">Menu Utama</div>
        <a href="{{ route('petugas.dashboard') }}" class="nav-link"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ url('petugas/books') }}" class="nav-link active"><i class="fas fa-book"></i> Kelola Buku</a>
        <div class="nav-label">Menu Tambahan</div>
        <a href="{{ route('petugas.borrowings.index') }}" class="nav-link"><i class="fas fa-handshake"></i> Riwayat Peminjaman</a>
    </nav>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>
</aside>

<!-- MAIN -->
<main>
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('petugas.books.index') }}">
            <i class="fas fa-book"></i> Data Buku
        </a>
        <i class="fas fa-chevron-right sep"></i>
        <span>Detail Buku</span>
    </div>
    <div class="page-title">Detail Buku</div>
    <div class="page-sub">Informasi lengkap tentang buku</div>

    <div class="card">
        <div class="card-head">
            <div class="card-head-icon" style="background:var(--accent-light)">
                <i class="fas fa-book-open" style="color:var(--accent)"></i>
            </div>
            <div>
                <div class="card-head-title">Informasi Buku</div>
                <div class="card-head-sub">Data lengkap koleksi perpustakaan</div>
            </div>
        </div>
        <div class="card-body">
            <div class="detail-layout">

                <!-- Cover -->
                <div class="cover-wrap">
                    @if ($book->image)
                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}">
                    @else
                        <div class="cover-placeholder">
                            <i class="fas fa-book"></i>
                            <p>Tidak ada cover</p>
                        </div>
                    @endif
                </div>

                <!-- Info -->
                <div>
                    <div class="book-title">{{ $book->judul }}</div>

                    <div class="badge-row">
                        @if ($book->categories->count() > 0)
                            @foreach($book->categories as $category)
                                <span class="badge badge-green">
                                    <i class="fas fa-tag"></i> {{ $category->nama }}
                                </span>
                            @endforeach
                        @else
                            <span class="badge" style="background:var(--bg);color:var(--muted);border:1px solid var(--border)">
                                <i class="fas fa-exclamation-circle"></i> Tidak ada kategori
                            </span>
                        @endif
                        <span class="badge badge-purple">
                            <i class="fas fa-barcode"></i> {{ $book->kode_buku }}
                        </span>
                    </div>

                    <!-- Deskripsi -->
                    <div class="desc-label"><i class="fas fa-align-left"></i> Deskripsi Buku</div>
                    <div class="desc-box">
                        @if ($book->deskripsi)
                            {{ $book->deskripsi }}
                        @else
                            <span class="desc-empty">Tidak ada deskripsi buku.</span>
                        @endif
                    </div>

                    <!-- Info Grid -->
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-item-label"><i class="fas fa-user-edit"></i> Penulis</div>
                            <div class="info-item-value">{{ $book->penulis }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label"><i class="fas fa-building"></i> Penerbit</div>
                            <div class="info-item-value">{{ $book->penerbit }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label"><i class="fas fa-calendar"></i> Tahun Terbit</div>
                            <div class="info-item-value">{{ $book->tahun }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-label"><i class="fas fa-layer-group"></i> Stok Tersedia</div>
                            <div class="info-item-value">
                                <span class="stok-value">
                                    <span class="stok-dot {{ $book->stok == 0 ? 'empty' : '' }}"></span>
                                    {{ $book->stok }} Unit
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>