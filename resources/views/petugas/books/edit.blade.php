<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku | Petugas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --accent: #16a34a; --accent-light: #dcfce7; --accent-mid: #86efac; --accent-dark: #15803d;
            --blue: #39eb25; --blue-light: #eff6ff; --blue-mid: #bfdbfe; --indigo: #4f46e5;
            --surface: #ffffff; --bg: #f4f6fb; --border: #e5e7eb; --text: #111827; --muted: #6b7280;
            --red: #dc2626; --red-bg: #fee2e2;
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

        /* Layout: form + preview */
        .layout { display: grid; grid-template-columns: 1fr 220px; gap: 20px; align-items: start; max-width: 860px; }

        /* Card */
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; box-shadow: var(--shadow); }
        .card-head { padding: 18px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; gap: 14px; }
        .card-head-icon { width: 40px; height: 40px; border-radius: 11px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
        .card-head-title { font-size: 14px; font-weight: 700; color: var(--text); }
        .card-head-sub { font-size: 12px; color: var(--muted); margin-top: 2px; }
        .card-body { padding: 24px; }

        /* Error alert */
        .alert-error { display: flex; gap: 12px; padding: 14px 16px; background: var(--red-bg); border: 1px solid #fca5a5; border-radius: 10px; margin-bottom: 20px; }
        .alert-error i { color: var(--red); flex-shrink: 0; margin-top: 1px; }
        .alert-error ul { list-style: disc; padding-left: 16px; }
        .alert-error ul li { font-size: 13px; color: var(--red); }

        /* Form fields */
        .field { margin-bottom: 18px; }
        .field:last-child { margin-bottom: 0; }
        .field-label { font-size: 13px; font-weight: 700; color: var(--text); margin-bottom: 7px; display: flex; align-items: center; gap: 6px; }
        .field-label i { font-size: 13px; color: var(--accent); }
        .field-hint { font-size: 12px; color: var(--muted); margin-top: 6px; display: flex; align-items: center; gap: 5px; }
        .field-hint i { color: #9ca3af; }

        .input-wrap { position: relative; }
        .input-icon { position: absolute; left: 13px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: 13px; pointer-events: none; }
        .textarea-icon { position: absolute; left: 13px; top: 14px; color: var(--muted); font-size: 13px; pointer-events: none; }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 10px 14px 10px 38px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 13.5px;
            font-family: inherit;
            color: var(--text);
            background: var(--surface);
            outline: none;
            transition: border .15s, box-shadow .15s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus,
        textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(22,163,74,.1);
        }

        /* Readonly field style */
        input[readonly] {
            background: var(--bg);
            color: var(--muted);
            cursor: not-allowed;
        }

        input[type="file"] {
            padding: 8px 14px 8px 38px;
            cursor: pointer;
            color: var(--muted);
        }

        input[type="file"]:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(22,163,74,.1); }

        textarea { resize: vertical; min-height: 90px; padding-top: 10px; }

        /* Select chevron */
        .select-wrap { position: relative; }
        .select-wrap::after { content: '\f078'; font-family: 'Font Awesome 6 Free'; font-weight: 900; font-size: 11px; color: var(--muted); position: absolute; right: 13px; top: 50%; transform: translateY(-50%); pointer-events: none; }
        .select-wrap select { appearance: none; -webkit-appearance: none; }

        /* 2-col grid */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        /* File upload area */
        .upload-area {
            border: 2px dashed var(--border);
            border-radius: 10px;
            padding: 18px;
            text-align: center;
            cursor: pointer;
            transition: border-color .15s, background .15s;
            position: relative;
            background: var(--bg);
        }
        .upload-area:hover { border-color: var(--accent); background: var(--accent-light); }
        .upload-area input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer;
            padding: 0; width: 100%; height: 100%;
        }
        .upload-icon { font-size: 24px; color: var(--muted); margin-bottom: 8px; }
        .upload-text { font-size: 13px; font-weight: 600; color: var(--muted); }
        .upload-hint { font-size: 11.5px; color: #9ca3af; margin-top: 4px; }

        /* Divider */
        .divider { border: none; border-top: 1px solid var(--border); margin: 20px 0; }

        /* Buttons */
        .btn-row { display: flex; gap: 10px; }
        .btn { display: inline-flex; align-items: center; gap: 7px; padding: 10px 22px; border-radius: 10px; font-size: 13.5px; font-weight: 700; font-family: inherit; border: none; cursor: pointer; text-decoration: none; transition: background .12s, transform .1s, box-shadow .12s; }
        .btn:hover { transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }
        .btn-save { background: var(--accent); color: #fff; flex: 1; justify-content: center; box-shadow: 0 2px 8px rgba(22,163,74,.25); }
        .btn-save:hover { background: var(--accent-dark); box-shadow: 0 4px 14px rgba(22,163,74,.3); }
        .btn-cancel { background: var(--bg); color: var(--text); border: 1.5px solid var(--border); }
        .btn-cancel:hover { background: #e5e7eb; }

        /* Cover preview card */
        .preview-card { position: sticky; top: 36px; }
        .preview-img-wrap {
            width: 100%; aspect-ratio: 3/4;
            border-radius: 12px;
            overflow: hidden;
            background: var(--bg);
            border: 1.5px dashed var(--border);
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            gap: 8px;
        }
        .preview-img-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .preview-placeholder { text-align: center; padding: 20px; }
        .preview-placeholder i { font-size: 36px; color: #d1d5db; margin-bottom: 8px; display: block; }
        .preview-placeholder p { font-size: 12px; color: var(--muted); font-style: italic; }
        .preview-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .06em; color: var(--muted); text-align: center; margin-top: 10px; }
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
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ url('/petugas/books') }}">
            <i class="fas fa-book"></i> Data Buku
        </a>
        <i class="fas fa-chevron-right sep"></i>
        <span>Edit Buku</span>
    </div>
    <div class="page-title">Edit Buku</div>
    <div class="page-sub">Perbarui informasi buku yang ada di koleksi perpustakaan</div>

    <div class="layout">

        <!-- FORM CARD -->
        <div class="card">
            <div class="card-head">
                <div class="card-head-icon" style="background:var(--accent-light)">
                    <i class="fas fa-pen-to-square" style="color:var(--accent)"></i>
                </div>
                <div>
                    <div class="card-head-title">Form Edit Buku</div>
                    <div class="card-head-sub">Perbarui informasi buku dengan benar</div>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('petugas.books.update', $book->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if($errors->any())
                    <div class="alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- ISBN -->
                    <div class="field">
                        <div class="field-label"><i class="fas fa-barcode"></i> ISBN</div>
                        <div class="input-wrap">
                            <i class="fas fa-barcode input-icon"></i>
                            <input type="text" name="kode_buku"
                                   value="{{ old('kode_buku', $book->kode_buku) }}"
                                   readonly>
                        </div>
                        <div class="field-hint"><i class="fas fa-lock"></i> ISBN tidak dapat diubah</div>
                    </div>

                    <!-- Judul -->
                    <div class="field">
                        <div class="field-label"><i class="fas fa-book"></i> Judul Buku</div>
                        <div class="input-wrap">
                            <i class="fas fa-book input-icon"></i>
                            <input type="text" name="judul"
                                   value="{{ old('judul', $book->judul) }}"
                                   placeholder="Masukkan judul buku" required>
                        </div>
                    </div>

                    <!-- Penulis -->
                    <div class="field">
                        <div class="field-label"><i class="fas fa-user-edit"></i> Penulis</div>
                        <div class="input-wrap">
                            <i class="fas fa-user-edit input-icon"></i>
                            <input type="text" name="penulis"
                                   value="{{ old('penulis', $book->penulis) }}"
                                   placeholder="Masukkan nama penulis" required>
                        </div>
                    </div>

                    <!-- Penerbit -->
                    <div class="field">
                        <div class="field-label"><i class="fas fa-building"></i> Penerbit</div>
                        <div class="input-wrap">
                            <i class="fas fa-building input-icon"></i>
                            <input type="text" name="penerbit"
                                   value="{{ old('penerbit', $book->penerbit) }}"
                                   placeholder="Masukkan nama penerbit" required>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="field">
                        <div class="field-label"><i class="fas fa-tags"></i> Kategori Buku</div>
                        <div class="select-wrap input-wrap">
                            <i class="fas fa-tags input-icon"></i>
                            <select name="KategoriID" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('KategoriID', $book->KategoriID) == $category->id ? 'selected' : '' }}>
                                        {{ $category->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Tahun & Stok -->
                    <div class="field grid-2">
                        <div>
                            <div class="field-label"><i class="fas fa-calendar"></i> Tahun Terbit</div>
                            <div class="input-wrap">
                                <i class="fas fa-calendar input-icon"></i>
                                <input type="number" name="tahun"
                                       value="{{ old('tahun', $book->tahun) }}"
                                       min="1900" max="{{ date('Y') }}"
                                       placeholder="{{ date('Y') }}" required>
                            </div>
                        </div>
                        <div>
                            <div class="field-label"><i class="fas fa-layer-group"></i> Stok</div>
                            <div class="input-wrap">
                                <i class="fas fa-layer-group input-icon"></i>
                                <input type="number" name="stok"
                                       value="{{ old('stok', $book->stok) }}"
                                       min="0" placeholder="10" required>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="field">
                        <div class="field-label"><i class="fas fa-align-left"></i> Deskripsi Buku</div>
                        <div class="input-wrap">
                            <i class="fas fa-align-left textarea-icon"></i>
                            <textarea name="deskripsi" placeholder="Tulis deskripsi singkat buku…">{{ old('deskripsi', $book->deskripsi) }}</textarea>
                        </div>
                    </div>

                    <!-- Cover -->
                    <div class="field">
                        <div class="field-label"><i class="fas fa-image"></i> Cover Buku</div>
                        <div class="upload-area" id="uploadArea">
                            <input type="file" name="image" accept="image/*"
                                   onchange="previewCover(event)">
                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                            <div class="upload-text">Klik atau drag foto cover baru</div>
                            <div class="upload-hint">JPG, PNG • Maksimal 2MB • Kosongkan jika tidak ingin mengubah</div>
                        </div>
                    </div>

                    <hr class="divider">

                    <div class="btn-row">
                        <button type="submit" class="btn btn-save">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('petugas.books.index') }}" class="btn btn-cancel">
                            <i class="fas fa-arrow-left"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- COVER PREVIEW -->
        <div class="preview-card">
            <div class="card">
                <div class="card-head">
                    <div class="card-head-icon" style="background:var(--bg)">
                        <i class="fas fa-image" style="color:var(--muted)"></i>
                    </div>
                    <div class="card-head-title">Preview Cover</div>
                </div>
                <div class="card-body">
                    <div class="preview-img-wrap" id="previewWrap">
                        @if($book->image)
                            <img id="previewImg"
                                 src="{{ asset('storage/' . $book->image) }}"
                                 alt="Preview Cover">
                            <div class="preview-placeholder" id="previewPlaceholder" style="display:none">
                                <i class="fas fa-book-open"></i>
                                <p>Belum ada cover</p>
                            </div>
                        @else
                            <img id="previewImg" src="" alt="Preview Cover" style="display:none">
                            <div class="preview-placeholder" id="previewPlaceholder">
                                <i class="fas fa-book-open"></i>
                                <p>Belum ada cover</p>
                            </div>
                        @endif
                    </div>
                    <div class="preview-label">Pratinjau Cover</div>
                </div>
            </div>
        </div>

    </div>
</main>

<script>
function previewCover(event) {
    const file = event.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        const img = document.getElementById('previewImg');
        const placeholder = document.getElementById('previewPlaceholder');
        const area = document.getElementById('uploadArea');
        img.src = e.target.result;
        img.style.display = 'block';
        placeholder.style.display = 'none';
        area.style.borderColor = 'var(--accent)';
        area.style.background = 'var(--accent-light)';
        area.querySelector('.upload-text').textContent = file.name;
    };
    reader.readAsDataURL(file);
}
</script>
</body>
</html>