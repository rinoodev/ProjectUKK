<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Akun | Admin</title>
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
            --red: #dc2626;
            --yellow: #d97706;
            --yellow-bg: #fffbeb;
            --purple: #7c3aed;
            --purple-bg: #f5f3ff;
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

        /* Layout: form + profile card side by side */
        .form-layout {
            display: grid;
            grid-template-columns: 1fr 220px;
            gap: 24px;
            align-items: start;
            max-width: 820px;
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

        /* Form */
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

        .form-input {
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

        .form-input:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(37,99,235,.1);
        }

        .form-input.readonly {
            background: var(--bg);
            color: var(--muted);
            cursor: not-allowed;
        }

        /* Profile card (right) */
        .profile-card .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
            padding: 28px 20px;
            text-align: center;
        }

        .avatar-xl {
            width: 72px; height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--blue), var(--indigo));
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 28px;
            font-weight: 800;
            box-shadow: 0 6px 16px rgba(79,70,229,.25);
        }

        .profile-name { font-size: 15px; font-weight: 800; color: var(--text); }
        .profile-email { font-size: 12px; color: var(--muted); margin-top: 2px; }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 700;
            margin-top: 4px;
        }

        .badge-petugas { background: var(--green-bg); color: var(--green); }
        .badge-admin   { background: var(--purple-bg); color: var(--purple); }
        .badge-user    { background: var(--blue-light); color: var(--blue); }

        .profile-hint {
            font-size: 11.5px;
            color: var(--muted);
            line-height: 1.5;
            border-top: 1px solid var(--border);
            padding-top: 14px;
            width: 100%;
            text-align: center;
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
        <a href="{{ route('admin.users') }}" class="nav-link active">
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
        <a href="{{ route('admin.ratings.index') }}" class="nav-link">
            <i class="fas fa-file-download"></i> Ulasan Buku
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
        <a href="{{ route('admin.users') }}">
            <i class="fas fa-users"></i> Manajemen User
        </a>
        <i class="fas fa-chevron-right sep"></i>
        <span>Edit Akun</span>
    </div>

    <div class="page-title">Edit Akun</div>
    <div class="page-sub">Ubah informasi akun pengguna</div>

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="form-layout">

            <!-- LEFT: Form -->
            <div class="card">
                <div class="card-head">
                    <div class="card-head-icon" style="background:#fef3c7">
                        <i class="fas fa-edit" style="color:#d97706; font-size:15px"></i>
                    </div>
                    <div>
                        <div class="card-head-title">Form Edit Akun</div>
                        <div class="card-head-sub">ID: #{{ $user->id }}</div>
                    </div>
                </div>

                <div class="card-body">

                    <!-- Nama -->
                    <div class="form-group">
                        <label class="form-label" for="name">
                            <i class="fas fa-user"></i> Nama Lengkap <span class="req">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="fas fa-id-card input-icon"></i>
                            <input type="text" id="name" name="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="form-input" required
                                   placeholder="Masukkan nama lengkap"
                                   oninput="updatePreview()">
                        </div>
                        @error('name')
                            <div style="display:flex; align-items:center; gap:5px; font-size:12.5px; color:var(--red); font-weight:500; margin-top:2px">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label" for="email">
                            <i class="fas fa-envelope"></i> Email <span class="req">*</span>
                        </label>
                        <div class="input-wrap">
                            <i class="fas fa-at input-icon"></i>
                            <input type="email" id="email" name="email"
                                   value="{{ old('email', $user->email) }}"
                                   class="form-input" required
                                   placeholder="contoh@email.com"
                                   oninput="updatePreviewEmail()">
                        </div>
                        @error('email')
                            <div style="display:flex; align-items:center; gap:5px; font-size:12.5px; color:var(--red); font-weight:500; margin-top:2px">
                                <i class="fas fa-exclamation-circle"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Role (readonly) -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-shield-alt"></i> Role
                        </label>
                        <div class="input-wrap">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="text"
                                   value="{{ ucfirst($user->role) }}"
                                   class="form-input readonly" readonly>
                        </div>
                        <p style="font-size:12px; color:var(--muted); margin-top:2px">
                            Role tidak dapat diubah melalui form ini.
                        </p>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-save">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.users') }}" class="btn btn-cancel">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </div>

            <!-- RIGHT: Profile preview -->
            <div class="card profile-card">
                <div class="card-head" style="padding:16px 20px">
                    <div class="card-head-icon" style="background:var(--blue-light); width:32px; height:32px; border-radius:8px">
                        <i class="fas fa-user" style="color:var(--blue); font-size:13px"></i>
                    </div>
                    <div class="card-head-title" style="font-size:13px">Preview Akun</div>
                </div>

                <div class="card-body">
                    <div class="avatar-xl" id="previewAvatar">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="profile-name" id="previewName">{{ $user->name }}</div>
                        <div class="profile-email" id="previewEmail">{{ $user->email }}</div>
                    </div>

                    @if($user->role === 'admin')
                        <span class="role-badge badge-admin">
                            <i class="fas fa-shield-alt" style="font-size:10px"></i> Admin
                        </span>
                    @elseif($user->role === 'petugas')
                        <span class="role-badge badge-petugas">
                            <i class="fas fa-user-check" style="font-size:10px"></i> Petugas
                        </span>
                    @else
                        <span class="role-badge badge-user">
                            <i class="fas fa-user" style="font-size:10px"></i> {{ ucfirst($user->role) }}
                        </span>
                    @endif

                    <p class="profile-hint">Preview akan terupdate saat Anda mengetik.</p>
                </div>
            </div>

        </div>
    </form>

</main>

<script>
function updatePreview() {
    const val = document.getElementById('name').value;
    document.getElementById('previewName').textContent = val || '—';
    document.getElementById('previewAvatar').textContent = val ? val.charAt(0).toUpperCase() : '?';
}

function updatePreviewEmail() {
    const val = document.getElementById('email').value;
    document.getElementById('previewEmail').textContent = val || '—';
}
</script>
</body>
</html>