<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Panel Admin') | SIPAS Kampus</title>
    <style>
        :root { font-family: "Segoe UI", sans-serif; color: #202b35; background: #f3f6f4; --ink: #19332d; --green: #176b55; --line: #dce5df; --muted: #68766f; --white: #fff; }
        * { box-sizing: border-box; }
        body { margin: 0; }
        header { background: var(--ink); color: white; }
        .top { max-width: 1180px; margin: auto; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; gap: 20px; }
        .brand { font-size: 17px; font-weight: 800; text-decoration: none; color: white; }
        nav { display: flex; align-items: center; flex-wrap: wrap; gap: 8px; }
        nav a, .logout { color: #e0ece6; padding: 9px 11px; text-decoration: none; border: 0; background: none; font: inherit; font-size: 14px; cursor: pointer; }
        nav a:hover, .logout:hover { color: white; background: #ffffff18; }
        main { max-width: 1180px; margin: 0 auto; padding: 30px 24px 56px; }
        h1 { margin: 0 0 6px; color: var(--ink); font-size: 26px; }
        .subtitle { margin: 0 0 24px; color: var(--muted); }
        .panel { background: var(--white); border: 1px solid var(--line); padding: 22px; margin-bottom: 20px; }
        .toolbar, .row { display: flex; align-items: center; justify-content: space-between; gap: 14px; flex-wrap: wrap; }
        .filters { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 18px; }
        input, select, textarea { font: inherit; color: inherit; padding: 10px 12px; border: 1px solid #cbd7cf; border-radius: 4px; background: white; max-width: 100%; }
        textarea { width: 100%; min-height: 110px; resize: vertical; }
        label { display: block; font-weight: 650; margin: 15px 0 7px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 10px 14px; border: 0; border-radius: 4px; background: var(--green); color: white; text-decoration: none; font: inherit; cursor: pointer; }
        .btn.secondary { background: #e6eee9; color: var(--ink); }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 12px 10px; border-bottom: 1px solid var(--line); vertical-align: top; }
        th { color: var(--muted); font-size: 12px; text-transform: uppercase; }
        .table-wrap { overflow-x: auto; }
        .muted { color: var(--muted); }
        .badge { display: inline-block; padding: 5px 9px; background: #edf2ee; color: #365a49; border-radius: 3px; font-size: 12px; }
        .alert { padding: 12px 14px; margin-bottom: 16px; background: #e4f4e9; color: #245b38; }
        .errors { background: #fff0ed; color: #8c3427; padding: 12px 14px; margin-bottom: 16px; }
        .photo { display: block; max-width: min(100%, 640px); max-height: 440px; object-fit: contain; background: #edf1ee; margin: 10px 0 22px; }
        .field { margin-bottom: 18px; }
        @media(max-width: 700px) { .top { align-items: flex-start; flex-direction: column; padding: 14px 16px; } main { padding: 23px 16px 40px; } .panel { padding: 16px; } h1 { font-size: 22px; } }
    </style>
</head>
<body>
<header>
    <div class="top">
        <a class="brand" href="{{ route('dashboard') }}">SIPAS KAMPUS / ADMIN</a>
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('admin.pengaduan.index') }}">Pengaduan</a>
            <form action="{{ route('logout') }}" method="POST">@csrf<button class="logout" type="submit">Keluar</button></form>
        </nav>
    </div>
</header>
<main>
    @if (session('success')) <div class="alert">{{ session('success') }}</div> @endif
    @if ($errors->any()) <div class="errors">{{ $errors->first() }}</div> @endif
    @yield('content')
</main>
</body>
</html>