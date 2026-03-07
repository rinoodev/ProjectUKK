<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.31/jspdf.plugin.autotable.min.js"></script>
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
            --shadow: 0 1px 3px rgba(0,0,0,.07), 0 4px 16px rgba(0,0,0,.05);
        }

        body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--text); display: flex; min-height: 100vh; }

        aside { width: var(--sidebar-w); background: var(--surface); border-right: 1px solid var(--border); display: flex; flex-direction: column; position: sticky; top: 0; height: 100vh; flex-shrink: 0; }
        .brand { display: flex; align-items: center; gap: 12px; padding: 24px 20px; border-bottom: 1px solid var(--border); }
        .brand-icon { width: 42px; height: 42px; background: linear-gradient(135deg, var(--blue), var(--indigo)); border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 12px rgba(79,70,229,.25); }
        .brand-icon i { color: #fff; font-size: 18px; }
        .brand-title { font-size: 15px; font-weight: 800; color: var(--text); }
        .brand-sub { font-size: 11px; color: var(--muted); margin-top: 1px; }
        nav { flex: 1; padding: 16px 12px; display: flex; flex-direction: column; gap: 2px; overflow-y: auto; }
        .nav-label { font-size: 10px; font-weight: 700; letter-spacing: .08em; color: var(--muted); text-transform: uppercase; padding: 12px 12px 6px; }
        .nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 14px; border-radius: 10px; font-size: 13.5px; font-weight: 500; color: var(--muted); text-decoration: none; transition: background .15s, color .15s, transform .15s; }
        .nav-link i { width: 18px; text-align: center; font-size: 14px; flex-shrink: 0; }
        .nav-link:hover { background: var(--bg); color: var(--text); transform: translateX(3px); }
        .nav-link.active { background: var(--blue-light); color: var(--blue); font-weight: 600; }
        .nav-link.active i { color: var(--blue); }
        .sidebar-footer { padding: 12px; border-top: 1px solid var(--border); }
        .logout-btn { width: 100%; display: flex; align-items: center; gap: 10px; padding: 10px 14px; border: none; background: none; border-radius: 10px; font-size: 13.5px; font-weight: 500; color: #ef4444; cursor: pointer; font-family: inherit; transition: background .15s; }
        .logout-btn:hover { background: #fef2f2; }

        main { flex: 1; padding: 36px 40px; overflow-x: hidden; }
        .page-header { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 28px; gap: 16px; flex-wrap: wrap; }
        .page-title { font-size: 26px; font-weight: 800; color: var(--text); }
        .page-sub { font-size: 13px; color: var(--muted); margin-top: 4px; }

        .btn-pdf { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: #ef4444; color: #fff; border: none; border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer; font-family: inherit; transition: background .15s, transform .1s, box-shadow .15s; box-shadow: 0 2px 8px rgba(239,68,68,.3); white-space: nowrap; }
        .btn-pdf:hover { background: #dc2626; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(239,68,68,.35); }
        .btn-pdf:active { transform: translateY(0); }

        .stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 28px; }
        .stat-card { background: var(--surface); border: 1px solid var(--border); border-radius: 14px; padding: 18px 20px; display: flex; align-items: center; gap: 14px; box-shadow: var(--shadow); }
        .stat-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: 18px; }
        .stat-val { font-size: 22px; font-weight: 800; }
        .stat-lbl { font-size: 12px; color: var(--muted); margin-top: 2px; }

        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; box-shadow: var(--shadow); }
        .card-head { padding: 18px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; gap: 12px; }
        .card-title { font-size: 14px; font-weight: 700; }
        .card-count { font-size: 12px; color: var(--muted); }

        .search-wrap { position: relative; }
        .search-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: 13px; pointer-events: none; }
        .search-wrap input { padding: 8px 14px 8px 34px; border: 1px solid var(--border); border-radius: 8px; font-size: 13px; font-family: inherit; color: var(--text); background: var(--bg); outline: none; width: 220px; transition: border .15s; }
        .search-wrap input:focus { border-color: var(--blue); background: #fff; }

        table { width: 100%; border-collapse: collapse; }
        thead tr { background: #f9fafb; border-bottom: 1px solid var(--border); }
        th { padding: 12px 20px; font-size: 11px; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; color: var(--muted); text-align: left; white-space: nowrap; }
        th:last-child { text-align: center; }
        td { padding: 14px 20px; font-size: 13.5px; vertical-align: middle; border-bottom: 1px solid #f3f4f6; }
        tbody tr { transition: background .12s; }
        tbody tr:hover { background: #fafbff; }
        tbody tr:last-child td { border-bottom: none; }

        .user-cell { display: flex; align-items: center; gap: 10px; }
        .avatar { width: 34px; height: 34px; border-radius: 50%; background: linear-gradient(135deg, var(--blue), var(--indigo)); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 13px; font-weight: 700; flex-shrink: 0; }
        .user-name { font-weight: 600; color: var(--text); }
        .book-name { font-weight: 500; color: var(--text); max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .date-cell { display: flex; align-items: center; gap: 6px; color: var(--muted); font-size: 13px; }
        .date-cell i { color: #9ca3af; font-size: 12px; }
        .return-ok { display: flex; align-items: center; gap: 6px; color: var(--green); font-weight: 500; font-size: 13px; }
        .return-pending { display: flex; align-items: center; gap: 6px; color: #9ca3af; font-size: 13px; font-style: italic; }

        .badge { display: inline-flex; align-items: center; gap: 5px; padding: 4px 10px; border-radius: 20px; font-size: 11.5px; font-weight: 600; white-space: nowrap; }
        .badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: currentColor; opacity: .7; }
        .badge-pending  { background: var(--yellow-bg); color: var(--yellow); }
        .badge-approved { background: var(--blue-light); color: var(--blue); }
        .badge-returned { background: var(--green-bg); color: var(--green); }
        .badge-rejected { background: var(--red-bg); color: var(--red); }

        .btn-detail { display: inline-flex; align-items: center; gap: 5px; padding: 6px 14px; background: var(--blue-light); color: var(--blue); border-radius: 8px; font-size: 12.5px; font-weight: 600; text-decoration: none; transition: background .12s; }
        .btn-detail:hover { background: var(--blue-mid); }

        .empty-state { padding: 60px 20px; text-align: center; }
        .empty-state i { font-size: 40px; color: #d1d5db; margin-bottom: 12px; display: block; }
        .empty-state p { color: var(--muted); font-size: 14px; }

        .card-footer { padding: 14px 24px; border-top: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; font-size: 13px; color: var(--muted); }
        .pager { display: flex; gap: 4px; }
        .pager-btn { width: 32px; height: 32px; border: 1px solid var(--border); border-radius: 7px; background: none; font-size: 12px; font-family: inherit; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background .12s, border .12s, color .12s; color: var(--muted); }
        .pager-btn:hover:not(:disabled) { border-color: var(--blue); color: var(--blue); }
        .pager-btn.active { background: var(--blue); border-color: var(--blue); color: #fff; }
        .pager-btn:disabled { opacity: .35; cursor: not-allowed; }
    </style>
</head>

<body>

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
        <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('admin.users') }}" class="nav-link"><i class="fas fa-users"></i> Manajemen User</a>
        <a href="{{ url('/admin/books') }}" class="nav-link"><i class="fas fa-book"></i> Data Buku</a>
        <a href="{{ route('admin.categories.index') }}" class="nav-link"><i class="fas fa-tags"></i> Kategori Buku</a>
        <div class="nav-label">Menu Tambahan</div>
        <a href="{{ route('admin.borrowings.index') }}" class="nav-link active"><i class="fas fa-handshake"></i> Riwayat Peminjaman</a>
        <a href="{{ route('admin.ratings.index') }}" class="nav-link"><i class="fas fa-star"></i> Ulasan Buku</a>
    </nav>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>
</aside>

<main>
    <div class="page-header">
        <div>
            <div class="page-title">Data Peminjaman</div>
            <div class="page-sub">Pantau semua data peminjaman buku</div>
        </div>
        <button onclick="exportPDF()" class="btn-pdf">
            <i class="fas fa-file-pdf"></i> Export PDF
        </button>
    </div>

    <div class="stats">
        <div class="stat-card">
            <div class="stat-icon" style="background:#eff6ff; color:#2563eb"><i class="fas fa-list"></i></div>
            <div>
                <div class="stat-val" style="color:#2563eb">{{ $borrowings->count() }}</div>
                <div class="stat-lbl">Total Peminjaman</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fef3c7; color:#b45309"><i class="fas fa-hourglass-half"></i></div>
            <div>
                <div class="stat-val" style="color:#b45309">{{ $borrowings->where('status','pending')->count() }}</div>
                <div class="stat-lbl">Menunggu</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#dcfce7; color:#16a34a"><i class="fas fa-check-circle"></i></div>
            <div>
                <div class="stat-val" style="color:#16a34a">{{ $borrowings->where('status','returned')->count() }}</div>
                <div class="stat-lbl">Dikembalikan</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background:#fee2e2; color:#dc2626"><i class="fas fa-times-circle"></i></div>
            <div>
                <div class="stat-val" style="color:#dc2626">{{ $borrowings->where('status','rejected')->count() }}</div>
                <div class="stat-lbl">Ditolak</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-head">
            <div>
                <span class="card-title">Daftar Peminjaman</span>
                <span class="card-count">&nbsp;— {{ $borrowings->count() }} data</span>
            </div>
            <div class="search-wrap">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Cari nama atau buku…" oninput="filterTable(this.value)">
            </div>
        </div>

        <table id="mainTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Pengembalian</th>
                    <th>Status</th>
                    <th style="text-align:center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($borrowings as $i => $item)
                <tr>
                    <td style="color:var(--muted); font-weight:500; width:48px">{{ $i + 1 }}</td>
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
                    <td style="text-align:center">
                        <a href="{{ route('admin.borrowings.show', $item->id) }}" class="btn-detail">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p>Belum ada data peminjaman</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="card-footer">
            <span id="pagerInfo">Menampilkan data</span>
            <div class="pager" id="pagerBtns"></div>
        </div>
    </div>
</main>

<script>
const PER_PAGE = 10;
let currentPage = 1;
let allRows = [];

document.addEventListener('DOMContentLoaded', () => {
    allRows = Array.from(document.querySelectorAll('#mainTable tbody tr'));
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
        'Menampilkan ' + (start + 1) + '\u2013' + end + ' dari ' + total + ' data';

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

function filterTable(val) {
    currentPage = 1;
    renderPage();
}

// ─────────────────────────────────────────────────────────────────────────────
//  EXPORT PDF — STRUK STYLE (inspired by Indomaret receipt)
//  Layout: portrait, narrow (A4 width tapi konten center di kolom 80mm feel)
// ─────────────────────────────────────────────────────────────────────────────
function exportPDF() {
    const { jsPDF } = window.jspdf;

    // Ambil semua data dari tabel
    const rows = Array.from(document.querySelectorAll('#mainTable tbody tr'));
    const data = [];
    rows.forEach(tr => {
        const cells = tr.querySelectorAll('td');
        if (cells.length < 6) return;
        data.push({
            no      : cells[0].innerText.trim(),
            user    : cells[1].innerText.trim(),
            buku    : cells[2].innerText.trim(),
            pinjam  : cells[3].innerText.replace(/\s+/g,' ').trim(),
            kembali : cells[4].innerText.replace(/\s+/g,' ').trim(),
            status  : cells[5].innerText.trim(),
        });
    });

    // Hitung statistik
    const total     = data.length;
    const pending   = data.filter(d => d.status.toLowerCase().includes('pending')).length;
    const returned  = data.filter(d => d.status.toLowerCase().includes('kembali') || d.status.toLowerCase().includes('returned')).length;
    const approved  = data.filter(d => d.status.toLowerCase().includes('setuju') || d.status.toLowerCase().includes('approved')).length;
    const rejected  = data.filter(d => d.status.toLowerCase().includes('tolak') || d.status.toLowerCase().includes('rejected')).length;

    // Ukuran kertas: A4 portrait
    const doc = new jsPDF({ orientation: 'portrait', unit: 'mm', format: 'a4' });
    const pw = doc.internal.pageSize.getWidth();   // 210
    const ph = doc.internal.pageSize.getHeight();  // 297

    // Warna tema struk
    const C_BG       = [248, 248, 245];   // krem kertas thermal
    const C_BLACK    = [20, 20, 20];
    const C_DARK     = [40, 40, 40];
    const C_MID      = [90, 90, 90];
    const C_LIGHT    = [160, 160, 160];
    const C_RED      = [220, 30, 30];
    const C_GREEN    = [30, 140, 60];
    const C_BLUE     = [30, 90, 180];
    const C_YELLOW   = [180, 120, 10];
    const C_BORDER   = [200, 200, 195];

    // ── background kertas thermal ────────────────────────────
    const drawPageBg = () => {
        doc.setFillColor(...C_BG);
        doc.rect(0, 0, pw, ph, 'F');
        // subtle grain lines (horizontal, tipis)
        doc.setDrawColor(235, 234, 230);
        doc.setLineWidth(0.08);
        for (let y = 0; y < ph; y += 2.5) {
            doc.line(0, y, pw, y);
        }
    };

    // ── helper: garis putus-putus ────────────────────────────
    const dottedLine = (x1, y, x2, dashLen = 1.5, gapLen = 1.5) => {
        doc.setDrawColor(...C_BORDER);
        doc.setLineWidth(0.3);
        let cx = x1;
        while (cx < x2) {
            doc.line(cx, y, Math.min(cx + dashLen, x2), y);
            cx += dashLen + gapLen;
        }
    };

    // ── helper: garis solid tipis ────────────────────────────
    const solidLine = (x1, y, x2, w = 0.4, color = C_BORDER) => {
        doc.setDrawColor(...color);
        doc.setLineWidth(w);
        doc.line(x1, y, x2, y);
    };

    // ── helper: teks centered ────────────────────────────────
    const cText = (text, y, size, style = 'normal', color = C_BLACK) => {
        doc.setFont('courier', style);
        doc.setFontSize(size);
        doc.setTextColor(...color);
        doc.text(String(text), pw / 2, y, { align: 'center' });
    };

    // ── helper: teks kiri-kanan (label: value) ───────────────
    const kvLine = (label, value, y, size = 8, lColor = C_MID, vColor = C_DARK) => {
        const margin = 22;
        doc.setFont('courier', 'normal');
        doc.setFontSize(size);
        doc.setTextColor(...lColor);
        doc.text(label, margin, y);
        doc.setFont('courier', 'bold');
        doc.setTextColor(...vColor);
        doc.text(String(value), pw - margin, y, { align: 'right' });
    };

    // ── helper: badge status ─────────────────────────────────
    const drawStatusBadge = (status, x, y, maxW) => {
        const s = status.toLowerCase();
        let bg, fg, label;
        if (s.includes('kembali') || s.includes('returned')) {
            bg = [220, 245, 225]; fg = C_GREEN; label = 'KEMBALI';
        } else if (s.includes('setuju') || s.includes('approved')) {
            bg = [220, 235, 255]; fg = C_BLUE; label = 'DISETUJUI';
        } else if (s.includes('pending')) {
            bg = [255, 245, 210]; fg = C_YELLOW; label = 'PENDING';
        } else {
            bg = [255, 225, 225]; fg = C_RED; label = 'DITOLAK';
        }
        const bw = 22; const bh = 5;
        const bx = x + (maxW - bw) / 2;
        doc.setFillColor(...bg);
        doc.roundedRect(bx, y - 3.5, bw, bh, 1, 1, 'F');
        doc.setFont('courier', 'bold');
        doc.setFontSize(6);
        doc.setTextColor(...fg);
        doc.text(label, bx + bw / 2, y, { align: 'center' });
    };

    // ─────────────────────────────────────────────────────────
    //  HALAMAN 1: STRUK RINGKASAN (cover / summary page)
    // ─────────────────────────────────────────────────────────
    drawPageBg();

    const margin = 20;
    const innerW = pw - margin * 2;
    let y = 0;

    // ── TOP NOTCH (potongan atas struk) ──────────────────────
    doc.setFillColor(235, 234, 230);
    doc.rect(0, 0, pw, 6, 'F');
    // zigzag lubang struk
    doc.setFillColor(...C_BG);
    for (let xi = 5; xi < pw; xi += 8) {
        doc.circle(xi, 6, 2.5, 'F');
    }

    y = 18;

    // ── LOGO / NAMA TOKO ─────────────────────────────────────
    // Kotak header merah ala brand perpustakaan
    doc.setFillColor(...C_BLUE);
    doc.roundedRect(margin, y - 6, innerW, 22, 2, 2, 'F');

    // Teks nama sistem
    doc.setFont('courier', 'bold');
    doc.setFontSize(18);
    doc.setTextColor(255, 255, 255);
    doc.text('PERPUSTAKAAN', pw / 2, y + 3, { align: 'center' });

    doc.setFont('courier', 'normal');
    doc.setFontSize(8);
    doc.setTextColor(255, 210, 210);
    doc.text('S I S T E M   D I G I T A L', pw / 2, y + 9, { align: 'center' });

    y += 26;

    // ── NOMOR LAPORAN & TANGGAL ───────────────────────────────
    const now = new Date();
    const dateStr = now.toLocaleDateString('id-ID', { day: '2-digit', month: '2-digit', year: 'numeric' });
    const timeStr = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    const noLaporan = 'LAP-' + now.getFullYear() + String(now.getMonth()+1).padStart(2,'0') + String(now.getDate()).padStart(2,'0') + '-' + String(now.getHours()).padStart(2,'0') + String(now.getMinutes()).padStart(2,'0');

    cText('LAPORAN PEMINJAMAN BUKU', y, 11, 'bold', C_BLACK);
    y += 6;
    cText('=' .repeat(34), y, 7, 'normal', C_LIGHT);
    y += 5;

    kvLine('No. Laporan', noLaporan, y, 7.5);     y += 5;
    kvLine('Tanggal', dateStr, y, 7.5);            y += 5;
    kvLine('Jam', timeStr, y, 7.5);                y += 5;
    kvLine('Operator', 'Admin Sistem', y, 7.5);    y += 5;
    kvLine('Kasir', 'PERPUSTAKAAN DIGITAL', y, 7.5); y += 6;

    dottedLine(margin, y, pw - margin);
    y += 6;

    // ── RINGKASAN STATISTIK ───────────────────────────────────
    cText('*** RINGKASAN DATA ***', y, 8.5, 'bold', C_DARK);
    y += 6;

    // Box statistik — 2 kolom
    const statItems = [
        { label: 'TOTAL PEMINJAMAN', val: total,    color: C_BLUE },
        { label: 'PENDING',           val: pending,  color: C_YELLOW },
        { label: 'DISETUJUI',         val: approved, color: C_BLUE },
        { label: 'DIKEMBALIKAN',      val: returned, color: C_GREEN },
        { label: 'DITOLAK',           val: rejected, color: C_RED },
    ];

    const boxW = (innerW - 4) / 2;
    const boxH = 16;

    statItems.forEach((st, i) => {
        const col = i % 2;
        const row = Math.floor(i / 2);
        const bx = margin + col * (boxW + 4);
        const by = y + row * (boxH + 3);

        doc.setFillColor(255, 255, 253);
        doc.setDrawColor(...C_BORDER);
        doc.setLineWidth(0.4);
        doc.roundedRect(bx, by, boxW, boxH, 1.5, 1.5, 'FD');

        doc.setFont('courier', 'bold');
        doc.setFontSize(16);
        doc.setTextColor(...st.color);
        doc.text(String(st.val), bx + boxW / 2, by + 9, { align: 'center' });

        doc.setFont('courier', 'normal');
        doc.setFontSize(6);
        doc.setTextColor(...C_LIGHT);
        doc.text(st.label, bx + boxW / 2, by + 14, { align: 'center' });
    });

    // Item ke-5 (ganjil) → full width baris sendiri
    const lastRow = Math.floor((statItems.length - 1) / 2);
    y += (lastRow + 1) * (boxH + 3) + 2;

    dottedLine(margin, y, pw - margin);
    y += 6;

    // ── DETAIL PER STATUS (ringkasan persen) ─────────────────
    cText('KOMPOSISI STATUS', y, 8, 'bold', C_DARK);
    y += 6;

    const statusList = [
        { label: 'Dikembalikan', count: returned, color: C_GREEN },
        { label: 'Disetujui',    count: approved, color: C_BLUE },
        { label: 'Pending',      count: pending,  color: C_YELLOW },
        { label: 'Ditolak',      count: rejected, color: C_RED },
    ];

    const barTotalW = innerW - 30;
    statusList.forEach(st => {
        const pct = total > 0 ? (st.count / total) : 0;
        const barW = pct * barTotalW;
        const bx = margin + 28;

        doc.setFont('courier', 'normal');
        doc.setFontSize(7.5);
        doc.setTextColor(...C_DARK);
        doc.text(st.label.padEnd(14), margin, y + 0.5);

        // track bar
        doc.setFillColor(235, 234, 230);
        doc.roundedRect(bx, y - 3.5, barTotalW, 5, 1, 1, 'F');

        // fill bar
        if (barW > 0) {
            doc.setFillColor(...st.color);
            doc.roundedRect(bx, y - 3.5, barW, 5, 1, 1, 'F');
        }

        // persen
        doc.setFont('courier', 'bold');
        doc.setFontSize(7);
        doc.setTextColor(...st.color);
        doc.text(Math.round(pct * 100) + '%', bx + barTotalW + 3, y + 0.5);

        y += 8;
    });

    y += 2;
    dottedLine(margin, y, pw - margin);
    y += 8;

    // ── PESAN TERIMA KASIH (ala Indomaret) ───────────────────
    cText('Terima kasih telah menggunakan', y, 8, 'normal', C_MID);  y += 5;
    cText('Sistem Perpustakaan Digital', y, 9, 'bold', C_DARK);       y += 6;
    cText('Dokumen ini diterbitkan secara otomatis', y, 7, 'normal', C_LIGHT); y += 4;
    cText('oleh sistem pada ' + dateStr + ' ' + timeStr, y, 7, 'normal', C_LIGHT); y += 7;

    // Barcode dekoratif
    const bcX = pw / 2 - 25;
    const bcW = 50;
    const bcY = y;
    const bcH = 10;
    const barWidths = [0.8,0.4,1,0.3,0.6,1.2,0.4,0.9,0.3,0.5,1,0.4,0.7,0.3,1.2,0.5,0.4,0.8,0.3,1,0.4,0.6,0.3,0.9,0.5,0.4,1,0.3,0.8,0.5];
    let bx2 = bcX;
    let isBlack = true;
    barWidths.forEach(bw => {
        const scaledW = bw * (bcW / barWidths.reduce((a,b) => a+b, 0)) * barWidths.length / 2.5;
        if (isBlack) {
            doc.setFillColor(...C_BLACK);
            doc.rect(bx2, bcY, scaledW, bcH, 'F');
        }
        bx2 += scaledW;
        isBlack = !isBlack;
    });

    y += bcH + 4;
    cText(noLaporan, y, 7, 'normal', C_LIGHT);
    y += 8;

    // ── BOTTOM NOTCH ─────────────────────────────────────────
    doc.setFillColor(235, 234, 230);
    doc.rect(0, ph - 6, pw, 6, 'F');
    doc.setFillColor(...C_BG);
    for (let xi = 5; xi < pw; xi += 8) {
        doc.circle(xi, ph - 6, 2.5, 'F');
    }

    // ─────────────────────────────────────────────────────────
    //  HALAMAN 2+: TABEL DATA (struk panjang per item)
    // ─────────────────────────────────────────────────────────
    const ITEMS_PER_PAGE = 15;
    const totalPages2 = Math.ceil(data.length / ITEMS_PER_PAGE);

    for (let pg = 0; pg < totalPages2; pg++) {
        doc.addPage();
        drawPageBg();

        // notch atas
        doc.setFillColor(235, 234, 230);
        doc.rect(0, 0, pw, 6, 'F');
        doc.setFillColor(...C_BG);
        for (let xi = 5; xi < pw; xi += 8) { doc.circle(xi, 6, 2.5, 'F'); }

        let ty = 18;

        // Header halaman
        doc.setFillColor(...C_BLUE);
        doc.rect(margin, ty - 5, innerW, 10, 'F');
        doc.setFont('courier', 'bold');
        doc.setFontSize(9);
        doc.setTextColor(255, 255, 255);
        doc.text('PERPUSTAKAAN DIGITAL', pw / 2, ty + 0.5, { align: 'center' });
        ty += 12;

        cText('DATA TRANSAKSI PEMINJAMAN', ty, 8.5, 'bold', C_DARK);
        ty += 4;
        cText('Hal. ' + (pg + 2) + '  |  ' + dateStr, ty, 7, 'normal', C_LIGHT);
        ty += 5;

        solidLine(margin, ty, pw - margin, 0.5, C_DARK);
        ty += 1;
        solidLine(margin, ty + 0.5, pw - margin, 0.5, C_DARK);
        ty += 4;

        // Header kolom
        const cols = [
            { label: '#',         x: margin,      w: 10,  align: 'center' },
            { label: 'PENGGUNA',  x: margin + 12, w: 42,  align: 'left' },
            { label: 'JUDUL BUKU',x: margin + 56, w: 60,  align: 'left' },
            { label: 'TGL PINJAM',x: margin + 118,w: 32,  align: 'center' },
            { label: 'STATUS',    x: margin + 152,w: 28,  align: 'center' },
        ];

        doc.setFont('courier', 'bold');
        doc.setFontSize(7);
        doc.setTextColor(...C_MID);
        cols.forEach(c => {
            if (c.align === 'center') {
                doc.text(c.label, c.x + c.w / 2, ty, { align: 'center' });
            } else {
                doc.text(c.label, c.x, ty);
            }
        });
        ty += 2;
        solidLine(margin, ty, pw - margin, 0.3, C_BORDER);
        ty += 3;

        // Baris data
        const pageData = data.slice(pg * ITEMS_PER_PAGE, (pg + 1) * ITEMS_PER_PAGE);

        pageData.forEach((d, idx) => {
            const rowY = ty;
            const isEven = idx % 2 === 0;

            // stripe background
            if (isEven) {
                doc.setFillColor(244, 243, 240);
                doc.rect(margin - 1, rowY - 4, innerW + 2, 12, 'F');
            }

            // No
            doc.setFont('courier', 'bold');
            doc.setFontSize(7.5);
            doc.setTextColor(...C_MID);
            doc.text(d.no, cols[0].x + cols[0].w / 2, rowY + 2, { align: 'center' });

            // User — truncate
            doc.setFont('courier', 'bold');
            doc.setFontSize(7.5);
            doc.setTextColor(...C_DARK);
            const userName = d.user.length > 18 ? d.user.slice(0,17) + '.' : d.user;
            doc.text(userName, cols[1].x, rowY + 2);

            // Buku — 2 baris jika panjang
            doc.setFont('courier', 'normal');
            doc.setFontSize(7);
            doc.setTextColor(...C_DARK);
            const bookLine1 = d.buku.length > 26 ? d.buku.slice(0,26) : d.buku;
            const bookLine2 = d.buku.length > 26 ? d.buku.slice(26,50) : '';
            doc.text(bookLine1, cols[2].x, rowY + 1);
            if (bookLine2) {
                doc.setTextColor(...C_MID);
                doc.text(bookLine2, cols[2].x, rowY + 5.5);
            }

            // Tanggal pinjam (bersihkan icon teks)
            const tglClean = d.pinjam.replace(/[^\d\s\w]/g, '').trim();
            doc.setFont('courier', 'normal');
            doc.setFontSize(7);
            doc.setTextColor(...C_MID);
            doc.text(tglClean, cols[3].x + cols[3].w / 2, rowY + 2, { align: 'center' });

            // Status badge
            drawStatusBadge(d.status, cols[4].x, rowY + 2, cols[4].w);

            ty += 13;

            // Garis tipis antar item (putus-putus)
            dottedLine(margin + 10, ty - 2, pw - margin - 10, 0.8, 1.5);
        });

        // Footer halaman
        solidLine(margin, ph - 20, pw - margin, 0.5, C_DARK);
        solidLine(margin, ph - 19, pw - margin, 0.5, C_DARK);

        doc.setFont('courier', 'normal');
        doc.setFontSize(6.5);
        doc.setTextColor(...C_LIGHT);
        doc.text('Dokumen resmi sistem perpustakaan digital', pw / 2, ph - 13, { align: 'center' });

        doc.setFont('courier', 'bold');
        doc.setFontSize(7);
        doc.setTextColor(...C_DARK);
        doc.text('Hal. ' + (pg + 2) + ' / ' + (totalPages2 + 1), pw / 2, ph - 8, { align: 'center' });

        // notch bawah
        doc.setFillColor(235, 234, 230);
        doc.rect(0, ph - 6, pw, 6, 'F');
        doc.setFillColor(...C_BG);
        for (let xi = 5; xi < pw; xi += 8) { doc.circle(xi, ph - 6, 2.5, 'F'); }
    }

    doc.save('struk-peminjaman-' + now.toISOString().slice(0,10) + '.pdf');

    // kembalikan pagination
    renderPage();
}
</script>
</body>
</html>