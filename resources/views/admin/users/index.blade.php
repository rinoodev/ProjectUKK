<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen User | Admin</title>
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
            --yellow: #d97706;
            --yellow-bg: #fffbeb;
            --red: #dc2626;
            --red-bg: #fee2e2;
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
            z-index: 40;
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

        /* Page header */
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

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--blue);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            text-decoration: none;
            transition: background .15s, transform .1s, box-shadow .15s;
            box-shadow: 0 2px 8px rgba(37,99,235,.25);
            white-space: nowrap;
        }

        .btn-add:hover { background: #1d4ed8; transform: translateY(-1px); box-shadow: 0 4px 14px rgba(37,99,235,.35); }
        .btn-add:active { transform: translateY(0); }

        /* Flash */
        .flash {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 24px;
            animation: fadeDown .3s ease;
        }

        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .flash-success { background: var(--green-bg); border: 1px solid #86efac; color: var(--green); }
        .flash-error   { background: var(--red-bg);   border: 1px solid #fca5a5; color: var(--red); }

        /* Section header */
        .section-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
        }

        .section-bar {
            width: 4px; height: 20px;
            border-radius: 4px;
            flex-shrink: 0;
        }

        .section-title { font-size: 15px; font-weight: 700; color: var(--text); }

        .section-count {
            display: inline-flex;
            align-items: center;
            padding: 2px 9px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 700;
        }

        section { margin-bottom: 32px; }

        /* Card */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }

        /* Table */
        table { width: 100%; border-collapse: collapse; }

        thead tr {
            background: #f9fafb;
            border-bottom: 1px solid var(--border);
        }

        th {
            padding: 12px 20px;
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
            padding: 13px 20px;
            font-size: 13.5px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
        }

        tbody tr { transition: background .12s; }
        tbody tr:hover { background: #fafbff; }
        tbody tr:last-child td { border-bottom: none; }

        /* User cell */
        .user-cell { display: flex; align-items: center; gap: 10px; }

        .avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .avatar-admin   { background: linear-gradient(135deg, var(--purple), #6d28d9); }
        .avatar-petugas { background: linear-gradient(135deg, var(--green), #15803d); }
        .avatar-user    { background: linear-gradient(135deg, var(--blue), var(--indigo)); }

        .user-name  { font-weight: 600; color: var(--text); }
        .user-email { font-size: 12px; color: var(--muted); margin-top: 1px; }

        /* Role badge */
        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 700;
        }

        .badge-admin   { background: var(--purple-bg); color: var(--purple); }
        .badge-petugas { background: var(--green-bg);  color: var(--green); }
        .badge-user    { background: var(--blue-light); color: var(--blue); }

        /* Locked badge */
        .locked-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 8px;
            font-size: 11.5px;
            font-weight: 600;
            background: var(--bg);
            color: #9ca3af;
            border: 1px solid var(--border);
        }

        /* Action buttons */
        .action-cell { display: flex; align-items: center; justify-content: center; gap: 6px; }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 600;
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

        .btn-edit   { background: var(--yellow-bg); color: var(--yellow); }
        .btn-edit:hover { background: #fde68a; }

        .btn-delete { background: var(--red-bg); color: var(--red); }
        .btn-delete:hover { background: #fecaca; }

        /* Empty state */
        .empty-state { padding: 48px 20px; text-align: center; }
        .empty-state i { font-size: 36px; color: #d1d5db; margin-bottom: 10px; display: block; }
        .empty-state p { color: var(--muted); font-size: 13.5px; }
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

    <!-- Flash messages -->
    @if(session('success'))
    <div class="flash flash-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="flash flash-error">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <div class="page-title">Manajemen User</div>
            <div class="page-sub">Kelola data pengguna dan akses sistem</div>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> Tambah Akun
        </a>
    </div>

    <!-- ── ADMIN ── -->
    <section>
        <div class="section-head">
            <div class="section-bar" style="background:var(--purple)"></div>
            <div class="section-title">Data Admin</div>
            <span class="section-count" style="background:var(--purple-bg); color:var(--purple)">
                {{ $admins->count() }}
            </span>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Role</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($admins as $admin)
                    <tr>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-admin">
                                    {{ strtoupper(substr($admin->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="user-name">{{ $admin->name }}</div>
                                    <div class="user-email">{{ $admin->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="role-badge badge-admin">
                                <i class="fas fa-shield-alt" style="font-size:10px"></i> Admin
                            </span>
                        </td>
                        <td style="text-align:center">
                            <span class="locked-badge">
                                <i class="fas fa-lock" style="font-size:10px"></i> Terkunci
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            <div class="empty-state">
                                <i class="fas fa-user-slash"></i>
                                <p>Tidak ada data admin</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- ── PETUGAS ── -->
    <section>
        <div class="section-head">
            <div class="section-bar" style="background:var(--green)"></div>
            <div class="section-title">Data Petugas</div>
            <span class="section-count" style="background:var(--green-bg); color:var(--green)">
                {{ $petugas->count() }}
            </span>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Role</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($petugas as $user)
                    <tr>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-petugas">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="user-name">{{ $user->name }}</div>
                                    <div class="user-email">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="role-badge badge-petugas">
                                <i class="fas fa-user-check" style="font-size:10px"></i> Petugas
                            </span>
                        </td>
                        <td>
                            <div class="action-cell">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn-action btn-detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-action btn-edit">
                                    <i class="fas fa-pen"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline"
                                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            <div class="empty-state">
                                <i class="fas fa-user-slash"></i>
                                <p>Tidak ada data petugas</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <!-- ── USER ── -->
    <section>
        <div class="section-head">
            <div class="section-bar" style="background:var(--blue)"></div>
            <div class="section-title">Data User</div>
            <span class="section-count" style="background:var(--blue-light); color:var(--blue)">
                {{ $users->count() }}
            </span>
        </div>

        <div class="card">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Role</th>
                        <th style="text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>
                            <div class="user-cell">
                                <div class="avatar avatar-user">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="user-name">{{ $user->name }}</div>
                                    <div class="user-email">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="role-badge badge-user">
                                <i class="fas fa-user" style="font-size:10px"></i> User
                            </span>
                        </td>
                        <td>
                            <div class="action-cell">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn-action btn-detail">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display:inline"
                                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            <div class="empty-state">
                                <i class="fas fa-user-slash"></i>
                                <p>Tidak ada data user</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</main>
</body>
</html>