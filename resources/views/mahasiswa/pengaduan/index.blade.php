<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengaduan | SIPAS Kampus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --blue: #164780;
            --blue-dark: #103766;
            --blue-light: #eaf3ff;
            --yellow: #ffcf32;
            --yellow-hover: #f5c421;
            --text: #183456;
            --muted: #71839d;
            --border: #e1eaf5;
            --bg: #f2f7fd;
            --white: #ffffff;
            --danger: #dc4545;
            --success: #16a34a;
            --warning: #d97706;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background: var(--bg);
            font-size: 14px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            min-height: 76px;
            background: var(--white);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 4%;
            gap: 24px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .brand { display: flex; align-items: center; gap: 12px; text-decoration: none; flex-shrink: 0; }
        .brand-logo { width: 44px; height: 44px; display: grid; place-items: center; background: var(--blue); color: var(--yellow); border-radius: 50%; font-size: 21px; flex-shrink: 0; }
        .brand-name { font-size: 18px; font-weight: 800; color: var(--blue); letter-spacing: -.5px; }
        .brand-subtitle { margin-top: 2px; font-size: 10px; color: var(--muted); }

        .nav-menu { position: absolute; left: 50%; transform: translateX(-50%); display: flex; align-items: center; gap: 10px; }
        .nav-link { display: flex; align-items: center; justify-content: center; gap: 9px; padding: 12px 16px; border-radius: 13px; font-weight: 600; color: #516783; text-decoration: none; transition: .2s; white-space: nowrap; }
        .nav-link:hover { background: var(--blue-light); color: var(--blue); }
        .nav-link.active { color: var(--blue); position: relative; }
        .nav-link.active::after { content: ""; height: 3px; width: 60%; position: absolute; bottom: 2px; left: 20%; background: var(--yellow); border-radius: 5px; }

        .topbar-actions { display: flex; align-items: center; gap: 18px; }
        .profile-wrap { position: relative; }
        .profile-trigger { border: 0; background: transparent; display: flex; align-items: center; gap: 10px; color: var(--blue); cursor: pointer; }
        .avatar { width: 42px; height: 42px; display: grid; place-items: center; flex-shrink: 0; border-radius: 50%; background: var(--blue); color: white; font-size: 17px; font-weight: 700; }

        .profile-menu { position: absolute; top: calc(100% + 18px); right: 0; width: 255px; background: white; border-radius: 16px; padding: 12px; box-shadow: 0 18px 50px rgba(22,71,128,.16); display: none; z-index: 200; }
        .profile-menu.show { display: block; animation: appear .18s ease-out; }
        @keyframes appear { from { opacity: 0; transform: translateY(-6px); } to { opacity: 1; transform: translateY(0); } }

        .profile-summary { display: flex; gap: 12px; align-items: center; padding: 8px 5px 16px; border-bottom: 1px solid var(--border); margin-bottom: 8px; }
        .profile-summary .avatar { width: 46px; height: 46px; }
        .profile-name { font-weight: 700; overflow-wrap: anywhere; }
        .profile-meta { font-size: 11px; color: var(--muted); margin-top: 5px; }
        .profile-item { display: flex; gap: 12px; align-items: center; width: 100%; padding: 12px 9px; border-radius: 9px; border: 0; background: white; color: var(--text); text-align: left; cursor: pointer; }
        .profile-item:hover { background: var(--blue-light); }
        .profile-item.logout { color: #dc4545; margin-top: 5px; padding-top: 15px; }

        .page-container { width: min(1000px, 100%); margin: 0 auto; padding: 32px 20px 48px; flex: 1; }
        .content-card { background: var(--white); border: 1px solid var(--border); border-radius: 20px; padding: 36px; box-shadow: 0 10px 30px rgba(22, 71, 128, 0.04); }

        .card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid var(--border); }
        .card-title-wrap { display: flex; align-items: center; gap: 12px; }
        .card-icon { width: 40px; height: 40px; display: grid; place-items: center; background: var(--blue-light); color: var(--blue); border-radius: 12px; font-size: 18px; }
        .card-title { font-size: 22px; font-weight: 800; color: var(--blue); letter-spacing: -.4px; }

        .btn-add { display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; background: var(--yellow); color: var(--blue-dark); border-radius: 30px; font-weight: 700; text-decoration: none; transition: .2s; }
        .btn-add:hover { background: var(--yellow-hover); }

        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: var(--success); padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; font-weight: 600; }
        .alert-error { background: #fdf2f2; border: 1px solid #f8d7da; color: var(--danger); padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; font-weight: 600; }

        .table-responsive { width: 100%; overflow-x: auto; }
        .data-table { width: 100%; border-collapse: collapse; text-align: left; }
        .data-table th, .data-table td { padding: 14px 16px; border-bottom: 1px solid var(--border); }
        .data-table th { background: #fafcff; font-weight: 700; color: var(--blue); font-size: 13px; }
        .data-table tbody tr:hover { background: #f8fafc; }

        .status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; }
        .badge-verifikasi { background: #fef3c7; color: var(--warning); }
        .badge-proses { background: #e0f2fe; color: #0284c7; }
        .badge-selesai { background: #dcfce7; color: var(--success); }

        .action-btns { display: flex; align-items: center; gap: 8px; }
        .btn-action { display: inline-grid; place-items: center; width: 34px; height: 34px; border-radius: 8px; border: 0; text-decoration: none; cursor: pointer; transition: .2s; }
        .btn-view { background: var(--blue-light); color: var(--blue); }
        .btn-view:hover { background: var(--blue); color: white; }
        .btn-edit { background: #fef3c7; color: var(--warning); }
        .btn-edit:hover { background: var(--warning); color: white; }
        .btn-delete { background: #fee2e2; color: var(--danger); }
        .btn-delete:hover { background: var(--danger); color: white; }

        .empty-state { text-align: center; padding: 40px 20px; color: var(--muted); }
        .empty-state i { font-size: 48px; margin-bottom: 12px; opacity: .5; }

        .footer { padding: 24px 0; text-align: center; color: var(--muted); font-size: 11px; margin-top: auto; }
    </style>
</head>
<body>

    @php
        $student = Auth::user();
        $studentName = $student->name ?? 'Mahasiswa';
        $initial = strtoupper(substr($studentName, 0, 1));
    @endphp

    <header class="topbar">
        <a href="{{ route('home') }}" class="brand">
            <div class="brand-logo"><i class="fa-solid fa-graduation-cap"></i></div>
            <div>
                <div class="brand-name">SIPAS KAMPUS</div>
                <div class="brand-subtitle">Sistem Informasi Pengaduan dan Layanan Aspirasi Kampus</div>
            </div>
        </a>

        <nav class="nav-menu">
            <a href="{{ route('home') }}" class="nav-link"><i class="fa-solid fa-house"></i> Beranda</a>
            <a href="{{ route('pengaduan.create') }}" class="nav-link"><i class="fa-regular fa-file-lines"></i> Buat Pengaduan</a>
            <a href="{{ route('pengaduan.index') }}" class="nav-link active"><i class="fa-regular fa-rectangle-list"></i> Pengaduan Saya</a>
        </nav>

        <div class="topbar-actions">
            <div class="profile-wrap">
                <button class="profile-trigger" type="button" id="profileTrigger">
                    <span class="avatar">{{ $initial }}</span>
                </button>
                <div class="profile-menu" id="profileMenu">
                    <div class="profile-summary">
                        <span class="avatar">{{ $initial }}</span>
                        <div>
                            <div class="profile-name">{{ $studentName }}</div>
                            <div class="profile-meta">NPM: {{ $student->npm ?? '-' }}</div>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="profile-item logout"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main class="page-container">
        <div class="content-card">
            <div class="card-header">
                <div class="card-title-wrap">
                    <div class="card-icon"><i class="fa-regular fa-folder-open"></i></div>
                    <h1 class="card-title">Riwayat Pengaduan Saya</h1>
                </div>
                <a href="{{ route('pengaduan.create') }}" class="btn-add"><i class="fa-solid fa-plus"></i> Buat Baru</a>
            </div>

            @if (session('success'))
                <div class="alert-success"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert-error"><i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}</div>
            @endif

            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Judul Pengaduan</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $item)
                        <tr>
                            <td><strong>{{ $item->title }}</strong></td>
                            <td>{{ $item->category->name ?? $item->category ?? '-' }}</td>
                            <td>{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                            <td>
                                @if($item->status == 'Sedang Diverifikasi Admin')
                                    <span class="status-badge badge-verifikasi"><i class="fa-solid fa-clock"></i> {{ $item->status }}</span>
                                @elseif($item->status == 'Sedang Diproses / Ditindaklanjuti')
                                    <span class="status-badge badge-proses"><i class="fa-solid fa-spinner"></i> {{ $item->status }}</span>
                                @else
                                    <span class="status-badge badge-selesai"><i class="fa-solid fa-check"></i> {{ $item->status }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-btns" style="justify-content: center;">
                                    <a href="{{ route('pengaduan.show', $item->id) }}" class="btn-action btn-view" title="Lihat Detail"><i class="fa-solid fa-eye"></i></a>

                                    @if($item->status === 'Sedang Diverifikasi Admin')
                                        <a href="{{ route('pengaduan.edit', $item->id) }}" class="btn-action btn-edit" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form action="{{ route('pengaduan.destroy', $item->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fa-regular fa-clipboard"></i>
                                    <p>Belum ada pengaduan yang diajukan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <footer class="footer">© {{ date('Y') }} SIPAS Kampus.</footer>

    <script>
        const profileTrigger = document.getElementById('profileTrigger');
        const profileMenu = document.getElementById('profileMenu');
        profileTrigger.addEventListener('click', (e) => { e.stopPropagation(); profileMenu.classList.toggle('show'); });
        document.addEventListener('click', (e) => { if (!profileMenu.contains(e.target)) profileMenu.classList.remove('show'); });
    </script>
</body>
</html>
