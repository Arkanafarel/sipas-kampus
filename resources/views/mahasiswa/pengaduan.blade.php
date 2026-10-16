
<h1>Buat Pengaduan</h1>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('pengaduan.store') }}"
      enctype="multipart/form-data">
    @csrf

    <label>Judul Pengaduan</label>
    <input type="text" name="title"
           value="{{ old('title') }}" required>
    <br><br>

    <label>Kategori</label>
    <select name="category_id" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label>Isi Pengaduan</label>
    <textarea name="description" required>{{ old('description') }}</textarea>
    <br><br>

    <label>Foto Pendukung (Opsional)</label>
    <input type="file" name="image" accept="image/*">
    <br><br>

    <button type="submit">Kirim Pengaduan</button>
</form>

<a href="{{ route('home') }}">Kembali ke Beranda</a>
