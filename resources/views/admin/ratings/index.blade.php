<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Ulasan | Admin</title>
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
            --amber: #d97706;
            --amber-bg: #fef3c7;
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
            flex-wrap: wrap;
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

        /* Alert */
        .alert-success {
            margin-bottom: 20px;
            padding: 12px 16px;
            background: var(--green-bg);
            border: 1px solid #bbf7d0;
            color: var(--green);
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

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

        /* User cell */
        .user-cell {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .user-avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
        }

        .user-name {
            font-weight: 600;
            color: var(--text);
            white-space: nowrap;
            max-width: 130px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Book title */
        .book-title-cell {
            font-weight: 500;
            color: var(--text);
            max-width: 160px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Star rating */
        .star-rating {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .star-5 { background: #fef3c7; color: #b45309; }
        .star-4 { background: #fefce8; color: #a16207; }
        .star-3 { background: #f0fdf4; color: #166534; }
        .star-2 { background: #fff7ed; color: #9a3412; }
        .star-1 { background: var(--red-bg); color: var(--red); }

        .stars-visual {
            display: flex;
            gap: 1px;
        }
        .stars-visual i { font-size: 10px; }
        .star-filled { color: #f59e0b; }
        .star-empty { color: #d1d5db; }

        /* Review text */
        .review-text {
            color: var(--muted);
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-style: italic;
            font-size: 12.5px;
        }

        /* Date */
        .date-cell {
            color: var(--muted);
            font-size: 12.5px;
            white-space: nowrap;
        }

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

        .pagination-links { display: flex; gap: 4px; align-items: center; }
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
        <a href="{{ route('admin.borrowings.index') }}" class="nav-link">
            <i class="fas fa-handshake"></i> Riwayat Peminjaman
        </a>
        <a href="{{ route('admin.ratings.index') }}" class="nav-link active">
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
            <div class="page-title">Ulasan Buku</div>
            <div class="page-sub">Kelola ulasan dan rating dari pengguna</div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Card -->
    <div class="card">
        <div class="card-head">
            <div>
                <span class="card-title">Daftar Ulasan</span>
                <span class="card-count">&nbsp;— {{ $ratings->total() }} ulasan</span>
            </div>
            <div class="search-wrap">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari user atau judul buku…" oninput="filterTable(this.value)">
            </div>
        </div>

        <div style="overflow-x:auto">
            <table id="mainTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Buku</th>
                        <th>Rating</th>
                        <th>Ulasan</th>
                        <th>Tanggal</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ratings as $index => $rating)
                    <tr>
                        <td style="color:var(--muted); font-weight:600; font-size:12px">
                            {{ $ratings->firstItem() + $index }}
                        </td>

                        <td>
                            <div class="user-cell">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($rating->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <span class="user-name">{{ $rating->user->name ?? '-' }}</span>
                            </div>
                        </td>

                        <td>
                            <span class="book-title-cell">{{ $rating->book->judul ?? '-' }}</span>
                        </td>

                        <td>
                            @php $r = (int) $rating->rating; @endphp
                            <div style="display:flex; flex-direction:column; gap:3px;">
                                <span class="star-rating star-{{ $r }}">
                                    <i class="fas fa-star" style="font-size:10px"></i>
                                    {{ $rating->rating }}
                                </span>
                                <div class="stars-visual">
                                    @for($s = 1; $s <= 5; $s++)
                                        <i class="fas fa-star {{ $s <= $r ? 'star-filled' : 'star-empty' }}"></i>
                                    @endfor
                                </div>
                            </div>
                        </td>

                        <td>
                            @if($rating->ulasan)
                                <span class="review-text">{{ Str::limit($rating->ulasan, 50) }}</span>
                            @else
                                <span style="color:#d1d5db; font-size:12px; font-style:italic">Tidak ada</span>
                            @endif
                        </td>

                        <td>
                            <span class="date-cell">
                                <i class="fas fa-calendar-alt" style="font-size:10px; margin-right:4px; color:#d1d5db"></i>
                                {{ $rating->created_at->format('d M Y') }}
                            </span>
                        </td>

                        <td>
                            <div class="action-cell">
                                <a href="{{ route('admin.ratings.show', $rating->id) }}" class="btn-action btn-detail" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.ratings.destroy', $rating->id) }}" style="display:inline"
                                      onsubmit="return confirm('Hapus ulasan ini?')">
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
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-star"></i>
                                <p>Belum ada ulasan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <span>Menampilkan {{ $ratings->count() }} dari {{ $ratings->total() }} ulasan</span>
            <div class="pagination-links">
                {{ $ratings->links() }}
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