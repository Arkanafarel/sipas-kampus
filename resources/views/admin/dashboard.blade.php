<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | SIPAS Kampus</title>

    <!-- Google Font Inter & Font Awesome -->
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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            font-size: 14px;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            background: var(--blue-dark);
            color: var(--white);
            padding: 28px 20px;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            transition: all 0.2s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 36px;
            text-decoration: none;
            color: var(--white);
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            background: var(--blue);
            color: var(--yellow);
            border-radius: 50%;
            font-size: 20px;
            flex-shrink: 0;
        }

        .brand-name {
            font-size: 16px;
            font-weight: 800;
            letter-spacing: -.3px;
            line-height: 1.2;
        }

        .brand-subtitle {
            font-size: 10px;
            color: #a0aec0;
            margin-top: 2px;
        }

        .nav-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 12px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .nav-link i {
            font-size: 16px;
            width: 20px;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: var(--white);
        }

        .nav-link.active {
            background: var(--blue);
            color: var(--white);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .nav-link.active i {
            color: var(--yellow);
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            background: transparent;
            color: #fca5a5;
            border: 0;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-align: left;
            font-family: inherit;
            transition: all 0.2s ease;
        }

        .logout-btn:hover {
            background: rgba(220, 69, 69, 0.15);
            color: #ef4444;
        }

        /* Main Content */
        .main {
            flex: 1;
            min-width: 0;
            padding: 32px 36px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 32px;
        }

        .topbar h1 {
            font-size: 24px;
            font-weight: 800;
            color: var(--blue);
            letter-spacing: -.5px;
            margin-bottom: 4px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 13px;
        }

        .admin-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--white);
            padding: 8px 16px 8px 10px;
            border-radius: 30px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 12px rgba(22, 71, 128, 0.03);
        }

        .admin-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--blue);
            color: var(--white);
            display: grid;
            place-items: center;
            font-weight: 700;
            font-size: 13px;
        }

        .admin-info {
            font-size: 12px;
            color: var(--muted);
        }

        .admin-info strong {
            display: block;
            color: var(--text);
            font-size: 13px;
        }

        /* Stats Section */
        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--white);
            padding: 22px;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 5px 20px rgba(25, 70, 120, 0.025);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-info p {
            color: var(--muted);
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .stat-info h2 {
            font-size: 28px;
            font-weight: 800;
            color: var(--blue);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            font-size: 20px;
            flex-shrink: 0;
        }

        .stat-icon.total { background: #eaf3ff; color: #164780; }
        .stat-icon.waiting { background: #fff8e6; color: #d97706; }
        .stat-icon.process { background: #e0f2fe; color: #0284c7; }
        .stat-icon.done { background: #dcfce7; color: #15803d; }

        /* Table Section */
        .table-card {
            background: var(--white);
            border-radius: 16px;
            padding: 26px;
            border: 1px solid var(--border);
            box-shadow: 0 5px 20px rgba(25, 70, 120, 0.025);
        }

        .table-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .table-heading h2 {
            font-size: 18px;
            font-weight: 700;
            color: var(--blue);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-heading span {
            color: var(--muted);
            font-size: 12px;
            background: var(--bg);
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        th, td {
            padding: 14px 16px;
            text-align: left;
            font-size: 13px;
            vertical-align: middle;
        }

        th {
            background: #f8fafc;
            color: var(--muted);
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--border);
        }

        th:first-child { border-radius: 8px 0 0 8px; }
        th:last-child { border-radius: 0 8px 8px 0; }

        td {
            color: var(--text);
            border-bottom: 1px solid #f1f5f9;
        }

        tbody tr:last-child td {
            border-bottom: 0;
        }

        .complaint-title {
            font-weight: 700;
            color: var(--text);
        }

        /* Status Badge */
        .status {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
        }

        .status.selesai, .status.done { background: #dcfce7; color: #15803d; }
        .status.diproses, .status.process { background: #e0f2fe; color: #0284c7; }
        .status.menunggu, .status.waiting { background: #fff8e6; color: #d97706; }

        .empty-state {
            text-align: center;
            padding: 48px 20px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 40px;
            color: #cbd5e1;
            margin-bottom: 12px;
        }

        @media (max-width: 1100px) {
            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                padding: 18px 20px;
            }

            .brand {
                margin-bottom: 18px;
            }

            .main {
                padding: 20px 16px;
            }

            .topbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .stats {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .table-card {
                padding: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="layout">
        <!-- Sidebar Navigation -->
        <aside class="sidebar">
            <a href="{{ route('dashboard') }}" class="brand">
                <div class="brand-logo">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <div class="brand-name">SIPAS KAMPUS</div>
                    <div class="brand-subtitle">Panel Administrator</div>
                </div>
            </a>

            <nav class="nav-group">
                <a href="{{ route('dashboard') }}" class="nav-link active">
                    <i class="fa-solid fa-chart-pie"></i>
                    Dashboard
                </a>
                <a href="#ringkasan" class="nav-link">
                    <i class="fa-solid fa-list-check"></i>
                    Ringkasan
                </a>
                <a href="#pengaduan-terbaru" class="nav-link">
                    <i class="fa-regular fa-folder-open"></i>
                    Pengaduan Terbaru
                </a>
            </nav>

            <div class="sidebar-bottom">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        Keluar Akun
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="main">
            <!-- Topbar Header -->
            <header class="topbar">
                <div>
                    <h1>Dashboard Admin</h1>
                    <p class="subtitle">Pantau dan kelola pengaduan mahasiswa secara komprehensif.</p>
                </div>

                <div class="admin-badge">
                    <div class="admin-avatar">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="admin-info">
                        Administrator
                        <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>
                    </div>
                </div>
            </header>

            <!-- Stat Cards Section -->
            <section class="stats" id="ringkasan">
                <div class="stat-card">
                    <div class="stat-info">
                        <p>Total Pengaduan</p>
                        <h2>{{ $totalPengaduan }}</h2>
                    </div>
                    <div class="stat-icon total">
                        <i class="fa-solid fa-inbox"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <p>Menunggu</p>
                        <h2>{{ $menunggu }}</h2>
                    </div>
                    <div class="stat-icon waiting">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <p>Diproses</p>
                        <h2>{{ $diproses }}</h2>
                    </div>
                    <div class="stat-icon process">
                        <i class="fa-solid fa-spinner"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <p>Selesai</p>
                        <h2>{{ $selesai }}</h2>
                    </div>
                    <div class="stat-icon done">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
            </section>

            <!-- Table Section -->
            <section class="table-card" id="pengaduan-terbaru">
                <div class="table-heading">
                    <h2>
                        <i class="fa-solid fa-rectangle-list"></i>
                        Pengaduan Terbaru
                    </h2>
                    <span>10 Pengaduan Terakhir</span>
                </div>

                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Pengaduan</th>
                                <th>Mahasiswa</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($complaints as $complaint)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="complaint-title">{{ $complaint->title }}</td>
                                    <td>{{ $complaint->user->name ?? '-' }}</td>
                                    <td>{{ $complaint->category->name ?? '-' }}</td>
                                    <td>
                                        @php
                                            $statusClass = strtolower($complaint->status ?? 'menunggu');
                                        @endphp
                                        <span class="status {{ $statusClass }}">
                                            <i class="fa-solid fa-circle" style="font-size: 7px;"></i>
                                            {{ ucfirst($complaint->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $complaint->created_at?->format('d/m/Y') ?? '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="fa-regular fa-folder-open"></i>
                                            <p style="font-weight: 700; color: var(--blue);">Belum Ada Pengaduan</p>
                                            <span style="font-size: 12px;">Data pengaduan dari mahasiswa akan muncul di sini.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>