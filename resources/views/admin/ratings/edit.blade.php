<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Ulasan | Admin</title>
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
        .nav-link:hover { background: var(--bg); color: var(--text); transform: translateX(3px); }
        .nav-link.active { background: var(--blue-light); color: var(--blue); font-weight: 600; }

        .sidebar-footer { padding: 12px; border-top: 1px solid var(--border); }

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
        main { flex: 1; padding: 36px 40px; overflow-y: auto; }

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

        /* Layout: form + side info */
        .form-layout {
            display: grid;
            grid-template-columns: 1fr 240px;
            gap: 24px;
            align-items: start;
            max-width: 960px;
        }

        /* Card */
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
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .card-head-title { font-size: 14px; font-weight: 700; color: var(--text); }
        .card-head-sub { font-size: 12px; color: var(--muted); margin-top: 1px; }

        .card-body { padding: 24px; display: flex; flex-direction: column; gap: 18px; }

        .card-footer {
            padding: 18px 24px;
            border-top: 1px solid var(--border);
            background: #fafbff;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Form elements */
        .form-group { display: flex; flex-direction: column; gap: 7px; }

        .form-label {
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-label i { color: var(--blue); font-size: 13px; width: 14px; text-align: center; }
        .form-label .req { color: var(--red); }

        .input-wrap { position: relative; }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 13px;
            pointer-events: none;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 10px 13px 10px 38px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 13.5px;
            font-family: inherit;
            color: var(--text);
            background: var(--surface);
            outline: none;
            transition: border .15s, box-shadow .15s;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(37,99,235,.1);
        }

        .form-input.readonly {
            background: var(--bg);
            color: var(--muted);
            cursor: not-allowed;
        }

        .form-textarea {
            padding-left: 13px;
            resize: none;
            line-height: 1.6;
        }

        .form-select { appearance: none; cursor: pointer; }

        .select-wrap { position: relative; }
        .select-wrap .select-chevron {
            position: absolute;
            right: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--muted);
            font-size: 11px;
            pointer-events: none;
        }

        /* Readonly display */
        .readonly-display {
            padding: 10px 13px 10px 38px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 13.5px;
            color: var(--muted);
            background: var(--bg);
            position: relative;
        }

        .readonly-display i.rd-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 13px;
            color: #d1d5db;
        }

        /* Star selector */
        .star-selector {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .star-option { display: none; }

        .star-option-label {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: border .15s, background .15s, color .15s;
            color: var(--muted);
            background: var(--bg);
            user-select: none;
        }

        .star-option-label i { color: #d1d5db; font-size: 14px; transition: color .15s; }

        .star-option:checked + .star-option-label {
            border-color: #f59e0b;
            background: #fef3c7;
            color: #b45309;
        }

        .star-option:checked + .star-option-label i { color: #f59e0b; }

        .star-option-label:hover {
            border-color: #f59e0b;
            background: #fffbeb;
            color: #b45309;
        }

        .star-option-label:hover i { color: #f59e0b; }

        /* Buttons */
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

        .btn-save {
            background: var(--blue);
            color: #fff;
            box-shadow: 0 2px 8px rgba(37,99,235,.25);
        }
        .btn-save:hover { background: #1d4ed8; box-shadow: 0 4px 14px rgba(37,99,235,.35); }

        .btn-cancel {
            background: var(--bg);
            color: var(--text);
            border: 1.5px solid var(--border);
        }
        .btn-cancel:hover { background: #eaecf1; }

        /* Right side card — user info */
        .info-side .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
            padding: 24px 20px;
        }

        .avatar-wrap {
            width: 90px; height: 90px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            display: flex; align-items: center; justify-content: center;
            font-size: 34px;
            font-weight: 800;
            color: #fff;
            box-shadow: var(--shadow-md);
            flex-shrink: 0;
        }

        .info-user-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
            text-align: center;
        }

        .info-user-email {
            font-size: 11.5px;
            color: var(--muted);
            text-align: center;
            margin-top: -8px;
        }

        .info-divider {
            width: 100%;
            border: none;
            border-top: 1px solid var(--border);
            margin: 2px 0;
        }

        .info-meta-item {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .info-meta-label {
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--muted);
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .info-meta-label i { color: var(--blue); font-size: 10px; }
        .info-meta-value { font-size: 13px; font-weight: 600; color: var(--text); }

        .info-hint {
            font-size: 11.5px;
            color: var(--muted);
            text-align: center;
            line-height: 1.5;
            padding-top: 4px;
        }
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
        <a href="{{ route('admin.books.index') }}" class="nav-link">
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

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('admin.ratings.index') }}">
            <i class="fas fa-star"></i> Ulasan Buku
        </a>
        <i class="fas fa-chevron-right sep"></i>
        <span>Edit Ulasan</span>
    </div>

    <div class="page-title">Edit Ulasan</div>
    <div class="page-sub">Perbarui rating dan teks ulasan pengguna</div>

    <form action="{{ route('admin.ratings.update', $rating->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-layout">

            <!-- LEFT: Main form -->
            <div class="card">
                <div class="card-head">
                    <div class="card-head-icon" style="background:#fef3c7">
                        <i class="fas fa-edit" style="color:#d97706; font-size:15px"></i>
                    </div>
                    <div>
                        <div class="card-head-title">Form Edit Ulasan</div>
                        <div class="card-head-sub">ID: #{{ $rating->id }}</div>
                    </div>
                </div>

                <div class="card-body">

                    <!-- User (readonly) -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-user"></i> User
                        </label>
                        <div style="position:relative">
                            <i class="fas fa-user input-icon"></i>
                            <input type="text"
                                   value="{{ $rating->user->name ?? '-' }}"
                                   class="form-input readonly"
                                   readonly>
                        </div>
                    </div>

                    <!-- Buku (readonly) -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-book"></i> Buku
                        </label>
                        <div style="position:relative">
                            <i class="fas fa-book input-icon"></i>
                            <input type="text"
                                   value="{{ $rating->book->judul ?? '-' }}"
                                   class="form-input readonly"
                                   readonly>
                        </div>
                    </div>

                    <!-- Rating -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-star"></i> Rating <span class="req">*</span>
                        </label>
                        <div class="star-selector">
                            @for($i = 1; $i <= 5; $i++)
                                <input type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}"
                                       class="star-option"
                                       {{ $rating->rating == $i ? 'checked' : '' }} required>
                                <label for="star{{ $i }}" class="star-option-label">
                                    <i class="fas fa-star"></i> {{ $i }}
                                </label>
                            @endfor
                        </div>
                    </div>

                    <!-- Ulasan -->
                    <div class="form-group">
                        <label class="form-label" for="ulasan">
                            <i class="fas fa-align-left"></i> Teks Ulasan
                        </label>
                        <textarea id="ulasan" name="ulasan" rows="5"
                                  class="form-textarea"
                                  placeholder="Tulis ulasan buku…">{{ old('ulasan', $rating->ulasan) }}</textarea>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.ratings.index') }}" class="btn btn-cancel">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </div>

            <!-- RIGHT: User info panel -->
            <div class="card info-side">
                <div class="card-head" style="padding:16px 20px">
                    <div class="card-head-icon" style="background:var(--blue-light); width:32px; height:32px; border-radius:8px">
                        <i class="fas fa-user" style="color:var(--blue); font-size:13px"></i>
                    </div>
                    <div class="card-head-title" style="font-size:13px">Info Pengguna</div>
                </div>

                <div class="card-body">
                    <div class="avatar-wrap">
                        {{ strtoupper(substr($rating->user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="info-user-name">{{ $rating->user->name ?? '-' }}</div>
                    @if(isset($rating->user->email))
                        <div class="info-user-email">{{ $rating->user->email }}</div>
                    @endif

                    <hr class="info-divider">

                    <div class="info-meta-item">
                        <div class="info-meta-label"><i class="fas fa-book"></i> Buku</div>
                        <div class="info-meta-value">{{ $rating->book->judul ?? '-' }}</div>
                    </div>

                    <div class="info-meta-item">
                        <div class="info-meta-label"><i class="fas fa-calendar"></i> Tanggal Ulasan</div>
                        <div class="info-meta-value">{{ $rating->created_at->format('d M Y') }}</div>
                    </div>

                    <div class="info-meta-item">
                        <div class="info-meta-label"><i class="fas fa-clock"></i> Jam</div>
                        <div class="info-meta-value">{{ $rating->created_at->format('H:i') }} WIB</div>
                    </div>

                    <p class="info-hint">Data user dan buku tidak dapat diubah melalui form ini.</p>
                </div>
            </div>
        </div>
    </form>
</main>
</body>
</html>