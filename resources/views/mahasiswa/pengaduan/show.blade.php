<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan | SIPAS Kampus</title>

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
            --text: #183456;
            --muted: #71839d;
            --border: #e1eaf5;
            --bg: #f2f7fd;
            --white: #ffffff;
            --success: #16a34a;
            --warning: #d97706;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; color: var(--text); background: var(--bg); font-size: 14px; min-height: 100vh; display: flex; flex-direction: column; }

        .topbar { min-height: 76px; background: var(--white); border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; padding: 0 4%; position: sticky; top: 0; z-index: 100; }
        .brand { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .brand-logo { width: 44px; height: 44px; display: grid; place-items: center; background: var(--blue); color: var(--yellow); border-radius: 50%; font-size: 21px; }
        .brand-name { font-size: 18px; font-weight: 800; color: var(--blue); }
        .brand-subtitle { font-size: 10px; color: var(--muted); }

        .nav-menu { position: absolute; left: 50%; transform: translateX(-50%); display: flex; align-items: center; gap: 10px; }
        .nav-link { display: flex; align-items: center; gap: 9px; padding: 12px 16px; border-radius: 13px; font-weight: 600; color: #516783; text-decoration: none; }
        .nav-link:hover { background: var(--blue-light); color: var(--blue); }

        .avatar { width: 42px; height: 42px; display: grid; place-items: center; border-radius: 50%; background: var(--blue); color: white; font-weight: 700; }

        .page-container { width: min(850px, 100%); margin: 0 auto; padding: 32px 20px 48px; flex: 1; }
        .detail-card { background: var(--white); border: 1px solid var(--border); border-radius: 20px; padding: 36px; box-shadow: 0 10px 30px rgba(22, 71, 128, 0.04); margin-bottom: 24px; }

        .detail-header { display: flex; align-items: flex-start; justify-content: space-between; border-bottom: 1px solid var(--border); padding-bottom: 20px; margin-bottom: 24px; gap: 16px; }
        .detail-title { font-size: 22px; font-weight: 800; color: var(--blue); margin-bottom: 8px; }
        .detail-meta { display: flex; gap: 16px; color: var(--muted); font-size: 12px; }

        .status-badge { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 20px; font-size: 12px; font-weight: 700; white-space: nowrap; }
        .badge-verifikasi { background: #fef3c7; color: var(--warning); }
        .badge-proses { background: #e0f2fe; color: #0284c7; }
        .badge-selesai { background: #dcfce7; color: var(--success); }

        .section-title { font-size: 15px; font-weight: 700; color: var(--blue); margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
        .detail-text { line-height: 1.7; color: var(--text); background: #fafcff; padding: 18px; border-radius: 12px; border: 1px solid var(--border); margin-bottom: 24px; }

        .img-container { margin-top: 12px; }
        .img-preview { max-width: 100%; max-height: 350px; border-radius: 12px; border: 1px solid var(--border); object-fit: cover; }

        .admin-response-card { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 16px; padding: 24px; }
        .admin-response-card .section-title { color: var(--success); }

        .btn-back { display: inline-flex; align-items: center; gap: 8px; padding: 10px 22px; background: #eef3f9; color: var(--text); border-radius: 30px; font-weight: 700; text-decoration: none; transition: .2s; }
        .btn-back:hover { background: #e1eaf5; }

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
            <a href="{{ route('pengaduan.index') }}" class="nav-link"><i class="fa-regular fa-rectangle-list"></i> Pengaduan Saya</a>
        </nav>

        <div class="topbar-actions">
            <div class="avatar">{{ $initial }}</div>
        </div>
    </header>

    <main class="page-container">
        <div class="detail-card">
            <div class="detail-header">
                <div>
                    <h1 class="detail-title">{{ $pengaduan->title }}</h1>
                    <div class="detail-meta">
                        <span><i class="fa-regular fa-folder"></i> {{ $pengaduan->category->name ?? $pengaduan->category ?? '-' }}</span>
                        <span><i class="fa-regular fa-calendar"></i> {{ $pengaduan->created_at ? $pengaduan->created_at->format('d M Y, H:i') : '-' }} WIB</span>
                    </div>
                </div>
                <div>
                    @if($pengaduan->status == 'Sedang Diverifikasi Admin')
                        <span class="status-badge badge-verifikasi"><i class="fa-solid fa-clock"></i> {{ $pengaduan->status }}</span>
                    @elseif($pengaduan->status == 'Sedang Diproses / Ditindaklanjuti')
                        <span class="status-badge badge-proses"><i class="fa-solid fa-spinner"></i> {{ $pengaduan->status }}</span>
                    @else
                        <span class="status-badge badge-selesai"><i class="fa-solid fa-check"></i> {{ $pengaduan->status }}</span>
                    @endif
                </div>
            </div>

            <div class="section-title"><i class="fa-solid fa-align-left"></i> Deskripsi Pengaduan</div>
            <div class="detail-text">{{ $pengaduan->description }}</div>

            @if($pengaduan->image_path)
                <div class="section-title"><i class="fa-regular fa-image"></i> Foto Lampiran Awal</div>
                <div class="img-container">
                    <img src="{{ asset('storage/' . $pengaduan->image_path) }}" alt="Foto Awal" class="img-preview">
                </div>
            @endif
        </div>

        <!-- Bukti & Tindak Lanjut Admin -->
        @if($pengaduan->completion_note || $pengaduan->completion_photo)
            <div class="admin-response-card">
                <div class="section-title"><i class="fa-solid fa-user-shield"></i> Tindak Lanjut & Bukti Penyelesaian Admin</div>
                <div class="detail-text" style="background: white;">{{ $pengaduan->completion_note ?? 'Masalah telah diselesaikan.' }}</div>

                @if($pengaduan->completion_photo)
                    <div class="img-container">
                        <img src="{{ asset('storage/' . $pengaduan->completion_photo) }}" alt="Foto Bukti Penyelesaian" class="img-preview">
                    </div>
                @endif
            </div>
        @endif

        <div style="margin-top: 24px;">
            <a href="{{ route('pengaduan.index') }}" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali ke Riwayat</a>
        </div>
    </main>

    <footer class="footer">© {{ date('Y') }} SIPAS Kampus.</footer>
</body>
</html>
