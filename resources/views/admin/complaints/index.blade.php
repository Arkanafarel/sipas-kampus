@extends('admin.layout')

@section('title', 'Daftar Pengaduan')

@section('content')
<h1>Semua Pengaduan</h1>
<p class="subtitle">Lihat pengaduan mahasiswa dan buka detail untuk memberikan tindak lanjut.</p>
<section class="panel">
    <form class="filters" method="GET" action="{{ route('admin.pengaduan.index') }}">
        <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari judul atau mahasiswa">
        <select name="status" aria-label="Filter status">
            <option value="">Semua status</option>
            @foreach (['Sedang Diverifikasi Admin', 'Sedang Diproses / Ditindaklanjuti', 'Selesai'] as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ $status }}</option>
            @endforeach
        </select>
        <button class="btn" type="submit">Terapkan</button>
        <a class="btn secondary" href="{{ route('admin.pengaduan.index') }}">Reset</a>
    </form>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Pengaduan</th><th>Mahasiswa</th><th>Kategori</th><th>Status</th><th>Dikirim</th><th></th></tr></thead>
            <tbody>
            @forelse ($complaints as $complaint)
                <tr>
                    <td><strong>{{ $complaint->title }}</strong></td>
                    <td>{{ $complaint->user->name ?? '-' }}</td>
                    <td>{{ $complaint->category->name ?? '-' }}</td>
                    <td><span class="badge">{{ $complaint->status }}</span></td>
                    <td>{{ $complaint->created_at?->format('d/m/Y') }}</td>
                    <td><a class="btn secondary" href="{{ route('admin.pengaduan.show', $complaint) }}">Detail</a></td>
                </tr>
            @empty
                <tr><td colspan="6" class="muted">Tidak ada pengaduan yang cocok.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top:18px">{{ $complaints->links() }}</div>
</section>
@endsection