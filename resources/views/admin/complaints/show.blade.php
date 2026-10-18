@extends('admin.layout')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="row">
    <div><h1>{{ $complaint->title }}</h1><p class="subtitle">Pengaduan dari {{ $complaint->user->name ?? '-' }} · {{ $complaint->created_at?->format('d/m/Y H:i') }}</p></div>
    <a class="btn secondary" href="{{ route('admin.pengaduan.index') }}">Kembali ke daftar</a>
</div>
<section class="panel">
    <div class="row"><strong>Status</strong><span class="badge">{{ $complaint->status }}</span></div>
    <p><strong>Kategori:</strong> {{ $complaint->category->name ?? '-' }}</p>
    <p><strong>Email mahasiswa:</strong> {{ $complaint->user->email ?? '-' }}</p>
    <h2>Deskripsi pengaduan</h2>
    <p style="white-space:pre-wrap">{{ $complaint->description }}</p>
    @if ($complaint->image_path)
        <h2>Foto awal</h2>
        <img class="photo" src="{{ asset('storage/'.$complaint->image_path) }}" alt="Foto awal pengaduan">
    @endif
    @if ($complaint->completion_photo)
        <h2>Bukti penyelesaian</h2>
        <img class="photo" src="{{ asset('storage/'.$complaint->completion_photo) }}" alt="Bukti penyelesaian">
    @endif
    @if ($complaint->completion_note)
        <p><strong>Catatan penyelesaian:</strong><br>{{ $complaint->completion_note }}</p>
    @endif
</section>
<section class="panel">
    <h2>Tindak lanjut</h2>
    <form method="POST" action="{{ route('admin.pengaduan.update', $complaint) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <label for="status">Status</label>
        <select id="status" name="status" required>
            @foreach (['Sedang Diverifikasi Admin', 'Sedang Diproses / Ditindaklanjuti', 'Selesai'] as $status)
                <option value="{{ $status }}" @selected(old('status', $complaint->status) === $status)>{{ $status }}</option>
            @endforeach
        </select>
        <label for="admin_response">Respons admin</label>
        <textarea id="admin_response" name="admin_response">{{ old('admin_response', $complaint->admin_response) }}</textarea>
        <label for="completion_note">Catatan penyelesaian <span class="muted">(wajib jika status Selesai)</span></label>
        <textarea id="completion_note" name="completion_note">{{ old('completion_note', $complaint->completion_note) }}</textarea>
        <label for="completion_photo">Foto bukti penyelesaian <span class="muted">(wajib jika status Selesai; JPG/PNG/WEBP, maks. 5 MB)</span></label>
        <input id="completion_photo" type="file" name="completion_photo" accept="image/jpeg,image/png,image/webp">
        @if ($complaint->completion_photo)<p class="muted">Bukti saat ini tersimpan. Unggah foto baru hanya jika ingin menggantinya.</p>@endif
        <div style="margin-top:18px"><button class="btn" type="submit">Simpan tindak lanjut</button></div>
    </form>
</section>
@endsection