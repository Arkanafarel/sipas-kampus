<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengaduan | SIPAS Kampus</title>

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
            --danger-bg: #fdf2f2;
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
        .avatar { width: 42px; height: 42px; display: grid; place-items: center; border-radius: 50%; background: var(--blue); color: white; font-weight: 700; }

        .page-container { width: min(800px, 100%); margin: 0 auto; padding: 32px 20px 48px; flex: 1; }
        .form-card { background: var(--white); border: 1px solid var(--border); border-radius: 20px; padding: 36px; box-shadow: 0 10px 30px rgba(22, 71, 128, 0.04); }

        .card-header { margin-bottom: 28px; padding-bottom: 20px; border-bottom: 1px solid var(--border); }
        .card-title-wrap { display: flex; align-items: center; gap: 12px; margin-bottom: 6px; }
        .card-icon { width: 40px; height: 40px; display: grid; place-items: center; background: var(--blue-light); color: var(--blue); border-radius: 12px; font-size: 18px; }
        .card-title { font-size: 22px; font-weight: 800; color: var(--blue); }

        .form-group { margin-bottom: 22px; }
        .form-label { display: block; margin-bottom: 8px; font-size: 13px; font-weight: 700; }
        .form-label span { color: var(--danger); }

        .form-control, .form-select { width: 100%; height: 46px; padding: 0 14px; border: 1px solid var(--border); border-radius: 12px; outline: none; background: #fafcff; font-family: inherit; font-size: 13px; }
        textarea.form-control { height: auto; min-height: 130px; padding: 12px 14px; resize: vertical; }

        .file-dropzone { position: relative; border: 2px dashed #cbd5e1; border-radius: 14px; padding: 24px; text-align: center; background: #fafcff; cursor: pointer; }
        .file-dropzone input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; }

        .image-preview { max-width: 200px; border-radius: 12px; border: 1px solid var(--border); margin-top: 10px; }

        .form-actions { display: flex; align-items: center; justify-content: flex-end; gap: 12px; margin-top: 32px; padding-top: 20px; border-top: 1px solid var(--border); }
        .btn-cancel { padding: 12px 22px; border-radius: 30px; background: #eef3f9; color: var(--text); font-weight: 700; text-decoration: none; }
        .btn-submit { padding: 12px 28px; border: 0; border-radius: 30px; background: var(--yellow); color: var(--blue-dark); font-weight: 800; cursor: pointer; }

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
        <div class="form-card">
            <div class="card-header">
                <div class="card-title-wrap">
                    <div class="card-icon"><i class="fa-solid fa-pen-to-square"></i></div>
                    <h1 class="card-title">Edit Pengaduan</h1>
                </div>
            </div>

            <form method="POST" action="{{ route('pengaduan.update', $pengaduan->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="form-group">
                    <label class="form-label" for="title">Judul Pengaduan <span>*</span></label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $pengaduan->title) }}" required>
                </div>

                <!-- Kategori -->
                <div class="form-group">
                    <label class="form-label" for="category_id">Kategori Pengaduan <span>*</span></label>
                    <select id="category_id" name="category_id" class="form-select" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $pengaduan->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Isi -->
                <div class="form-group">
                    <label class="form-label" for="description">Isi Pengaduan <span>*</span></label>
                    <textarea id="description" name="description" class="form-control" required>{{ old('description', $pengaduan->description) }}</textarea>
                </div>

                <!-- Foto Awal -->
                <div class="form-group">
                    <label class="form-label">Foto Pendukung <small>(Upload baru jika ingin mengganti)</small></label>
                    <div class="file-dropzone">
                        <input type="file" name="image" accept="image/*">
                        <div>Klik atau tarik foto ke sini untuk mengubah foto</div>
                    </div>

                    @if($pengaduan->image_path)
                        <div style="margin-top: 10px;">
                            <span style="font-size: 11px; color: var(--muted);">Foto Saat Ini:</span><br>
                            <img src="{{ asset('storage/' . $pengaduan->image_path) }}" alt="Foto Lama" class="image-preview">
                        </div>
                    @endif
                </div>

                <div class="form-actions">
                    <a href="{{ route('pengaduan.index') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </main>

    <footer class="footer">© {{ date('Y') }} SIPAS Kampus.</footer>
</body>
</html>
