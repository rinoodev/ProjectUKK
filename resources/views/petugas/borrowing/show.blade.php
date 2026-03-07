<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Peminjaman | Petugas</title>
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
            --purple: #7c3aed; --purple-bg: #f5f3ff;
            --orange: #ea580c; --orange-bg: #fff7ed;
            --shadow: 0 1px 3px rgba(0,0,0,.07), 0 4px 16px rgba(0,0,0,.05);
            --shadow-md: 0 4px 20px rgba(0,0,0,.08);
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

        /* Breadcrumb */
        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 12.5px; color: var(--muted); margin-bottom: 16px; }
        .breadcrumb a { color: var(--muted); text-decoration: none; transition: color .15s; }
        .breadcrumb a:hover { color: var(--accent); }
        .breadcrumb i.sep { font-size: 9px; color: #d1d5db; }

        .page-title { font-size: 26px; font-weight: 800; color: var(--text); }
        .page-sub { font-size: 13px; color: var(--muted); margin-top: 4px; margin-bottom: 28px; }

        /* Layout */
        .layout { display: grid; grid-template-columns: 1fr 300px; gap: 20px; align-items: start; }

        /* Card */
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; box-shadow: var(--shadow); margin-bottom: 20px; }
        .card:last-child { margin-bottom: 0; }

        .card-head {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .card-head-icon {
            width: 40px; height: 40px;
            border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .card-head-title { font-size: 14px; font-weight: 700; color: var(--text); }
        .card-head-sub { font-size: 12px; color: var(--muted); margin-top: 2px; }

        .card-body { padding: 24px; }

        /* Info rows */
        .info-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid var(--border);
            margin-bottom: 12px;
            background: var(--bg);
            transition: box-shadow .15s, transform .15s;
        }
        .info-row:last-child { margin-bottom: 0; }
        .info-row:hover { box-shadow: var(--shadow-md); transform: translateY(-1px); }

        .info-row-icon {
            width: 40px; height: 40px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .info-row-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); margin-bottom: 3px; }
        .info-row-value { font-size: 14px; font-weight: 700; color: var(--text); }
        .info-row-hint { font-size: 11.5px; color: var(--muted); margin-top: 2px; }

        /* Two-col dates */
        .dates-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

        /* Avatar circle */
        .user-avatar {
            width: 48px; height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 18px; font-weight: 800;
            flex-shrink: 0;
        }

        /* Status display card */
        .status-display {
            border-radius: 14px;
            border: 2px solid;
            padding: 24px 20px;
            text-align: center;
        }

        .status-icon-circle {
            width: 56px; height: 56px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 12px;
            font-size: 22px;
            color: #fff;
        }

        .status-tag { font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 4px; }
        .status-label { font-size: 20px; font-weight: 800; }
        .status-hint { font-size: 12px; margin-top: 6px; }

        /* Timeline */
        .timeline { display: flex; flex-direction: column; gap: 0; }
        .tl-item { display: flex; gap: 14px; position: relative; padding-bottom: 20px; }
        .tl-item:last-child { padding-bottom: 0; }
        .tl-item:not(:last-child)::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 32px;
            bottom: 0;
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
        }
        .tl-title { font-size: 13.5px; font-weight: 700; color: var(--text); }
        .tl-time { font-size: 12px; color: var(--muted); margin-top: 2px; }

        /* Action buttons */
        .actions-wrap { display: flex; flex-wrap: wrap; gap: 10px; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            font-family: inherit;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background .12s, transform .1s, box-shadow .12s;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }

        .btn-back { background: var(--bg); color: var(--text); border: 1.5px solid var(--border); }
        .btn-back:hover { background: #e5e7eb; }

        .btn-edit { background: #eef2ff; color: var(--indigo); }
        .btn-edit:hover { background: #e0e7ff; }

        .btn-approve { background: var(--accent-light); color: var(--accent); }
        .btn-approve:hover { background: var(--accent-mid); box-shadow: 0 4px 12px rgba(22,163,74,.2); }

        .btn-reject { background: var(--red-bg); color: var(--red); }
        .btn-reject:hover { background: #fecaca; }
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
        <a href="{{ url('petugas/books') }}" class="nav-link"><i class="fas fa-book"></i> Kelola Buku</a>
        <div class="nav-label">Menu Tambahan</div>
        <a href="{{ route('petugas.borrowings.index') }}" class="nav-link active"><i class="fas fa-handshake"></i> Riwayat Peminjaman</a>
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
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('petugas.borrowings.index') }}"><i class="fas fa-handshake"></i> Riwayat Peminjaman</a>
        <i class="fas fa-chevron-right sep"></i>
        <span style="color:var(--text); font-weight:600">Detail Peminjaman</span>
    </div>

    <div class="page-title">Detail Peminjaman</div>
    <div class="page-sub">Informasi lengkap peminjaman buku</div>

    <div class="layout">

        <!-- LEFT COLUMN -->
        <div>
            <!-- Info Card -->
            <div class="card">
                <div class="card-head">
                    <div class="card-head-icon" style="background:var(--accent-light)">
                        <i class="fas fa-info-circle" style="color:var(--accent)"></i>
                    </div>
                    <div>
                        <div class="card-head-title">Informasi Peminjaman</div>
                        <div class="card-head-sub">ID: #{{ $borrowing->id }}</div>
                    </div>
                </div>
                <div class="card-body">

                    <!-- Peminjam -->
                    <div class="info-row">
                        <div class="user-avatar">{{ strtoupper(substr($borrowing->user->name ?? 'U', 0, 1)) }}</div>
                        <div>
                            <div class="info-row-label"><i class="fas fa-user" style="margin-right:4px"></i>Nama Peminjam</div>
                            <div class="info-row-value">{{ $borrowing->user->name ?? '-' }}</div>
                            @if(isset($borrowing->user->email))
                            <div class="info-row-hint">{{ $borrowing->user->email }}</div>
                            @endif
                        </div>
                    </div>

                    <!-- Buku -->
                    <div class="info-row">
                        <div class="info-row-icon" style="background:var(--purple-bg)">
                            <i class="fas fa-book" style="color:var(--purple)"></i>
                        </div>
                        <div>
                            <div class="info-row-label"><i class="fas fa-bookmark" style="margin-right:4px"></i>Judul Buku</div>
                            <div class="info-row-value">{{ $borrowing->book->judul ?? '-' }}</div>
                        </div>
                    </div>

                    <!-- Tanggal -->
                    <div class="dates-grid">
                        <div class="info-row" style="margin-bottom:0">
                            <div class="info-row-icon" style="background:var(--accent-light)">
                                <i class="fas fa-calendar-plus" style="color:var(--accent)"></i>
                            </div>
                            <div>
                                <div class="info-row-label">Tgl Pinjam</div>
                                <div class="info-row-value">{{ $borrowing->created_at->format('d M Y') }}</div>
                                <div class="info-row-hint">{{ $borrowing->created_at->format('H:i') }} WIB</div>
                            </div>
                        </div>
                        <div class="info-row" style="margin-bottom:0">
                            <div class="info-row-icon" style="background:var(--orange-bg)">
                                <i class="fas fa-calendar-check" style="color:var(--orange)"></i>
                            </div>
                            <div>
                                <div class="info-row-label">Tgl Kembali</div>
                                @if($borrowing->returned_at)
                                    <div class="info-row-value">{{ \Carbon\Carbon::parse($borrowing->returned_at)->format('d M Y') }}</div>
                                    <div class="info-row-hint">{{ \Carbon\Carbon::parse($borrowing->returned_at)->format('H:i') }} WIB</div>
                                @else
                                    <div class="info-row-value" style="color:var(--muted); font-style:italic; font-size:13px">Belum dikembalikan</div>
                                    <div class="info-row-hint"><i class="fas fa-hourglass-half" style="margin-right:3px"></i>Menunggu</div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Actions Card -->
            <div class="card">
                <div class="card-head">
                    <div class="card-head-icon" style="background:var(--accent-light)">
                        <i class="fas fa-tasks" style="color:var(--accent)"></i>
                    </div>
                    <div class="card-head-title">Aksi</div>
                </div>
                <div class="card-body">
                    <div class="actions-wrap">
                        <a href="{{ route('petugas.borrowings.index') }}" class="btn btn-back">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <a href="{{ route('petugas.borrowings.edit', $borrowing) }}" class="btn btn-edit">
                            <i class="fas fa-edit"></i> Edit Peminjaman
                        </a>
                        @if($borrowing->status === 'pending')
                            <form method="POST" action="{{ route('petugas.borrowings.approve', $borrowing->id) }}" style="display:inline">
                                @csrf
                                <button type="submit" class="btn btn-approve">
                                    <i class="fas fa-check-circle"></i> Approve
                                </button>
                            </form>
                            <form method="POST" action="{{ route('petugas.borrowings.reject', $borrowing->id) }}" style="display:inline"
                                  onsubmit="return confirm('Yakin ingin menolak peminjaman ini?')">
                                @csrf
                                <button type="submit" class="btn btn-reject">
                                    <i class="fas fa-times-circle"></i> Reject
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div>

            <!-- Status Card -->
            <div class="card">
                <div class="card-head">
                    <div class="card-head-icon" style="background:var(--accent-light)">
                        <i class="fas fa-flag" style="color:var(--accent)"></i>
                    </div>
                    <div class="card-head-title">Status Peminjaman</div>
                </div>
                <div class="card-body">
                    @if($borrowing->status === 'approved')
                        <div class="status-display" style="background:var(--blue-light); border-color:var(--blue-mid)">
                            <div class="status-icon-circle" style="background:var(--blue)"><i class="fas fa-check"></i></div>
                            <div class="status-tag" style="color:var(--blue)">Status</div>
                            <div class="status-label" style="color:var(--blue)">Disetujui</div>
                            <div class="status-hint" style="color:#3b82f6">Peminjaman telah disetujui</div>
                        </div>
                    @elseif($borrowing->status === 'rejected')
                        <div class="status-display" style="background:var(--red-bg); border-color:#fca5a5">
                            <div class="status-icon-circle" style="background:var(--red)"><i class="fas fa-times"></i></div>
                            <div class="status-tag" style="color:var(--red)">Status</div>
                            <div class="status-label" style="color:var(--red)">Ditolak</div>
                            <div class="status-hint" style="color:#ef4444">Peminjaman ditolak</div>
                        </div>
                    @elseif($borrowing->status === 'returned')
                        <div class="status-display" style="background:var(--accent-light); border-color:var(--accent-mid)">
                            <div class="status-icon-circle" style="background:var(--accent)"><i class="fas fa-check-double"></i></div>
                            <div class="status-tag" style="color:var(--accent)">Status</div>
                            <div class="status-label" style="color:var(--accent)">Dikembalikan</div>
                            <div class="status-hint" style="color:var(--accent)">Buku telah dikembalikan</div>
                        </div>
                    @else
                        <div class="status-display" style="background:var(--yellow-bg); border-color:#fcd34d">
                            <div class="status-icon-circle" style="background:var(--yellow)"><i class="fas fa-hourglass-half"></i></div>
                            <div class="status-tag" style="color:var(--yellow)">Status</div>
                            <div class="status-label" style="color:var(--yellow)">Pending</div>
                            <div class="status-hint" style="color:var(--yellow)">Menunggu persetujuan</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Timeline Card -->
            <div class="card">
                <div class="card-head">
                    <div class="card-head-icon" style="background:var(--accent-light)">
                        <i class="fas fa-clock" style="color:var(--accent)"></i>
                    </div>
                    <div class="card-head-title">Timeline</div>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--accent-light)">
                                <i class="fas fa-plus" style="color:var(--accent)"></i>
                            </div>
                            <div>
                                <div class="tl-title">Peminjaman dibuat</div>
                                <div class="tl-time">{{ $borrowing->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>

                        @if($borrowing->status === 'approved' || $borrowing->status === 'returned')
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--blue-light)">
                                <i class="fas fa-check" style="color:var(--blue)"></i>
                            </div>
                            <div>
                                <div class="tl-title">Disetujui</div>
                                <div class="tl-time">—</div>
                            </div>
                        </div>
                        @endif

                        @if($borrowing->status === 'rejected')
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--red-bg)">
                                <i class="fas fa-times" style="color:var(--red)"></i>
                            </div>
                            <div>
                                <div class="tl-title">Ditolak</div>
                                <div class="tl-time">—</div>
                            </div>
                        </div>
                        @endif

                        @if($borrowing->returned_at)
                        <div class="tl-item">
                            <div class="tl-dot" style="background:var(--accent-light)">
                                <i class="fas fa-check-double" style="color:var(--accent)"></i>
                            </div>
                            <div>
                                <div class="tl-title">Buku dikembalikan</div>
                                <div class="tl-time">{{ \Carbon\Carbon::parse($borrowing->returned_at)->format('d M Y, H:i') }}</div>
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