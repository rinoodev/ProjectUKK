<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku | Admin</title>
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
            overflow-y: auto;
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

        /* Layout: form + cover preview side by side */
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
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

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

        .form-input.no-icon,
        .form-select.no-icon,
        .form-textarea.no-icon {
            padding-left: 13px;
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

        /* File input */
        .file-input-wrap {
            border: 1.5px dashed var(--border);
            border-radius: 10px;
            padding: 14px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--bg);
            cursor: pointer;
            transition: border .15s;
        }

        .file-input-wrap:hover { border-color: var(--blue); }

        .file-input-wrap input[type="file"] {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
            left: 0; top: 0;
        }

        .file-input-inner { position: relative; flex: 1; }

        .file-input-label {
            font-size: 13px;
            color: var(--muted);
        }

        .file-input-label span { color: var(--blue); font-weight: 600; }

        /* Cover preview card */
        .cover-card .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
            padding: 24px 20px;
        }

        .cover-preview {
            width: 140px;
            height: 180px;
            border-radius: 10px;
            overflow: hidden;
            background: var(--bg);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,.08);
        }

        .cover-preview img {
            width: 100%; height: 100%;
            object-fit: cover;
        }

        .cover-preview .no-cover {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .cover-preview .no-cover i { font-size: 32px; color: #d1d5db; }
        .cover-preview .no-cover span { font-size: 11px; color: #d1d5db; }

        .cover-hint {
            font-size: 12px;
            color: var(--muted);
            text-align: center;
            line-height: 1.5;
        }

        /* ISBN pill in readonly */
        .isbn-display {
            font-family: 'Courier New', monospace;
            font-size: 13px;
            font-weight: 600;
            background: var(--bg);
            border: 1.5px solid var(--border);
            padding: 10px 13px;
            border-radius: 10px;
            color: var(--indigo);
            letter-spacing: .04em;
        }

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

    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ url('/admin/books') }}">
            <i class="fas fa-book"></i> Data Buku
        </a>
        <i class="fas fa-chevron-right sep"></i>
        <span>Edit Buku</span>
    </div>

    <div class="page-title">Edit Buku</div>
    <div class="page-sub">Perbarui informasi buku</div>

    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="card-head-title">Form Edit Buku</div>
                        <div class="card-head-sub">ID: #{{ $book->id }}</div>
                    </div>
                </div>

                <div class="card-body">

                    <!-- ISBN (readonly) -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-barcode"></i> ISBN
                        </label>
                        <div class="isbn-display">{{ $book->kode_buku }}</div>
                        <input type="hidden" name="kode_buku" value="{{ $book->kode_buku }}">
                    </div>

                    <!-- Judul -->
                    <div class="form-group">
                        <label class="form-label" for="judul">
                            <i class="fas fa-book"></i> Judul Buku <span class="req">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="fas fa-heading input-icon"></i>
                            <input type="text" id="judul" name="judul"
                                   value="{{ old('judul', $book->judul) }}"
                                   class="form-input" required
                                   placeholder="Masukkan judul buku">
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="form-group">
                        <label class="form-label" for="KategoriID">
                            <i class="fas fa-tags"></i> Kategori Buku <span class="req">*</span>
                        </label>
                        <div class="select-wrap">
                            <i class="fas fa-layer-group input-icon"></i>
                            <select id="KategoriID" name="KategoriID" class="form-select" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('KategoriID', $book->KategoriID) == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="fas fa-chevron-down select-chevron"></i>
                        </div>
                    </div>

                    <!-- Penulis -->
                    <div class="form-group">
                        <label class="form-label" for="penulis">
                            <i class="fas fa-user-edit"></i> Penulis <span class="req">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="fas fa-pen input-icon"></i>
                            <input type="text" id="penulis" name="penulis"
                                   value="{{ old('penulis', $book->penulis) }}"
                                   class="form-input" required
                                   placeholder="Nama penulis">
                        </div>
                    </div>

                    <!-- Penerbit -->
                    <div class="form-group">
                        <label class="form-label" for="penerbit">
                            <i class="fas fa-building"></i> Penerbit <span class="req">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="fas fa-industry input-icon"></i>
                            <input type="text" id="penerbit" name="penerbit"
                                   value="{{ old('penerbit', $book->penerbit) }}"
                                   class="form-input" required
                                   placeholder="Nama penerbit">
                        </div>
                    </div>

                    <!-- Tahun & Stok -->
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="tahun">
                                <i class="fas fa-calendar"></i> Tahun <span class="req">*</span>
                            </label>
                            <div class="input-wrap">
                                <i class="fas fa-calendar-alt input-icon"></i>
                                <input type="number" id="tahun" name="tahun"
                                       value="{{ old('tahun', $book->tahun) }}"
                                       class="form-input" required
                                       placeholder="Contoh: 2023">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="stok">
                                <i class="fas fa-layer-group"></i> Stok <span class="req">*</span>
                            </label>
                            <div class="input-wrap">
                                <i class="fas fa-cubes input-icon"></i>
                                <input type="number" id="stok" name="stok"
                                       value="{{ old('stok', $book->stok) }}"
                                       class="form-input" min="0" required
                                       placeholder="0">
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label class="form-label" for="deskripsi">
                            <i class="fas fa-align-left"></i> Deskripsi Buku
                        </label>
                        <textarea id="deskripsi" name="deskripsi" rows="4"
                                  class="form-textarea"
                                  placeholder="Tulis deskripsi singkat buku…">{{ old('deskripsi', $book->deskripsi) }}</textarea>
                    </div>

                    <!-- Cover upload -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-image"></i> Ganti Cover Buku
                        </label>
                        <div class="file-input-wrap">
                            <i class="fas fa-upload" style="color:var(--blue); font-size:18px; flex-shrink:0"></i>
                            <div class="file-input-inner">
                                <input type="file" name="image" accept="image/*"
                                       onchange="previewCover(event)">
                                <div class="file-input-label">
                                    <span>Pilih file</span> atau drag & drop di sini
                                </div>
                            </div>
                        </div>
                        <p style="font-size:12px; color:var(--muted); margin-top:4px">
                            Format: JPG, PNG, WEBP. Maks 2MB. Kosongkan jika tidak ingin mengganti cover.
                        </p>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ url('/admin/books') }}" class="btn btn-cancel">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </div>

            <!-- RIGHT: Cover preview -->
            <div class="card cover-card">
                <div class="card-head" style="padding:16px 20px">
                    <div class="card-head-icon" style="background:var(--blue-light); width:32px; height:32px; border-radius:8px">
                        <i class="fas fa-image" style="color:var(--blue); font-size:13px"></i>
                    </div>
                    <div class="card-head-title" style="font-size:13px">Preview Cover</div>
                </div>

                <div class="card-body">
                    <div class="cover-preview" id="coverPreviewBox">
                        @if($book->image)
                            <img id="coverImg" src="{{ asset('storage/' . $book->image) }}" alt="Cover">
                        @else
                            <div class="no-cover" id="noCover">
                                <i class="fas fa-book-open"></i>
                                <span>Belum ada cover</span>
                            </div>
                            <img id="coverImg" src="" alt="Cover" style="display:none; width:100%; height:100%; object-fit:cover">
                        @endif
                    </div>
                    <p class="cover-hint">Cover buku akan tampil di sini setelah memilih file baru.</p>
                </div>
            </div>

        </div>
    </form>

</main>

<script>
function previewCover(e) {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(ev) {
        const img = document.getElementById('coverImg');
        const noCover = document.getElementById('noCover');

        img.src = ev.target.result;
        img.style.display = 'block';
        if (noCover) noCover.style.display = 'none';
    };
    reader.readAsDataURL(file);
}
</script>

</body>
</html>