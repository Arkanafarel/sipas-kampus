@extends('admin.layout')

@section('title', 'Daftar Pengguna')

@section('content')
<div class="row" style="margin-bottom: 8px;">
    <div>
        <h1>Daftar Pengguna Sistem</h1>
        <p class="subtitle" style="margin-bottom: 0;">Lihat seluruh akun pengguna yang terdaftar di sistem SIPAS Kampus beserta perannya.</p>
    </div>
    <div>
        <span class="badge" style="background: #e6eee9; color: var(--ink); font-weight: 600; padding: 8px 12px; border-radius: 4px;">
            🔒 Mode Read-Only (Hanya Lihat)
        </span>
    </div>
</div>

<div style="background: #f0f7f4; border-left: 4px solid var(--green); padding: 12px 16px; margin: 16px 0 20px; border-radius: 0 4px 4px 0; font-size: 14px; color: #1c4d3d;">
    <strong>Informasi:</strong> Halaman ini bersifat <em>Read-Only</em>. Penambahan akun mahasiswa dilakukan secara mandiri melalui halaman Registrasi publik, sedangkan kredensial dan hak akses dikelola oleh sistem autentikasi.
</div>

{{-- Ringkasan Statistik Pengguna --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 14px; margin-bottom: 22px;">
    <div class="panel" style="margin-bottom: 0; padding: 16px 18px;">
        <span class="muted" style="font-size: 13px; text-transform: uppercase;">Total Pengguna</span>
        <div style="font-size: 26px; font-weight: 700; color: var(--ink); margin-top: 4px;">{{ $totalUsers }}</div>
    </div>
    <div class="panel" style="margin-bottom: 0; padding: 16px 18px;">
        <span class="muted" style="font-size: 13px; text-transform: uppercase;">Total Mahasiswa</span>
        <div style="font-size: 26px; font-weight: 700; color: #2563eb; margin-top: 4px;">{{ $totalMahasiswa }}</div>
    </div>
    <div class="panel" style="margin-bottom: 0; padding: 16px 18px;">
        <span class="muted" style="font-size: 13px; text-transform: uppercase;">Total Administrator</span>
        <div style="font-size: 26px; font-weight: 700; color: var(--green); margin-top: 4px;">{{ $totalAdmin }}</div>
    </div>
</div>

<section class="panel">
    {{-- Form Filter & Pencarian --}}
    <form class="filters" method="GET" action="{{ route('admin.users.index') }}">
        <input 
            type="search" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Cari nama, email, atau NPM..." 
            style="min-width: 260px;"
        >
        <select name="role" aria-label="Filter peran">
            <option value="">Semua Peran</option>
            <option value="mahasiswa" @selected(request('role') === 'mahasiswa')>Mahasiswa</option>
            <option value="admin" @selected(request('role') === 'admin')>Administrator</option>
        </select>
        <button class="btn" type="submit">Cari / Filter</button>
        @if (request()->hasAny(['search', 'role']))
            <a class="btn secondary" href="{{ route('admin.users.index') }}">Reset Filter</a>
        @endif
    </form>

    {{-- Tabel Data Pengguna --}}
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Pengguna</th>
                    <th>NPM</th>
                    <th>Email</th>
                    <th>Peran</th>
                    <th>Tanggal Terdaftar</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($users as $index => $user)
                <tr>
                    <td class="muted">{{ $users->firstItem() + $index }}</td>
                    <td>
                        <strong>{{ $user->name }}</strong>
                        @if ($user->id === auth()->id())
                            <span style="font-size: 11px; background: #e6f4ea; color: #137333; padding: 2px 6px; border-radius: 3px; margin-left: 4px;">(Anda)</span>
                        @endif
                    </td>
                    <td>
                        @if ($user->npm)
                            <code style="background: #eef2f0; padding: 3px 6px; border-radius: 3px; font-size: 13px;">{{ $user->npm }}</code>
                        @else
                            <span class="muted">-</span>
                        @endif
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->role === 'admin')
                            <span class="badge" style="background: #d1fae5; color: #065f46; font-weight: 600;">Administrator</span>
                        @else
                            <span class="badge" style="background: #e0f2fe; color: #0369a1; font-weight: 600;">Mahasiswa</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at?->translatedFormat('d M Y, H:i') ?? $user->created_at?->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 32px 16px;" class="muted">
                        Tidak ada pengguna yang cocok dengan kriteria pencarian.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div style="margin-top: 20px;">
        {{ $users->links() }}
    </div>
</section>
@endsection
