<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku | Admin</title>
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
            --yellow: #b45309;
            --yellow-bg: #fef3c7;
            --red: #dc2626;
            --red-bg: #fee2e2;
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
            overflow-x: hidden;
        }

        .page-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 28px;
            gap: 16px;
            flex-wrap: wrap;
        }

        .page-title { font-size: 26px; font-weight: 800; color: var(--text); }
        .page-sub { font-size: 13px; color: var(--muted); margin-top: 4px; }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--blue);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            text-decoration: none;
            transition: background .15s, transform .1s, box-shadow .15s;
            box-shadow: 0 2px 8px rgba(37,99,235,.25);
            white-space: nowrap;
        }

        .btn-add:hover { background: #1d4ed8; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(37,99,235,.35); }
        .btn-add:active { transform: translateY(0); }

        /* Card */
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
            gap: 12px;
        }

        .card-title { font-size: 14px; font-weight: 700; }
        .card-count { font-size: 12px; color: var(--muted); }

        /* Search */
        .search-wrap { position: relative; }
        .search-wrap i {
            position: absolute;
            left: 12px; top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 13px;
            pointer-events: none;
        }
        .search-wrap input {
            padding: 8px 14px 8px 34px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 13px;
            font-family: inherit;
            color: var(--text);
            background: var(--bg);
            outline: none;
            width: 220px;
            transition: border .15s;
        }
        .search-wrap input:focus { border-color: var(--blue); background: #fff; }

        /* Table */
        table { width: 100%; border-collapse: collapse; }

        thead tr {
            background: #f9fafb;
            border-bottom: 1px solid var(--border);
        }

        th {
            padding: 12px 16px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--muted);
            text-align: left;
            white-space: nowrap;
        }

        th:last-child { text-align: center; }

        td {
            padding: 12px 16px;
            font-size: 13px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
        }

        tbody tr { transition: background .12s; }
        tbody tr:hover { background: #fafbff; }
        tbody tr:last-child td { border-bottom: none; }

        /* ISBN pill */
        .isbn-pill {
            font-family: 'Courier New', monospace;
            font-size: 11.5px;
            font-weight: 600;
            background: var(--bg);
            border: 1px solid var(--border);
            padding: 3px 8px;
            border-radius: 6px;
            color: var(--indigo);
            white-space: nowrap;
        }

        /* Cover */
        .book-cover {
            width: 38px; height: 50px;
            border-radius: 6px;
            overflow: hidden;
            background: var(--bg);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(0,0,0,.08);
        }

        .book-cover img { width: 100%; height: 100%; object-fit: cover; }
        .book-cover i { color: #d1d5db; font-size: 16px; }

        /* Book title cell */
        .book-title {
            font-weight: 600;
            color: var(--text);
            max-width: 180px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .book-desc {
            color: var(--muted);
            max-width: 160px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-style: italic;
            font-size: 12.5px;
        }

        /* Category badge */
        .cat-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            background: var(--blue-light);
            color: var(--blue);
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
            white-space: nowrap;
        }

        /* Stock badge */
        .stock-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
        }

        .stock-ok { background: var(--green-bg); color: var(--green); }
        .stock-low { background: var(--yellow-bg); color: var(--yellow); }
        .stock-empty { background: var(--red-bg); color: var(--red); }

        /* Action buttons */
        .action-cell { display: flex; align-items: center; justify-content: center; gap: 5px; }

        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px; height: 30px;
            border-radius: 8px;
            font-size: 12px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-family: inherit;
            transition: background .12s, transform .1s;
        }

        .btn-action:hover { transform: translateY(-1px); }
        .btn-action:active { transform: translateY(0); }

        .btn-detail { background: var(--blue-light); color: var(--blue); }
        .btn-detail:hover { background: var(--blue-mid); }

        .btn-edit { background: var(--yellow-bg); color: var(--yellow); }
        .btn-edit:hover { background: #fde68a; }

        .btn-delete { background: var(--red-bg); color: var(--red); }
        .btn-delete:hover { background: #fecaca; }

        /* Empty state */
        .empty-state { padding: 60px 20px; text-align: center; }
        .empty-state i { font-size: 40px; color: #d1d5db; margin-bottom: 12px; display: block; }
        .empty-state p { color: var(--muted); font-size: 14px; }

        /* Footer */
        .card-footer {
            padding: 14px 24px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            color: var(--muted);
        }

        .pager { display: flex; gap: 4px; }
        .pager-btn {
            width: 32px; height: 32px;
            border: 1px solid var(--border);
            border-radius: 7px;
            background: none;
            font-size: 12px;
            font-family: inherit;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            transition: background .12s, border .12s, color .12s;
            color: var(--muted);
        }
        .pager-btn:hover { border-color: var(--blue); color: var(--blue); }
        .pager-btn.active { background: var(--blue); border-color: var(--blue); color: #fff; }
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
        <a href="{{ url('/admin/books') }}" class="nav-link active">
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
        <div>
            <div class="page-title">Data Buku</div>
            <div class="page-sub">Kelola koleksi buku perpustakaan</div>
        </div>
        <a href="{{ route('admin.books.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Buku
        </a>
    </div>

    <!-- Table Card -->
    <div class="card">
        <div class="card-head">
            <div>
                <span class="card-title">Daftar Buku</span>
                <span class="card-count">&nbsp;— {{ $books->count() }} buku</span>
            </div>
            <div class="search-wrap">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari judul atau penulis…" oninput="filterTable(this.value)">
            </div>
        </div>

        <div style="overflow-x:auto">
            <table id="mainTable">
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Deskripsi</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                    <tr>
                        <td>
                            <span class="isbn-pill">{{ $book->kode_buku }}</span>
                        </td>

                        <td>
                            <div class="book-cover">
                                @if($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}">
                                @else
                                    <i class="fas fa-book"></i>
                                @endif
                            </div>
                        </td>

                        <td>
                            <span class="book-title">{{ Str::limit($book->judul, 35) }}</span>
                        </td>

                        <td>
                            @if($book->categories->count() > 0)
                                <div style="display: flex; flex-wrap: wrap; gap: 4px;">
                                    @foreach($book->categories as $category)
                                        <span class="cat-badge">
                                            <i class="fas fa-tag" style="font-size:10px"></i>
                                            {{ $category->nama }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span style="color:var(--muted); font-size:12px">—</span>
                            @endif
                        </td>

                        <td style="color:var(--muted); max-width:140px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis">
                            {{ Str::limit($book->penulis, 22) }}
                        </td>

                        <td style="color:var(--muted); max-width:130px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis">
                            {{ Str::limit($book->penerbit, 20) }}
                        </td>

                        <td style="color:var(--muted); font-weight:600; white-space:nowrap">
                            {{ $book->tahun }}
                        </td>

                        <td>
                            @if($book->stok > 5)
                                <span class="stock-badge stock-ok">
                                    <i class="fas fa-layer-group" style="font-size:10px"></i>
                                    {{ $book->stok }}
                                </span>
                            @elseif($book->stok > 0)
                                <span class="stock-badge stock-low">
                                    <i class="fas fa-layer-group" style="font-size:10px"></i>
                                    {{ $book->stok }}
                                </span>
                            @else
                                <span class="stock-badge stock-empty">
                                    <i class="fas fa-times" style="font-size:10px"></i>
                                    Habis
                                </span>
                            @endif
                        </td>

                        <td>
                            @if($book->deskripsi)
                                <span class="book-desc">{{ Str::limit($book->deskripsi, 45) }}</span>
                            @else
                                <span style="color:#d1d5db; font-size:12px; font-style:italic">Tidak ada</span>
                            @endif
                        </td>

                        <td>
                            <div class="action-cell">
                                <a href="{{ route('admin.books.show', $book->id) }}" class="btn-action btn-detail" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn-action btn-edit" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.books.destroy', $book) }}" style="display:inline"
                                      onsubmit="return confirm('Yakin hapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10">
                            <div class="empty-state">
                                <i class="fas fa-book-open"></i>
                                <p>Belum ada data buku</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <span>Menampilkan {{ $books->count() }} buku</span>
            <div class="pager">
                <button class="pager-btn"><i class="fas fa-chevron-left"></i></button>
                <button class="pager-btn active">1</button>
                <button class="pager-btn">2</button>
                <button class="pager-btn"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

</main>

<script>
function filterTable(val) {
    const rows = document.querySelectorAll('#mainTable tbody tr');
    const q = val.toLowerCase();
    rows.forEach(r => {
        r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}
</script>

</body>
</html>