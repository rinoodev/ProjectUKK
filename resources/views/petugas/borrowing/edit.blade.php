<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Peminjaman | Petugas</title>
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

        .breadcrumb { display: flex; align-items: center; gap: 6px; font-size: 12.5px; color: var(--muted); margin-bottom: 16px; }
        .breadcrumb a { color: var(--muted); text-decoration: none; transition: color .15s; }
        .breadcrumb a:hover { color: var(--accent); }
        .breadcrumb i.sep { font-size: 9px; color: #d1d5db; }
        .page-title { font-size: 26px; font-weight: 800; color: var(--text); }
        .page-sub { font-size: 13px; color: var(--muted); margin-top: 4px; margin-bottom: 28px; }

        /* Card */
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; box-shadow: var(--shadow); max-width: 640px; }

        .card-head { padding: 18px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 14px; }
        .card-head-icon { width: 40px; height: 40px; border-radius: 11px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
        .card-head-title { font-size: 14px; font-weight: 700; color: var(--text); }
        .card-head-sub { font-size: 12px; color: var(--muted); margin-top: 2px; }

        .card-body { padding: 24px; }

        /* Info strip (user & buku read-only) */
        .info-strip {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            padding: 14px 16px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 12px;
            margin-bottom: 20px;
        }
        .info-strip-item {}
        .info-strip-label { font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); margin-bottom: 6px; }
        .info-strip-val { display: flex; align-items: center; gap: 8px; }
        .mini-avatar { width: 28px; height: 28px; border-radius: 50%; background: linear-gradient(135deg, var(--blue), var(--indigo)); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 11px; font-weight: 700; flex-shrink: 0; }
        .info-strip-name { font-size: 13.5px; font-weight: 700; color: var(--text); }

        /* Form fields */
        .field { margin-bottom: 20px; }
        .field:last-child { margin-bottom: 0; }
        .field-label { font-size: 13px; font-weight: 700; color: var(--text); margin-bottom: 7px; display: flex; align-items: center; gap: 6px; }
        .field-label i { font-size: 13px; color: var(--accent); }
        .field-hint { font-size: 12px; color: var(--muted); margin-top: 6px; display: flex; align-items: center; gap: 5px; }
        .field-hint i { color: #9ca3af; }

        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: 13px; pointer-events: none; }

        select, input[type="date"] {
            width: 100%;
            padding: 10px 14px 10px 38px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 13.5px;
            font-family: inherit;
            color: var(--text);
            background: var(--surface);
            outline: none;
            appearance: none;
            -webkit-appearance: none;
            transition: border .15s, box-shadow .15s;
        }

        select:focus, input[type="date"]:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(22,163,74,.1);
        }

        /* Custom chevron for select */
        .select-wrap { position: relative; }
        .select-wrap::after {
            content: '\f078';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 11px;
            color: var(--muted);
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        /* Divider */
        .divider { border: none; border-top: 1px solid var(--border); margin: 24px 0; }

        /* Buttons */
        .btn-row { display: flex; gap: 10px; }
        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 10px 22px; border-radius: 10px;
            font-size: 13.5px; font-weight: 700;
            font-family: inherit; border: none; cursor: pointer;
            text-decoration: none;
            transition: background .12s, transform .1s, box-shadow .12s;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }
        .btn-save { background: var(--accent); color: #fff; flex: 1; justify-content: center; box-shadow: 0 2px 8px rgba(22,163,74,.25); }
        .btn-save:hover { background: var(--accent-dark); box-shadow: 0 4px 14px rgba(22,163,74,.3); }
        .btn-cancel { background: var(--bg); color: var(--text); border: 1.5px solid var(--border); }
        .btn-cancel:hover { background: #e5e7eb; }

        /* Info alert */
        .alert-info {
            display: flex;
            gap: 14px;
            padding: 16px 18px;
            background: var(--blue-light);
            border: 1px solid var(--blue-mid);
            border-radius: 12px;
            margin-top: 20px;
            max-width: 640px;
        }
        .alert-info-icon { color: var(--blue); font-size: 16px; flex-shrink: 0; margin-top: 1px; }
        .alert-info-title { font-size: 13px; font-weight: 700; color: #1e40af; margin-bottom: 6px; }
        .alert-info-list { list-style: none; padding: 0; }
        .alert-info-list li { font-size: 12.5px; color: #1d4ed8; padding: 2px 0; display: flex; align-items: flex-start; gap: 6px; }
        .alert-info-list li::before { content: '•'; flex-shrink: 0; margin-top: 1px; }
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
    <div class="breadcrumb">
        <a href="{{ route('petugas.borrowings.index') }}"><i class="fas fa-handshake"></i> Riwayat Peminjaman</a>
        <i class="fas fa-chevron-right sep"></i>
        <span style="color:var(--text); font-weight:600">Edit Peminjaman</span>
    </div>

    <div class="page-title">Edit Peminjaman</div>
    <div class="page-sub">Perbarui status dan informasi peminjaman buku</div>

    <div class="card">
        <div class="card-head">
            <div class="card-head-icon" style="background:var(--yellow-bg)">
                <i class="fas fa-edit" style="color:var(--yellow)"></i>
            </div>
            <div>
                <div class="card-head-title">Form Edit Peminjaman</div>
                <div class="card-head-sub">ID Peminjaman: #{{ $borrowing->id }}</div>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('petugas.borrowings.update', $borrowing->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Info strip: read only -->
                <div class="info-strip">
                    <div class="info-strip-item">
                        <div class="info-strip-label">Peminjam</div>
                        <div class="info-strip-val">
                            <div class="mini-avatar">{{ strtoupper(substr($borrowing->user->name, 0, 1)) }}</div>
                            <span class="info-strip-name">{{ $borrowing->user->name }}</span>
                        </div>
                    </div>
                    <div class="info-strip-item">
                        <div class="info-strip-label">Buku</div>
                        <div class="info-strip-val">
                            <i class="fas fa-book" style="color:var(--muted); font-size:13px"></i>
                            <span class="info-strip-name">{{ $borrowing->book->judul }}</span>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="field">
                    <div class="field-label">
                        <i class="fas fa-info-circle"></i> Status Peminjaman
                    </div>
                    <div class="select-wrap input-wrap">
                        <i class="fas fa-flag input-icon"></i>
                        <select name="status">
                            <option value="pending"   {{ $borrowing->status === 'pending'   ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="approved"  {{ $borrowing->status === 'approved'  ? 'selected' : '' }}>✅ Approved (Disetujui)</option>
                            <option value="rejected"  {{ $borrowing->status === 'rejected'  ? 'selected' : '' }}>❌ Rejected (Ditolak)</option>
                            <option value="returned"  {{ $borrowing->status === 'returned'  ? 'selected' : '' }}>✔️ Returned (Dikembalikan)</option>
                        </select>
                    </div>
                    <div class="field-hint"><i class="fas fa-lightbulb"></i> Pilih status yang sesuai dengan kondisi peminjaman saat ini</div>
                </div>

                <!-- Tanggal Kembali -->
                <div class="field">
                    <div class="field-label">
                        <i class="fas fa-calendar-check"></i> Tanggal Kembali
                    </div>
                    <div class="input-wrap">
                        <i class="fas fa-calendar-alt input-icon"></i>
                        <input type="date" name="returned_at" value="{{ $borrowing->returned_at }}">
                    </div>
                    <div class="field-hint"><i class="fas fa-lightbulb"></i> Kosongkan jika buku belum dikembalikan</div>
                </div>

                <hr class="divider">

                <div class="btn-row">
                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('petugas.borrowings.index') }}" class="btn btn-cancel">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Info alert -->
    <div class="alert-info">
        <i class="fas fa-info-circle alert-info-icon"></i>
        <div>
            <div class="alert-info-title">Informasi Penting</div>
            <ul class="alert-info-list">
                <li>Ubah status menjadi "Returned" saat buku sudah dikembalikan</li>
                <li>Isi tanggal kembali sesuai dengan waktu pengembalian aktual</li>
                <li>Status "Rejected" akan membatalkan peminjaman ini</li>
            </ul>
        </div>
    </div>
</main>
</body>
</html>