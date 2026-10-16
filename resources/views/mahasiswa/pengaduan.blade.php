<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengaduan | SIPAS Kampus</title>

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
            --danger-bg: #fdf2f2;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text);
            background: var(--bg);
            font-size: 14px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Topbar Header (Disamakan persis dengan Beranda) */
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

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .brand-logo {
            width: 44px;
            height: 44px;
            display: grid;
            place-items: center;
            background: var(--blue);
            color: var(--yellow);
            border-radius: 50%;
            font-size: 21px;
            flex-shrink: 0;
        }

        .brand-name {
            font-size: 18px;
            font-weight: 800;
            color: var(--blue);
            letter-spacing: -.5px;
        }

        .brand-subtitle {
            margin-top: 2px;
            font-size: 10px;
            color: var(--muted);
        }

        .nav-menu {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            padding: 12px 16px;
            border-radius: 13px;
            font-weight: 600;
            color: #516783;
            text-decoration: none;
            transition: .2s;
            white-space: nowrap;
        }

        .nav-link:hover {
            background: var(--blue-light);
            color: var(--blue);
        }

        .nav-link.active {
            color: var(--blue);
            background: transparent;
            position: relative;
        }

        .nav-link.active::after {
            content: "";
            height: 3px;
            width: 60%;
            position: absolute;
            bottom: 2px;
            left: 20%;
            background: var(--yellow);
            border-radius: 5px;
        }

        /* Topbar Actions & Profil Dropdown */
        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .profile-wrap {
            position: relative;
        }

        .profile-trigger {
            border: 0;
            background: transparent;
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--blue);
            cursor: pointer;
        }

        .avatar {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            border-radius: 50%;
            background: var(--blue);
            color: white;
            font-size: 17px;
            font-weight: 700;
        }

        .profile-menu {
            position: absolute;
            top: calc(100% + 18px);
            right: 0;
            width: 255px;
            background: white;
            border-radius: 16px;
            padding: 12px;
            box-shadow: 0 18px 50px rgba(22,71,128,.16);
            display: none;
            z-index: 200;
        }

        .profile-menu.show {
            display: block;
            animation: appear .18s ease-out;
        }

        @keyframes appear {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .profile-summary {
            display: flex;
            gap: 12px;
            align-items: center;
            padding: 8px 5px 16px;
            border-bottom: 1px solid var(--border);
            margin-bottom: 8px;
        }

        .profile-summary .avatar {
            width: 46px;
            height: 46px;
        }

        .profile-name {
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .profile-meta {
            font-size: 11px;
            color: var(--muted);
            margin-top: 5px;
        }

        .profile-item {
            display: flex;
            gap: 12px;
            align-items: center;
            width: 100%;
            padding: 12px 9px;
            border-radius: 9px;
            border: 0;
            background: white;
            color: var(--text);
            text-align: left;
            cursor: pointer;
        }

        .profile-item:hover {
            background: var(--blue-light);
        }

        .profile-item.logout {
            color: #dc4545;
            border-radius: 0;
            margin-top: 5px;
            padding-top: 15px;
        }

        .profile-item.logout i {
            color: #dc4545;
        }

        /* Container & Card Form */
        .page-container {
            width: min(800px, 100%);
            margin: 0 auto;
            padding: 32px 20px 48px;
            flex: 1;
        }

        .form-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 36px;
            box-shadow: 0 10px 30px rgba(22, 71, 128, 0.04);
        }

        .card-header {
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border);
        }

        .card-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 6px;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            display: grid;
            place-items: center;
            background: var(--blue-light);
            color: var(--blue);
            border-radius: 12px;
            font-size: 18px;
        }

        .card-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--blue);
            letter-spacing: -.4px;
        }

        .card-subtitle {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.5;
        }

        /* Alert Error */
        .error-alert {
            margin-bottom: 24px;
            padding: 14px 16px;
            border-radius: 12px;
            background: var(--danger-bg);
            border: 1px solid #f8d7da;
            color: var(--danger);
            font-size: 12px;
        }

        .error-alert ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .error-alert li {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Form Group */
        .form-group {
            margin-bottom: 22px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 13px;
            font-weight: 700;
            color: var(--text);
        }

        .form-label span {
            color: var(--danger);
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            font-size: 15px;
            pointer-events: none;
            transition: color 0.2s;
        }

        .form-control, .form-select {
            width: 100%;
            height: 46px;
            padding: 0 14px 0 42px;
            border: 1px solid var(--border);
            border-radius: 12px;
            outline: none;
            font-family: inherit;
            font-size: 13px;
            color: var(--text);
            background: #fafcff;
            transition: all 0.2s ease;
        }

        .form-select {
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
        }

        .select-arrow {
            position: absolute;
            right: 14px;
            color: #94a3b8;
            pointer-events: none;
            font-size: 12px;
        }

        textarea.form-control {
            height: auto;
            min-height: 130px;
            padding: 12px 14px 12px 42px;
            resize: vertical;
            line-height: 1.6;
        }

        .form-control:focus, .form-select:focus {
            background: var(--white);
            border-color: var(--blue);
            box-shadow: 0 0 0 4px rgba(22, 71, 128, 0.08);
        }

        .form-control:focus + .input-icon,
        .form-select:focus + .input-icon {
            color: var(--blue);
        }

        /* File Upload Box */
        .file-dropzone {
            position: relative;
            border: 2px dashed #cbd5e1;
            border-radius: 14px;
            padding: 24px;
            text-align: center;
            background: #fafcff;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .file-dropzone:hover {
            border-color: var(--blue);
            background: var(--blue-light);
        }

        .file-dropzone input[type="file"] {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .dropzone-icon {
            font-size: 28px;
            color: var(--blue);
            margin-bottom: 8px;
        }

        .dropzone-text {
            font-size: 13px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 4px;
        }

        .dropzone-hint {
            font-size: 11px;
            color: var(--muted);
        }

        /* Image Preview Box */
        .image-preview-container {
            display: none;
            margin-top: 14px;
            position: relative;
            width: max-content;
        }

        .image-preview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 12px;
            border: 1px solid var(--border);
            object-fit: cover;
        }

        .remove-preview {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 26px;
            height: 26px;
            background: var(--danger);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            display: grid;
            place-items: center;
            font-size: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        /* Form Actions */
        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 32px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 22px;
            border-radius: 30px;
            background: #eef3f9;
            color: var(--text);
            font-weight: 700;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-cancel:hover {
            background: #e1eaf5;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 28px;
            border: 0;
            border-radius: 30px;
            background: var(--yellow);
            color: var(--blue-dark);
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 14px rgba(255, 207, 50, 0.35);
        }

        .btn-submit:hover {
            background: var(--yellow-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(255, 207, 50, 0.45);
        }

        .footer {
            padding: 24px 0;
            text-align: center;
            color: var(--muted);
            font-size: 11px;
            margin-top: auto;
        }

        @media (max-width: 800px) {
            .nav-menu {
                display: none;
            }
            .form-card {
                padding: 24px 18px;
            }
            .form-actions {
                flex-direction: column-reverse;
            }
            .btn-cancel, .btn-submit {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>

    @php
        $student = Auth::user();
        $studentName = $student->name ?? 'Mahasiswa';
        $initial = strtoupper(substr($studentName, 0, 1));
    @endphp

    <!-- Header Topbar Identik Dengan Home -->
    <header class="topbar">
        <a href="{{ route('home') }}" class="brand">
            <div class="brand-logo">
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div>
                <div class="brand-name">SIPAS KAMPUS</div>
                <div class="brand-subtitle">Sistem Informasi Pengaduan dan Layanan Aspirasi Kampus</div>
            </div>
        </a>

        <nav class="nav-menu">
            <a href="{{ route('home') }}" class="nav-link">
                <i class="fa-solid fa-house"></i>
                Beranda
            </a>
            <a href="{{ route('pengaduan.create') }}" class="nav-link active">
                <i class="fa-regular fa-file-lines"></i>
                Buat Pengaduan
            </a>
            <a href="{{ route('pengaduan.index') }}" class="nav-link">
                <i class="fa-regular fa-rectangle-list"></i>
                Pengaduan Saya
            </a>
        </nav>

        <div class="topbar-actions">
            <div class="profile-wrap">
                <button class="profile-trigger" type="button"
                        id="profileTrigger"
                        aria-expanded="false"
                        aria-controls="profileMenu">
                    <span class="avatar">{{ $initial }}</span>
                </button>

                <div class="profile-menu" id="profileMenu">
                    <div class="profile-summary">
                        <span class="avatar">{{ $initial }}</span>
                        <div>
                            <div class="profile-name">{{ $studentName }}</div>
                            <div class="profile-meta">
                                NPM: {{ $student->npm ?? '-' }}
                            </div>
                            <div class="profile-meta">
                                {{ ucfirst($student->role ?? 'Mahasiswa') }}
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="profile-item logout">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Content Form Container -->
    <main class="page-container">
        <div class="form-card">
            
            <div class="card-header">
                <div class="card-title-wrap">
                    <div class="card-icon">
                        <i class="fa-solid fa-file-circle-plus"></i>
                    </div>
                    <h1 class="card-title">Buat Pengaduan Baru</h1>
                </div>
                <p class="card-subtitle">
                    Sampaikan keluhan atau aspirasi Anda secara rinci untuk membantu menciptakan lingkungan kampus yang lebih baik.
                </p>
            </div>

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="error-alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <span>{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Start -->
            <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Judul Pengaduan -->
                <div class="form-group">
                    <label class="form-label" for="title">Judul Pengaduan <span>*</span></label>
                    <div class="input-wrapper">
                        <input type="text" id="title" name="title" class="form-control"
                               value="{{ old('title') }}" 
                               placeholder="Contoh: AC Rusak di Ruang Kuliah Gedung B" required autofocus>
                    </div>
                </div>

                <!-- Kategori -->
                <div class="form-group">
                    <label class="form-label" for="category_id">Kategori Pengaduan <span>*</span></label>
                    <div class="input-wrapper">
                        <select id="category_id" name="category_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <i class="fa-solid fa-chevron-down select-arrow"></i>
                    </div>
                </div>

                <!-- Isi Pengaduan -->
                <div class="form-group">
                    <label class="form-label" for="description">Isi Pengaduan <span>*</span></label>
                    <div class="input-wrapper">
                        <textarea id="description" name="description" class="form-control"
                                  placeholder="Jelaskan detail permasalahan, lokasi spesifik, dan waktu kejadian..." required>{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Foto Pendukung -->
                <div class="form-group">
                    <label class="form-label">Foto Pendukung <small style="color: var(--muted); font-weight: 400;">(Opsional)</small></label>
                    
                    <div class="file-dropzone" id="dropzone">
                        <input type="file" id="imageInput" name="image" accept="image/*">
                        <i class="fa-solid fa-cloud-arrow-up dropzone-icon"></i>
                        <div class="dropzone-text" id="dropzoneText">Klik atau tarik foto ke sini untuk mengunggah</div>
                        <div class="dropzone-hint">Format yang didukung: JPG, PNG, WEBP (Maks. 2MB)</div>
                    </div>

                    <!-- Live Image Preview Container -->
                    <div class="image-preview-container" id="previewContainer">
                        <img src="" alt="Preview Foto" class="image-preview" id="imagePreview">
                        <button type="button" class="remove-preview" id="removePreviewBtn" title="Hapus foto">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="form-actions">
                    <a href="{{ route('home') }}" class="btn-cancel">
                        Batal
                    </a>
                    <button type="submit" class="btn-submit">
                        Kirim Pengaduan
                    </button>
                </div>

            </form>
        </div>
    </main>

    <footer class="footer">
        © {{ date('Y') }} SIPAS Kampus. Sistem Informasi Pengaduan dan Layanan Aspirasi Kampus.
    </footer>

    <script>
        // Popup profil JS
        const profileTrigger = document.getElementById('profileTrigger');
        const profileMenu = document.getElementById('profileMenu');

        function toggleProfile() {
            const isOpen = profileMenu.classList.toggle('show');
            profileTrigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        }

        profileTrigger.addEventListener('click', function (event) {
            event.stopPropagation();
            toggleProfile();
        });

        document.addEventListener('click', function (event) {
            if (!profileMenu.contains(event.target) &&
                !profileTrigger.contains(event.target)) {
                profileMenu.classList.remove('show');
                profileTrigger.setAttribute('aria-expanded', 'false');
            }
        });

        // File Upload Dropzone Live Preview
        const imageInput = document.getElementById('imageInput');
        const previewContainer = document.getElementById('previewContainer');
        const imagePreview = document.getElementById('imagePreview');
        const removePreviewBtn = document.getElementById('removePreviewBtn');
        const dropzoneText = document.getElementById('dropzoneText');

        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.setAttribute('src', e.target.result);
                    previewContainer.style.display = 'block';
                    dropzoneText.textContent = 'Ganti Foto: ' + file.name;
                }
                reader.readAsDataURL(file);
            }
        });

        removePreviewBtn.addEventListener('click', function () {
            imageInput.value = '';
            imagePreview.setAttribute('src', '');
            previewContainer.style.display = 'none';
            dropzoneText.textContent = 'Klik atau tarik foto ke sini untuk mengunggah';
        });
    </script>

</body>
</html>