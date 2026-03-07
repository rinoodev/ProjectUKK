<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Buku | Petugas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --accent: #16a34a; --accent-light: #dcfce7; --accent-mid: #86efac; --accent-dark: #15803d;
            --blue: #2563eb; --blue-light: #eff6ff; --blue-mid: #bfdbfe; --indigo: #4f46e5;
            --surface: #ffffff; --bg: #f4f6fb; --border: #e5e7eb; --text: #111827; --muted: #6b7280;
            --yellow: #b45309; --yellow-bg: #fef3c7;
            --red: #dc2626; --red-bg: #fee2e2;
            --shadow: 0 1px 3px rgba(0,0,0,.07), 0 4px 16px rgba(0,0,0,.05);
        }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }

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

        .page-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 28px; gap: 16px; flex-wrap: wrap; }
        .page-title { font-size: 26px; font-weight: 800; color: var(--text); }
        .page-sub { font-size: 13px; color: var(--muted); margin-top: 4px; }

        /* Buttons */
        .btn-add {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 10px 18px; background: var(--accent); color: #fff;
            border-radius: 10px; font-size: 13px; font-weight: 700;
            text-decoration: none; border: none; cursor: pointer; font-family: inherit;
            box-shadow: 0 2px 8px rgba(22,163,74,.25);
            transition: background .12s, transform .1s, box-shadow .15s;
            white-space: nowrap;
        }
        .btn-add:hover { background: var(--accent-dark); transform: translateY(-1px); box-shadow: 0 4px 14px rgba(22,163,74,.3); }
        .btn-add:active { transform: translateY(0); }

        /* Card */
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; box-shadow: var(--shadow); }
        .card-head { padding: 16px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap; }
        .card-title { font-size: 14px; font-weight: 700; }
        .card-count { font-size: 12px; color: var(--muted); }

        /* Search */
        .search-wrap { position: relative; }
        .search-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: 13px; pointer-events: none; }
        .search-wrap input { padding: 8px 14px 8px 34px; border: 1px solid var(--border); border-radius: 8px; font-size: 13px; font-family: inherit; color: var(--text); background: var(--bg); outline: none; width: 220px; transition: border .15s; }
        .search-wrap input:focus { border-color: var(--accent); background: #fff; }

        /* Table */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 900px; }
        thead tr { background: #f9fafb; border-bottom: 1px solid var(--border); }
        th { padding: 11px 14px; font-size: 10.5px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--muted); text-align: left; white-space: nowrap; }
        th:last-child { text-align: center; }
        td { padding: 12px 14px; font-size: 13px; vertical-align: middle; border-bottom: 1px solid #f3f4f6; }
        tbody tr { transition: background .12s; }
        tbody tr:hover { background: #f0fdf4; }
        tbody tr:last-child td { border-bottom: none; }

        /* ISBN pill */
        .isbn-pill { font-family: 'Courier New', monospace; font-size: 11.5px; font-weight: 700; color: var(--indigo); background: #eef2ff; border: 1px solid #c7d2fe; padding: 3px 8px; border-radius: 6px; white-space: nowrap; }

        /* Cover thumbnail */
        .cover-thumb { width: 36px; height: 46px; border-radius: 5px; overflow: hidden; background: #f3f4f6; display: flex; align-items: center; justify-content: center; box-shadow: 0 1px 4px rgba(0,0,0,.1); flex-shrink: 0; }
        .cover-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .cover-thumb i { color: #d1d5db; font-size: 14px; }

        /* Book title cell */
        .book-title { font-weight: 600; color: var(--text); max-width: 160px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        /* Category badge */
        .badge-cat { display: inline-flex; align-items: center; gap: 4px; padding: 3px 9px; border-radius: 20px; font-size: 11px; font-weight: 600; background: var(--blue-light); color: var(--blue); white-space: nowrap; }

        /* Stock badge */
        .badge-stock { display: inline-flex; align-items: center; gap: 4px; padding: 3px 9px; border-radius: 20px; font-size: 11.5px; font-weight: 700; white-space: nowrap; }
        .stock-ok   { background: var(--accent-light); color: var(--accent); }
        .stock-low  { background: var(--yellow-bg);    color: var(--yellow); }
        .stock-out  { background: var(--red-bg);        color: var(--red); }

        /* Truncated text */
        .text-trunc { color: var(--muted); max-width: 140px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: block; font-size: 12.5px; }
        .text-empty { color: #9ca3af; font-style: italic; font-size: 12px; }

        /* Action buttons */
        .action-cell { display: flex; align-items: center; justify-content: center; gap: 4px; }
        .btn-icon {
            display: inline-flex; align-items: center; justify-content: center;
            width: 30px; height: 30px;
            border-radius: 8px; border: none; cursor: pointer;
            font-size: 12px; text-decoration: none;
            transition: background .12s, transform .1s;
            font-family: inherit;
        }
        .btn-icon:hover { transform: translateY(-1px); }
        .btn-icon:active { transform: translateY(0); }
        .btn-view   { background: var(--blue-light); color: var(--blue); }
        .btn-view:hover   { background: var(--blue-mid); }
        .btn-edit   { background: var(--accent-light); color: var(--accent); }
        .btn-edit:hover   { background: var(--accent-mid); }
        .btn-delete { background: var(--red-bg); color: var(--red); }
        .btn-delete:hover { background: #fecaca; }

        /* Empty state */
        .empty-state { padding: 56px 20px; text-align: center; }
        .empty-state i { font-size: 40px; color: #d1d5db; margin-bottom: 12px; display: block; }
        .empty-state p { color: var(--muted); font-size: 14px; }

        /* Footer */
        .card-footer { padding: 14px 24px; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; font-size: 13px; color: var(--muted); }
        .pager { display: flex; gap: 4px; }
        .pager-btn { width: 32px; height: 32px; border: 1px solid var(--border); border-radius: 7px; background: none; font-size: 12px; font-family: inherit; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background .12s, border .12s, color .12s; color: var(--muted); }
        .pager-btn:hover:not(:disabled) { border-color: var(--accent); color: var(--accent); background: var(--accent-light); }
        .pager-btn.active { background: var(--accent); border-color: var(--accent); color: #fff; }
        .pager-btn:disabled { opacity: .35; cursor: not-allowed; }
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
        <a href="#" class="nav-link"><i class="fas fa-file-download"></i> Generate Laporan</a>
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
    <div class="page-header">
        <div>
            <div class="page-title">Kelola Buku</div>
            <div class="page-sub">Kelola koleksi buku perpustakaan</div>
        </div>
        <a href="{{ route('petugas.books.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Buku
        </a>
    </div>

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

        <div class="table-wrap">
            <table id="bookTable">
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
                        <td><span class="isbn-pill">{{ $book->kode_buku }}</span></td>

                        <td>
                            <div class="cover-thumb">
                                @if($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->judul }}">
                                @else
                                    <i class="fas fa-book"></i>
                                @endif
                            </div>
                        </td>

                        <td>
                            <span class="book-title" title="{{ $book->judul }}">{{ Str::limit($book->judul, 30) }}</span>
                        </td>

                        <td>
                            @if($book->category)
                                <span class="badge-cat"><i class="fas fa-tag" style="font-size:9px"></i>{{ $book->category->nama }}</span>
                            @else
                                <span class="text-empty">—</span>
                            @endif
                        </td>

                        <td><span class="text-trunc" title="{{ $book->penulis }}">{{ Str::limit($book->penulis, 22) }}</span></td>
                        <td><span class="text-trunc" title="{{ $book->penerbit }}">{{ Str::limit($book->penerbit, 22) }}</span></td>
                        <td style="color:var(--muted); font-size:13px">{{ $book->tahun }}</td>

                        <td>
                            @if($book->stok > 5)
                                <span class="badge-stock stock-ok"><i class="fas fa-layer-group" style="font-size:10px"></i>{{ $book->stok }}</span>
                            @elseif($book->stok > 0)
                                <span class="badge-stock stock-low"><i class="fas fa-layer-group" style="font-size:10px"></i>{{ $book->stok }}</span>
                            @else
                                <span class="badge-stock stock-out"><i class="fas fa-layer-group" style="font-size:10px"></i>{{ $book->stok }}</span>
                            @endif
                        </td>

                        <td>
                            @if($book->deskripsi)
                                <span class="text-trunc" title="{{ $book->deskripsi }}">{{ Str::limit($book->deskripsi, 40) }}</span>
                            @else
                                <span class="text-empty">Tidak ada deskripsi</span>
                            @endif
                        </td>

                        <td>
                            <div class="action-cell">
                                <a href="{{ route('petugas.books.show', $book->id) }}" class="btn-icon btn-view" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('petugas.books.edit', $book->id) }}" class="btn-icon btn-edit" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form method="POST" action="{{ route('petugas.books.destroy', $book->id) }}" style="display:inline"
                                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" title="Hapus">
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
            <span id="pagerInfo">Menampilkan data</span>
            <div class="pager" id="pagerBtns"></div>
        </div>
    </div>
</main>

<script>
const PER_PAGE = 15;
let currentPage = 1;
let allRows = [];

document.addEventListener('DOMContentLoaded', () => {
    allRows = Array.from(document.querySelectorAll('#bookTable tbody tr'));
    renderPage();
});

function renderPage() {
    const q = (document.querySelector('.search-wrap input')?.value || '').toLowerCase();
    const filtered = allRows.filter(r => q === '' || r.textContent.toLowerCase().includes(q));
    const total = filtered.length;
    const totalPages = Math.max(1, Math.ceil(total / PER_PAGE));
    if (currentPage > totalPages) currentPage = totalPages;
    const start = (currentPage - 1) * PER_PAGE;
    const end = Math.min(start + PER_PAGE, total);

    allRows.forEach(r => r.style.display = 'none');
    filtered.forEach((r, i) => { r.style.display = (i >= start && i < end) ? '' : 'none'; });

    document.getElementById('pagerInfo').textContent =
        total === 0 ? 'Tidak ada data' :
        'Menampilkan ' + (start + 1) + '\u2013' + end + ' dari ' + total + ' buku';

    buildPager(totalPages);
}

function buildPager(total) {
    const wrap = document.getElementById('pagerBtns');
    wrap.innerHTML = '';
    const mkBtn = (html, enabled, onClick, extraClass) => {
        const b = document.createElement('button');
        b.className = 'pager-btn' + (extraClass ? ' ' + extraClass : '');
        b.innerHTML = html;
        b.disabled = !enabled;
        if (enabled) b.addEventListener('click', () => { onClick(); renderPage(); });
        return b;
    };
    wrap.appendChild(mkBtn('<i class="fas fa-chevron-left"></i>', currentPage > 1, () => currentPage--));
    for (let p = 1; p <= total; p++) {
        if (total > 7 && Math.abs(p - currentPage) > 1 && p !== 1 && p !== total) {
            if (p === 2 || p === total - 1) {
                const d = document.createElement('span');
                d.textContent = '…';
                d.style.cssText = 'display:flex;align-items:center;padding:0 3px;color:var(--muted);font-size:13px';
                wrap.appendChild(d);
            }
            continue;
        }
        wrap.appendChild(mkBtn(p, true, (pg => () => currentPage = pg)(p), p === currentPage ? 'active' : ''));
    }
    wrap.appendChild(mkBtn('<i class="fas fa-chevron-right"></i>', currentPage < total, () => currentPage++));
}

function filterTable(val) { currentPage = 1; renderPage(); }
</script>
</body>
</html>