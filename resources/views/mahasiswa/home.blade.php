<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Mahasiswa | SIPAS Kampus</title>

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
            --white: #ffffff;
            --bg: #f2f7fd;
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
        }

        button, a {
            font: inherit;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        button {
            cursor: pointer;
        }

        .topbar {
            min-height: 76px;
            background: white;
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

        .nav-menu {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
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
        }

        .brand-name {
            font-size: 18px;
            font-weight: 800;
            color: var(--blue);
            letter-spacing: -.5px;
        }

        .brand-subtitle {
            margin-top: 4px;
            font-size: 10px;
            color: var(--muted);
        }

        .nav-menu {
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
            bottom: -8px;
            left: 20%;
            background: var(--yellow);
            border-radius: 5px;
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .icon-button {
            width: 40px;
            height: 40px;
            border: 0;
            background: transparent;
            color: var(--blue);
            border-radius: 12px;
            position: relative;
            font-size: 19px;
        }

        .icon-button:hover {
            background: var(--blue-light);
        }

        .notification-dot {
            position: absolute;
            top: 0;
            right: 0;
            width: 17px;
            height: 17px;
            display: grid;
            place-items: center;
            background: var(--yellow);
            color: var(--blue-dark);
            border-radius: 50%;
            font-size: 10px;
            font-weight: 800;
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
        }

        .profile-item:hover {
            background: var(--blue-light);
        }

        .profile-item i {
            width: 18px;
            color: var(--blue);
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

        .page-container {
            width: min(1600px, 100%);
            margin: 0 auto;
            padding: 24px 3%;
        }

        /* Hero carousel */

        .hero {
            position: relative;
            height: 275px;
            overflow: hidden;
            border-radius: 16px;
            background: var(--blue);
            color: white;
            margin-bottom: 28px;
            isolation: isolate;
        }

        .hero-slide {
            position: absolute;
            inset: 0;
            padding: 34px 7%;
            display: flex;
            align-items: center;
            opacity: 0;
            visibility: hidden;
            transition: opacity .65s ease;
            background-size: cover;
            background-position: center;
        }

        .hero-slide.active {
            opacity: 1;
            visibility: visible;
        }

        .hero-slide::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 1; /* Menaikkan urutan z-index agar overlay berada di atas gambar background */
            background: linear-gradient(90deg,
                rgba(10, 25, 47, 0.88) 0%,
                rgba(16, 55, 102, 0.75) 50%,
                rgba(0, 0, 0, 0.35) 100%);
        }

        .hero-slide::after {
            content: "";
            position: absolute;
            width: 200px;
            height: 200px;
            right: -75px;
            bottom: -135px;
            z-index: -1;
            background: var(--yellow);
            border-radius: 50%;
        }

        .slide-one {
            background-image: url('https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=1800&q=85');
        }

        .slide-two {
            background-image: url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?auto=format&fit=crop&w=1800&q=85');
        }

        .slide-three {
            background-image: url('https://images.unsplash.com/photo-1498243691581-b145c3f54a5a?auto=format&fit=crop&w=1800&q=85');
        }

        .hero-content {
            max-width: 540px;
            position: relative;
            z-index: 2;
        }

        .hero-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 7px 12px;
            margin-bottom: 12px;
            background: var(--yellow);
            color: var(--blue-dark);
            border-radius: 30px;
            font-size: 11px;
            font-weight: 800;
        }

        .hero h1 {
            font-size: clamp(25px, 2.6vw, 36px);
            line-height: 1.2;
            letter-spacing: -.8px;
            margin-bottom: 12px;
        }

        .hero h1 span {
            color: var(--yellow);
        }

        .hero p {
            max-width: 440px;
            font-size: 13px;
            line-height: 1.8;
            color: #edf4ff;
        }

        .primary-button {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 13px 22px;
            margin-top: 18px;
            border: 0;
            border-radius: 30px;
            background: var(--yellow);
            color: var(--blue-dark);
            font-weight: 800;
            transition: .2s;
        }

        .hero .primary-button {
            display: none !important;
        }

        .primary-button:hover {
            background: #ffdc63;
            transform: translateY(-2px);
        }

        .slide-arrow {
            position: absolute;
            z-index: 5;
            top: 50%;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            border: 0;
            border-radius: 50%;
            color: white;
            background: rgba(41,130,218,.65);
            font-size: 16px;
        }

        .slide-arrow:hover {
            background: var(--blue);
        }

        .slide-prev { left: 17px; }
        .slide-next { right: 17px; }

        .slide-dots {
            position: absolute;
            bottom: 18px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 5;
        }

        .slide-dot {
            height: 10px;
            width: 10px;
            border: 0;
            border-radius: 50%;
            background: rgba(255,255,255,.65);
        }

        .slide-dot.active {
            width: 23px;
            border-radius: 20px;
            background: var(--yellow);
        }

        /* Welcome and quick links */

        .welcome-grid {
            display: grid;
            /* Kartu profil fleksibel (2fr), dan 2 kartu kanan masing-masing 1fr */
            grid-template-columns: 2fr 1fr 1fr;
            gap: 14px;
            margin-bottom: 24px;
        }

        .welcome-card {
            display: flex;
            align-items: center;
            gap: 17px;
            padding: 20px;
            min-width: 0;
            border: 1px solid #d7e8fa;
            border-radius: 14px;
            background: linear-gradient(120deg, #e8f4ff, #f9fcff);
        }

        .welcome-icon {
            width: 68px;
            height: 68px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            background: var(--blue);
            color: var(--yellow);
            border-radius: 50%;
            font-size: 25px;
        }

        .welcome-card h2 {
            font-size: 19px;
            color: var(--blue);
            margin-bottom: 8px;
        }

        .welcome-card p {
            font-size: 12px;
            line-height: 1.8;
            color: #627792;
        }

        .student-details {
            margin-left: auto;
            min-width: 150px;
            padding-left: 14px;
            border-left: 1px solid #d7e5f4;
        }

        .detail-row {
            display: flex;
            gap: 12px;
            align-items: center;
            padding: 7px 0;
        }

        .detail-row i {
            width: 24px;
            font-size: 19px;
            color: var(--blue);
        }

        .detail-label {
            font-size: 11px;
            color: var(--muted);
            margin-bottom: 3px;
        }

        .detail-value {
            font-size: 12px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .quick-card {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 132px;
            padding: 20px;
            border-radius: 14px;
            background: white;
            border: 1px solid var(--border);
            box-shadow: 0 4px 15px rgba(25,70,120,.025);
            transition: .2s;
        }

        .quick-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(25,70,120,.09);
        }

        .quick-card > i {
            font-size: 25px;
            color: var(--blue);
        }

        .quick-card-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.5;
        }

        .quick-card-bottom i {
            color: var(--blue);
        }

        .quick-card.featured {
            background: var(--yellow);
            border-color: var(--yellow);
        }

        .quick-card.featured > i,
        .quick-card.featured .quick-card-bottom i {
            color: var(--blue-dark);
        }

        /* Lower content */

        .content-grid {
            display: grid;
            grid-template-columns: minmax(0, 2.1fr) minmax(270px, .95fr);
            gap: 20px;
            align-items: stretch;
        }

        .panel {
            background: white;
            border: 1px solid var(--border);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(25,70,120,.025);
        }

        .panel-header {
            padding: 21px 23px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            border-bottom: 1px solid #edf2f8;
        }

        .panel-title {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 19px;
            color: var(--blue);
        }

        .panel-title i {
            font-size: 18px;
        }

        .view-all {
            display: flex;
            align-items: center;
            gap: 9px;
            color: #1d65b2;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
            padding: 0 19px 16px;
        }

        .complaint-table {
            width: 100%;
            min-width: 650px;
            border-collapse: collapse;
            text-align: left;
        }

        .complaint-table th {
            padding: 12px 10px;
            color: #6682a6;
            background: #f0f6fd;
            font-size: 11px;
            font-weight: 600;
        }

        .complaint-table th:first-child {
            border-radius: 8px 0 0 8px;
        }

        .complaint-table th:last-child {
            border-radius: 0 8px 8px 0;
        }

        .complaint-table td {
            padding: 14px 10px;
            border-bottom: 1px solid #eaf0f7;
            font-size: 11px;
            vertical-align: middle;
        }

        .complaint-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .complaint-title {
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--text);
        }

        .complaint-desc {
            color: var(--muted);
            line-height: 1.5;
        }

        .category {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 30px;
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
            background: #e6f2ff;
            color: #1765b5;
        }

        .category.yellow { background: #fff4d5; color: #a86a00; }
        .category.purple { background: #eee9ff; color: #6246cf; }
        .category.green { background: #e2f7eb; color: #18814c; }

        .status {
            display: inline-block;
            padding: 6px 11px;
            border-radius: 30px;
            font-size: 10px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status.done { background: #e1f6e9; color: #16804a; }
        .status.process { background: #e1efff; color: #1764b6; }
        .status.waiting { background: #edf1f6; color: #516780; }

        .date-cell {
            color: #7185a1;
            white-space: nowrap;
        }

        .date-cell i {
            margin-right: 5px;
        }

        /* Campus information */

        .info-panel {
            padding: 12px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .quote-card {
            min-height: 225px;
            border-radius: 11px;
            padding: 25px 20px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            position: relative;
            overflow: hidden;
            background:
                linear-gradient(0deg, rgba(255,255,255,.99) 0%, rgba(255,255,255,.90) 46%, rgba(255,255,255,.12) 100%),
                url('https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=900&q=80') center/cover;
        }

        .quote-mark {
            font-size: 42px;
            color: var(--yellow);
            font-weight: 800;
            line-height: 1;
            margin-bottom: 4px;
        }

        .quote-card h3 {
            max-width: 260px;
            font-size: 20px;
            line-height: 1.45;
            color: var(--blue);
        }

        .yellow-line {
            height: 3px;
            width: 42px;
            background: var(--yellow);
            border-radius: 3px;
            margin-top: 16px;
        }

        .info-note {
            padding: 17px;
            border-radius: 11px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            background: #edf5ff;
            color: #476487;
            font-size: 11px;
            line-height: 1.8;
        }

        .info-note i {
            color: var(--blue);
            font-size: 18px;
            margin-top: 3px;
        }

        .footer {
            padding: 28px 0 8px;
            text-align: center;
            color: #8296b2;
            font-size: 11px;
        }

        .mobile-menu-button {
            display: none;
        }

        @media (max-width: 1150px) {
            .topbar {
                gap: 12px;
                padding: 0 2%;
            }

            .nav-link {
                padding: 11px;
                font-size: 12px;
            }

            .brand-name {
                font-size: 16px;
            }

            .welcome-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .welcome-card {
                grid-column: 1 / -1;
            }

            .student-details {
                min-width: 200px;
            }
        }

        @media (max-width: 800px) {
            .topbar {
                min-height: 68px;
                flex-wrap: wrap;
                padding: 12px 18px;
            }

            .brand-logo {
                width: 39px;
                height: 39px;
            }

            .brand-name {
                font-size: 15px;
            }

            .brand-subtitle {
                font-size: 9px;
            }

            .mobile-menu-button {
                display: grid;
                place-items: center;
                width: 38px;
                height: 38px;
                border: 1px solid var(--border);
                border-radius: 10px;
                background: white;
                color: var(--blue);
                font-size: 17px;
                order: 3;
            }

            .topbar-actions {
                margin-left: auto;
                gap: 8px;
            }

            .nav-menu {
                display: none;
                order: 4;
                flex-basis: 100%;
                flex-direction: column;
                align-items: stretch;
                gap: 5px;
                padding-top: 10px;
                border-top: 1px solid var(--border);
            }

            .nav-menu.show {
                display: flex;
            }

            .nav-link {
                justify-content: flex-start;
                padding: 13px;
            }

            .nav-link.active::after {
                display: none;
            }

            .page-container {
                padding: 18px 15px;
            }

            .hero {
                height: 300px;
                margin-bottom: 18px;
            }

            .hero-slide {
                padding: 28px 45px;
                background-position: 60% center;
            }

            .hero-slide::before {
                background: linear-gradient(90deg,
                    rgba(16,55,102,.98) 0%,
                    rgba(22,71,128,.89) 65%,
                    rgba(22,71,128,.4) 100%);
            }

            .hero h1 {
                font-size: 26px;
            }

            .hero p {
                font-size: 12px;
            }

            .slide-prev { left: 8px; }
            .slide-next { right: 8px; }

            .welcome-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 10px;
                margin-bottom: 18px;
            }

            .welcome-card {
                grid-column: 1 / -1;
                padding: 16px;
                flex-wrap: wrap;
            }

            .welcome-icon {
                width: 52px;
                height: 52px;
                font-size: 20px;
            }

            .welcome-card h2 {
                font-size: 16px;
            }

            .welcome-card p {
                font-size: 11px;
            }

            .student-details {
                flex-basis: 100%;
                margin-left: 0;
                padding-left: 0;
                border-left: 0;
                border-top: 1px solid #d7e5f4;
                padding-top: 8px;
                display: flex;
                gap: 22px;
            }

            .quick-card {
                min-height: 120px;
                padding: 15px;
            }

            .content-grid {
                grid-template-columns: 1fr;
                gap: 16px;
            }

            .panel-header {
                padding: 18px 15px;
            }

            .panel-title {
                font-size: 16px;
            }

            .table-wrap {
                padding: 0 12px 10px;
            }

            .quote-card {
                min-height: 210px;
            }
        }

        @media (max-width: 420px) {
            .topbar {
                gap: 8px;
                padding: 10px;
            }

            .brand {
                gap: 8px;
            }

            .brand-name {
                font-size: 13px;
            }

            .brand-subtitle {
                max-width: 130px;
                font-size: 8px;
            }

            .topbar-actions {
                gap: 2px;
            }

            .profile-trigger {
                gap: 3px;
            }

            .profile-trigger .avatar {
                width: 34px;
                height: 34px;
                font-size: 14px;
            }

            .profile-trigger > i {
                display: none;
            }

            .hero {
                height: 315px;
                border-radius: 12px;
            }

            .hero-slide {
                padding: 25px 27px;
            }

            .hero h1 {
                font-size: 23px;
            }

            .hero-label {
                font-size: 9px;
            }

            .primary-button {
                padding: 11px 15px;
                font-size: 12px;
            }

            .welcome-card {
                gap: 10px;
            }

            .welcome-icon {
                width: 43px;
                height: 43px;
            }

            .welcome-card h2 {
                font-size: 14px;
            }

            .student-details {
                gap: 12px;
                justify-content: space-between;
            }

            .detail-value {
                font-size: 10px;
            }

            .quick-card {
                min-height: 112px;
                padding: 13px;
            }

            .quick-card > i {
                font-size: 22px;
            }

            .quick-card-bottom {
                font-size: 11px;
            }

            .panel-title {
                font-size: 14px;
                gap: 7px;
            }

            .view-all {
                font-size: 10px;
            }

            .profile-menu {
                right: -5px;
                width: min(255px, calc(100vw - 24px));
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

<header class="topbar">
    <a href="{{ route('home') }}" class="brand">
        <div class="brand-logo">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div>
            <div class="brand-name">SIPAS KAMPUS</div>
            <div class="brand-subtitle">Sistem Informasi Pengaduan dan Layananan Aspirasi Kampus</div>
        </div>
    </a>

    <nav class="nav-menu" id="navMenu">
        <a href="{{ route('home') }}" class="nav-link active">
            <i class="fa-solid fa-house"></i>
            Beranda
        </a>

        {{-- Ganti href setelah route pembuatan pengaduan tersedia --}}
        <a href="{{route('pengaduan.create')}}" class="nav-link">
            <i class="fa-regular fa-file-lines"></i>
            Buat Pengaduan
        </a>

        {{-- Ganti href setelah route daftar pengaduan tersedia --}}
        <a href="#pengaduan-saya" class="nav-link">
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

        <button class="mobile-menu-button" id="mobileMenuButton"
                type="button" aria-label="Buka menu navigasi"
                aria-expanded="false">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
</header>

<main class="page-container">

    {{-- HERO CAROUSEL --}}
    <section class="hero" aria-label="Informasi kampus">
        <article class="hero-slide slide-one active">
            <div class="hero-content">
                <div class="hero-label">
                    <i class="fa-solid fa-bullhorn"></i>
                    INFORMASI KAMPUS
                </div>
                <h1>Suara Mahasiswa,<br><span>Untuk Kampus yang Lebih Baik</span></h1>
                <p>
                    Sampaikan pengaduan terkait fasilitas dan lingkungan kampus
                    dengan mudah melalui SIPAS Kampus.
                </p>
            </div>
        </article>

        <article class="hero-slide slide-two">
            <div class="hero-content">
                <div class="hero-label">
                    <i class="fa-solid fa-calendar-days"></i>
                    INFORMASI AKADEMIK
                </div>
                <h1>Informasi Kampus<br><span>Dalam Satu Portal</span></h1>
                <p>
                    Pantau informasi penting dan gunakan layanan pengaduan
                    kampus melalui satu portal yang mudah diakses.
                </p>
                <a href="#pengaduan-saya" class="primary-button">
                    <i class="fa-solid fa-rectangle-list"></i>
                    Lihat Pengaduan Saya
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </article>

        <article class="hero-slide slide-three">
            <div class="hero-content">
                <div class="hero-label">
                    <i class="fa-solid fa-people-group"></i>
                    KAMPUS LEBIH BAIK
                </div>
                <h1>Peduli Lingkungan,<br><span>Wujudkan Perubahan</span></h1>
                <p>
                    Setiap pengaduan membantu kampus mengetahui masalah
                    dan meningkatkan kualitas lingkungan belajar.
                </p>
                <a href="#pengaduan-saya" class="primary-button">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Pantau Pengaduan
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </article>

        <button class="slide-arrow slide-prev" id="slidePrev"
                type="button" aria-label="Slide sebelumnya">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <button class="slide-arrow slide-next" id="slideNext"
                type="button" aria-label="Slide berikutnya">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <div class="slide-dots" id="slideDots">
            <button class="slide-dot active" type="button" aria-label="Slide 1"></button>
            <button class="slide-dot" type="button" aria-label="Slide 2"></button>
            <button class="slide-dot" type="button" aria-label="Slide 3"></button>
        </div>
    </section>

    {{-- SAPAAN DAN AKSES CEPAT --}}
    <section class="welcome-grid">
        <div class="welcome-card">
            <div class="welcome-icon">
                <i class="fa-solid fa-bullhorn"></i>
            </div>

            <div>
                <h2>Hai, {{ $studentName }}!</h2>
                <p>Semoga hari ini penuh dengan hal baik dan langkah positif untuk masa depanmu.</p>
            </div>

            <div class="student-details">
                <div class="detail-row">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <div>
                        <div class="detail-label">NPM</div>
                        <div class="detail-value">{{ $student->npm ?? '-' }}</div>
                    </div>
                </div>
                <div class="detail-row">
                    <i class="fa-regular fa-user"></i>
                    <div>
                        <div class="detail-label">Role</div>
                        <div class="detail-value">{{ ucfirst($student->role ?? 'Mahasiswa') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{route('pengaduan.create')}}" class="quick-card" id="buat-pengaduan">
            <i class="fa-solid fa-file-circle-plus"></i>
            <div class="quick-card-bottom">
                <span>Buat<br>Pengaduan</span>
                <i class="fa-solid fa-arrow-right"></i>
            </div>
        </a>

        <a href="#pengaduan-saya" class="quick-card">
            <i class="fa-solid fa-file-circle-check"></i>
            <div class="quick-card-bottom">
                <span>Lacak<br>Pengaduan</span>
                <i class="fa-solid fa-arrow-right"></i>
            </div>
        </a>
    </section>

    
    {{-- PENGADUAN DAN INFORMASI KAMPUS --}}
    <section class="content-grid">

        <div class="panel" id="pengaduan-saya">
            <div class="panel-header">
                <h2 class="panel-title">
                    <i class="fa-solid fa-rectangle-list"></i>
                    Pengaduan Terbaru
                </h2>

                <a href="#pengaduan-saya" class="view-all">
                    Lihat Semua
                    <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="table-wrap">
                <table class="complaint-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Pengaduan</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($complaints as $complaint)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $complaint->title }}</td>
                                <td>{{ $complaint->category?->name ?? '-' }}</td>
                                <td>
                                    {{ $complaint->created_at?->format('d/m/Y') ?? '-' }}
                                </td>
                                <td>
                                    <span class="status-badge">
                                        {{ ucfirst($complaint->status) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    style="padding: 45px 20px; text-align: center;">
                                    <div style="font-size: 35px; color: #9bb4d1; margin-bottom: 14px;">
                                        <i class="fa-regular fa-folder-open"></i>
                                    </div>

                                    <div style="font-size: 14px; font-weight: 700; color: #164780; margin-bottom: 8px;">
                                        Belum Ada Pengaduan
                                    </div>

                                    <div style="font-size: 12px; color: #71839d; line-height: 1.8;">
                                        Kamu belum mengajukan pengaduan.<br>
                                        Klik tombol di bawah untuk menyampaikan pengaduan pertamamu.
                                    </div>

                                    <a href="{{ route('pengaduan.create') }}"
                                    style="display: inline-flex; align-items: center; gap: 8px; margin-top: 18px; padding: 11px 18px; background: #ffcf32; color: #103766; border-radius: 25px; font-size: 12px; font-weight: 700;">
                                        <i class="fa-solid fa-plus"></i>
                                        Buat Pengaduan
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <aside class="panel info-panel">
            <div class="quote-card">
                <div class="quote-mark">“</div>
                <h3>Kampus yang baik berawal dari kepedulian kita bersama.</h3>
                <div class="yellow-line"></div>
            </div>

            <div class="info-note">
                <i class="fa-solid fa-circle-info"></i>
                <p>
                    Jika ada kendala atau masalah, jangan ragu untuk
                    melaporkannya melalui menu <strong>Pengaduan</strong>.
                </p>
            </div>
        </aside>

    </section>


    <footer class="footer">
        © {{ date('Y') }} Sistem Informasi Pengaduan dan Layananan Aspirasi Kampus
    </footer>
</main>

<script>
    // Popup profil
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

    // Menu mobile
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const navMenu = document.getElementById('navMenu');

    mobileMenuButton.addEventListener('click', function () {
        const isOpen = navMenu.classList.toggle('show');
        mobileMenuButton.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        mobileMenuButton.innerHTML = isOpen
            ? '<i class="fa-solid fa-xmark"></i>'
            : '<i class="fa-solid fa-bars"></i>';
    });

    // Carousel otomatis
    const slides = [...document.querySelectorAll('.hero-slide')];
    const dots = [...document.querySelectorAll('.slide-dot')];
    const prevButton = document.getElementById('slidePrev');
    const nextButton = document.getElementById('slideNext');

    let currentSlide = 0;
    let carouselTimer;

    function showSlide(index) {
        currentSlide = (index + slides.length) % slides.length;

        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === currentSlide);
        });

        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentSlide);
        });
    }

    function startCarousel() {
        clearInterval(carouselTimer);
        carouselTimer = setInterval(() => {
            showSlide(currentSlide + 1);
        }, 5000);
    }

    prevButton.addEventListener('click', function () {
        showSlide(currentSlide - 1);
        startCarousel();
    });

    nextButton.addEventListener('click', function () {
        showSlide(currentSlide + 1);
        startCarousel();
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', function () {
            showSlide(index);
            startCarousel();
        });
    });

    showSlide(0);
    startCarousel();
</script>

</body>
</html>