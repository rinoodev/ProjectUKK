<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengembalian Buku | Perpustakaan Digital</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    <style>
        :root {
            --indigo:    #4f46e5;
            --indigo-l:  #6366f1;
            --indigo-xl: #e0e7ff;
            --emerald:   #059669;
            --emerald-l: #d1fae5;
            --rose:      #e11d48;
            --rose-l:    #ffe4e6;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            margin: 0;
        }

        h1, h2, h3, h4, .font-display { font-family: 'Sora', sans-serif; }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 260px;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            background: #0f172a;
            display: flex; flex-direction: column;
            z-index: 40;
            padding: 0 0 24px;
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
            font-size: 10px; font-weight: 600;
            letter-spacing: 0.1em; color: rgba(255,255,255,0.28);
            padding: 0 12px; margin: 20px 0 8px;
            text-transform: uppercase;
        }

        .nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 14px; border-radius: 10px;
            font-size: 13.5px; font-weight: 500;
            color: rgba(255,255,255,0.55);
            text-decoration: none;
            transition: all 0.2s ease;
            position: relative; margin-bottom: 2px;
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
            margin: 0 16px; padding: 14px;
            background: rgba(255,255,255,0.06);
            border-radius: 12px;
            display: flex; align-items: center; gap: 11px;
        }

        .avatar-sm {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--indigo), var(--indigo-l));
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: #fff; font-size: 13px;
            font-family: 'Sora', sans-serif; flex-shrink: 0;
        }

        /* ── MAIN ── */
        .main-wrap {
            margin-left: 260px;
            min-height: 100vh;
            display: flex; flex-direction: column;
        }

        /* ── TOP BAR ── */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 36px;
            position: sticky; top: 0; z-index: 30;
        }

        .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #94a3b8; }
        .breadcrumb .current { color: #1e293b; font-weight: 600; }
        .breadcrumb a { color: #94a3b8; text-decoration: none; transition: color 0.2s; }
        .breadcrumb a:hover { color: var(--indigo); }

        /* ── CONTENT ── */
        .content { padding: 36px; flex: 1; }

        /* ── PAGE HERO ── */
        .page-hero {
            background: linear-gradient(135deg, #4c0519 0%, #881337 45%, #9f1239 100%);
            border-radius: 20px;
            padding: 30px 36px;
            margin-bottom: 28px;
            display: flex; align-items: center; justify-content: space-between;
            position: relative; overflow: hidden;
            animation: fadeUp 0.4s ease both;
        }

        .page-hero::before {
            content: '';
            position: absolute; top: -50px; right: -50px;
            width: 220px; height: 220px;
            background: radial-gradient(circle, rgba(251,113,133,0.22) 0%, transparent 70%);
            border-radius: 50%;
        }

        .page-hero::after {
            content: '';
            position: absolute; bottom: -30px; left: 25%;
            width: 160px; height: 160px;
            background: radial-gradient(circle, rgba(225,29,72,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        .page-hero-label {
            font-size: 11px; font-weight: 600; letter-spacing: 0.1em;
            text-transform: uppercase; color: rgba(254,205,211,0.65);
            margin-bottom: 6px;
        }

        .page-hero-title {
            font-family: 'Sora', sans-serif;
            font-size: 26px; font-weight: 800;
            color: #fff; line-height: 1.15; margin-bottom: 8px;
        }

        .page-hero-sub { font-size: 13.5px; color: rgba(254,205,211,0.6); }

        .page-hero-icon {
            position: relative; z-index: 2;
            width: 72px; height: 72px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            backdrop-filter: blur(10px);
        }

        /* ── SECTION HEADER ── */
        .section-header { margin-bottom: 20px; }
        .divider { display: flex; align-items: center; gap: 10px; margin-bottom: 4px; }
        .divider-line { flex: 1; height: 1px; background: #e2e8f0; }
        .section-title { font-family: 'Sora', sans-serif; font-size: 17px; font-weight: 700; color: #0f172a; white-space: nowrap; }
        .section-sub { font-size: 13px; color: #94a3b8; }

        /* ── GRID LAYOUT ── */
        .return-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 20px;
            align-items: start;
        }

        /* ── CARD BASE ── */
        .card {
            background: #fff;
            border-radius: 16px;
            border: 1.5px solid #e8edf4;
            overflow: hidden;
            animation: fadeUp 0.5s ease both;
            transition: all 0.28s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            box-shadow: 0 16px 40px rgba(0,0,0,0.07);
            border-color: #fda4af;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid #f1f5f9;
            display: flex; align-items: center; gap: 14px;
        }

        .card-icon {
            width: 42px; height: 42px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .card-icon.rose   { background: var(--rose-l); }
        .card-icon.emerald { background: var(--emerald-l); }

        .card-header-text h3 {
            font-family: 'Sora', sans-serif;
            font-size: 14.5px; font-weight: 700; color: #0f172a; margin: 0 0 2px;
        }

        .card-header-text p { font-size: 12px; color: #94a3b8; margin: 0; }

        /* ── DETAIL ROWS ── */
        .detail-body { padding: 8px 24px 20px; }

        .detail-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid #f8fafc;
        }

        .detail-row:last-child { border-bottom: none; }

        .detail-label {
            font-size: 13px; color: #64748b; font-weight: 500;
            display: flex; align-items: center; gap: 8px;
        }

        .detail-label i { width: 16px; text-align: center; color: #cbd5e1; font-size: 12px; }

        .detail-value {
            font-size: 13.5px; font-weight: 600; color: #0f172a;
            text-align: right; max-width: 55%;
        }

        /* ── STATUS BADGE ── */
        .status-badge {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 6px 14px;
            background: var(--emerald-l);
            border: 1px solid rgba(5,150,105,0.15);
            border-radius: 999px;
            font-size: 12px; font-weight: 600; color: var(--emerald);
            width: fit-content;
        }

        .pulse-dot { width: 6px; height: 6px; border-radius: 50%; }
        .pulse-dot.green { background: var(--emerald); animation: pulse 1.5s infinite; }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50%       { opacity: 0.4; }
        }

        /* ── ACTION CARD ── */
        .action-body { padding: 24px; }

        .btn-return {
            display: flex; align-items: center; justify-content: center; gap: 9px;
            width: 100%; padding: 14px 20px;
            background: linear-gradient(135deg, var(--rose), #be123c);
            color: #fff; border: none; border-radius: 12px;
            font-size: 14px; font-weight: 700;
            cursor: pointer;
            transition: all 0.22s ease;
            box-shadow: 0 4px 14px rgba(225,29,72,0.35);
            font-family: 'DM Sans', sans-serif;
            margin-bottom: 12px;
        }

        .btn-return:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(225,29,72,0.45);
        }

        .btn-back {
            display: flex; align-items: center; justify-content: center; gap: 7px;
            width: 100%; padding: 12px 16px;
            background: #fff;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13px; font-weight: 600;
            color: #64748b; cursor: pointer;
            transition: all 0.22s ease;
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-back:hover {
            border-color: #c7d2fe;
            background: #eef2ff;
            color: var(--indigo);
        }

        /* ── WARNING NOTE ── */
        .warning-note {
            display: flex; align-items: flex-start; gap: 10px;
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 10px;
            padding: 12px 14px;
            margin-bottom: 20px;
        }

        .warning-note i { color: #d97706; font-size: 13px; margin-top: 1px; flex-shrink: 0; }
        .warning-note p { font-size: 12px; color: #92400e; margin: 0; line-height: 1.5; }

        /* ── FOOTER ── */
        footer {
            border-top: 1px solid #e2e8f0;
            padding: 22px 36px;
            display: flex; align-items: center; justify-content: space-between;
        }

        footer .foot-brand {
            display: flex; align-items: center; gap: 10px;
            font-family: 'Sora', sans-serif; font-weight: 700; font-size: 14px; color: #0f172a;
        }

        /* ── ANIMATION ── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 1024px) { .return-grid { grid-template-columns: 1fr; } }

        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-wrap { margin-left: 0; }
            .content { padding: 20px; }
            .page-hero-icon { display: none; }
            .topbar { padding: 0 20px; }
        }
    </style>
</head>
<body>

<!-- ═══════════════════════════════════════
     SIDEBAR
═══════════════════════════════════════ -->
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

        <a href="{{ route('user.dashboard') }}" class="nav-item">
            <i class="fas fa-house-chimney nav-icon"></i>
            Dashboard
        </a>

        <a href="{{ route('user.books') }}" class="nav-item active">
            <i class="fas fa-book nav-icon"></i>
            Katalog Buku
        </a>

        <a href="{{ route('user.favorites') }}" class="nav-item">
            <i class="fas fa-heart nav-icon"></i>
            Buku Favorit
        </a>

        <a href="{{ route('user.borrowing.index') }}" class="nav-item">
            <i class="fas fa-clock-rotate-left nav-icon"></i>
            Riwayat Peminjaman
        </a>

        <div class="nav-label">Akun</div>

        <a href="{{ (url('/profile')) }}" class="nav-item">
            <i class="fas fa-user nav-icon"></i>
            Profil Saya
        </a>

        <a href="#" class="nav-item">
            <i class="fas fa-gear nav-icon"></i>
            Pengaturan
        </a>
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


<!-- ═══════════════════════════════════════
     MAIN
═══════════════════════════════════════ -->
<div class="main-wrap">

    <!-- TOP BAR -->
    <header class="topbar">
        <div class="breadcrumb">
            <i class="fas fa-house-chimney" style="font-size:12px;"></i>
            <span>›</span>
            <a href="{{ route('user.dashboard') }}">Dashboard</a>
            <span>›</span>
            <a href="{{ route('user.books') }}">Katalog Buku</a>
            <span>›</span>
            <span class="current">Pengembalian Buku</span>
        </div>
    </header>


    <!-- CONTENT -->
    <main class="content">

        <!-- PAGE HERO -->
        <div class="page-hero">
            <div style="position:relative; z-index:2;">
                <p class="page-hero-label">Proses Pengembalian</p>
                <h2 class="page-hero-title">Pengembalian Buku</h2>
                <p class="page-hero-sub">Pastikan buku dalam kondisi baik sebelum dikembalikan</p>
            </div>
            <div class="page-hero-icon">
                <i class="fas fa-undo" style="font-size:30px; color:rgba(254,205,211,0.85);"></i>
            </div>
        </div>


        <!-- SECTION HEADER -->
        <div class="section-header">
            <div class="divider">
                <div class="section-title">Detail Pengembalian</div>
                <div class="divider-line"></div>
            </div>
            <p class="section-sub">Periksa informasi buku sebelum mengonfirmasi pengembalian</p>
        </div>


        <!-- GRID -->
        <div class="return-grid">

            <!-- BOOK DETAIL CARD -->
            <div class="card" style="animation-delay: 60ms">
                <div class="card-header">
                    <div class="card-icon rose">
                        <i class="fas fa-book" style="color: var(--rose); font-size:17px;"></i>
                    </div>
                    <div class="card-header-text">
                        <h3>Detail Buku</h3>
                        <p>Informasi buku yang akan dikembalikan</p>
                    </div>
                </div>

                <div class="detail-body">
                    <div class="detail-row">
                        <span class="detail-label">
                            <i class="fas fa-book-open"></i>
                            Judul Buku
                        </span>
                        <span class="detail-value">{{ $borrowing->book->judul }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">
                            <i class="fas fa-user-pen"></i>
                            Penulis
                        </span>
                        <span class="detail-value">{{ $borrowing->book->penulis }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">
                            <i class="fas fa-calendar-days"></i>
                            Tanggal Pinjam
                        </span>
                        <span class="detail-value">
                            {{ \Carbon\Carbon::parse($borrowing->tanggal_pinjam)->translatedFormat('d F Y') }}
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">
                            <i class="fas fa-circle-check"></i>
                            Status
                        </span>
                        <div>
                            <div class="status-badge">
                                <span class="pulse-dot green"></span>
                                Sedang Dipinjam
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ACTION CARD -->
            <div class="card" style="animation-delay: 120ms">
                <div class="card-header">
                    <div class="card-icon rose">
                        <i class="fas fa-undo" style="color: var(--rose); font-size:17px;"></i>
                    </div>
                    <div class="card-header-text">
                        <h3>Kembalikan Buku</h3>
                        <p>Konfirmasi pengembalian buku</p>
                    </div>
                </div>

                <div class="action-body">
                    <div class="warning-note">
                        <i class="fas fa-triangle-exclamation"></i>
                        <p>Pastikan buku dalam kondisi baik dan lengkap sebelum melakukan pengembalian.</p>
                    </div>

                    <button onclick="returnBook({{ $borrowing->id }})" class="btn-return">
                        <i class="fas fa-check"></i>
                        Kembalikan Sekarang
                    </button>

                    <a href="{{ route('user.books') }}" class="btn-back">
                        <i class="fas fa-arrow-left" style="font-size:11px;"></i>
                        Kembali ke Katalog
                    </a>
                </div>
            </div>

        </div>

    </main>


    <!-- FOOTER -->
    <footer>
        <div class="foot-brand">
            <div style="width:30px; height:30px; background:linear-gradient(135deg,var(--indigo),var(--indigo-l)); border-radius:8px; display:flex; align-items:center; justify-content:center;">
                <i class="fas fa-book-open" style="color:#fff; font-size:12px;"></i>
            </div>
            Smart Pustaka
        </div>
        <p style="font-size:12px; color:#94a3b8;">© 2026 Smart Pustaka. Hak cipta dilindungi.</p>
    </footer>

</div><!-- end .main-wrap -->


<script>
function returnBook(id) {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Buku akan dikembalikan ke perpustakaan',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, kembalikan',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#e11d48',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            return fetch("{{ route('user.borrow.return', $borrowing->id) }}", {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: 'Buku berhasil dikembalikan',
                timer: 1500,
                showConfirmButton: false
            });

            setTimeout(() => {
                window.location.href = "{{ route('user.books') }}";
            }, 1500);
        }
    });
}
</script>
</body>
</html>