@extends('admin.layout')

@section('title', 'Buat Laporan Bulanan')

@section('content')
<div class="row" style="margin-bottom: 16px;">
    <div>
        <h1>Buat Laporan Bulanan Baru</h1>
        <p class="subtitle" style="margin-bottom: 0;">Rekapitulasi data pengaduan mahasiswa pada periode tertentu dan simpan sebagai arsip resmi.</p>
    </div>
    <div>
        <a class="btn secondary" href="{{ route('admin.monthly-reports.index') }}">← Kembali ke Daftar Arsip</a>
    </div>
</div>

{{-- Peringatan jika periode sudah pernah diarsipkan --}}
@if ($existingReport)
    <div style="background: #fff0ed; border-left: 4px solid #c53030; padding: 14px 18px; margin-bottom: 22px; border-radius: 0 4px 4px 0; color: #9b2c2c;">
        <strong>Pemberitahuan:</strong> Laporan bulanan untuk periode <strong>{{ $monthsList[$currentMonth] }} {{ $currentYear }}</strong> sudah pernah dibuat pada tanggal {{ $existingReport->created_at->format('d/m/Y H:i') }} dengan nomor <strong>{{ $existingReport->report_number }}</strong>. Anda tidak dapat membuat duplikat arsip untuk periode yang sama.
        <div style="margin-top: 8px;">
            <a href="{{ route('admin.monthly-reports.show', $existingReport) }}" style="color: #9b2c2c; font-weight: 700; text-decoration: underline;">
                Lihat Arsip Terdaftar &rarr;
            </a>
        </div>
    </div>
@endif

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: start;">
    {{-- Form Pembuatan Laporan --}}
    <section class="panel">
        <h2 style="font-size: 18px; margin-top: 0; margin-bottom: 16px; color: var(--ink);">Parameter Laporan</h2>

        {{-- Form Pemilihan Periode (Trigger reload untuk kalkulasi preview) --}}
        <form method="GET" action="{{ route('admin.monthly-reports.create') }}" style="margin-bottom: 20px;">
            <label for="periode_select">Pilih Periode Rekapitulasi:</label>
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <select name="month" id="month" onchange="this.form.submit()" style="flex: 1;">
                    @foreach ($monthsList as $num => $name)
                        <option value="{{ $num }}" @selected($currentMonth == $num)>{{ $name }}</option>
                    @endforeach
                </select>
                <select name="year" id="year" onchange="this.form.submit()" style="width: 110px;">
                    @for ($y = (int) date('Y'); $y >= 2024; $y--)
                        <option value="{{ $y }}" @selected($currentYear == $y)>{{ $y }}</option>
                    @endfor
                </select>
                <button type="submit" class="btn secondary" style="padding: 9px 12px;">Cek Data</button>
            </div>
            <small class="muted" style="display: block; margin-top: 6px;">
                Memilih bulan/tahun akan memperbarui kalkulasi data pengaduan di sebelah kanan.
            </small>
        </form>

        <hr style="border: 0; border-top: 1px solid var(--line); margin: 20px 0;">

        {{-- Form Utama Penyimpanan Arsip --}}
        <form method="POST" action="{{ route('admin.monthly-reports.store') }}">
            @csrf
            <input type="hidden" name="month" value="{{ $currentMonth }}">
            <input type="hidden" name="year" value="{{ $currentYear }}">

            <div class="field">
                <label for="title">Judul Laporan</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title', 'Laporan Rekapitulasi Pengaduan Periode ' . $monthsList[$currentMonth] . ' ' . $currentYear) }}" 
                    required 
                    style="width: 100%;"
                >
                <small class="muted">Judul resmi yang akan tertera pada lembar arsip laporan.</small>
            </div>

            <div class="field">
                <label for="notes">Catatan Tambahan / Ringkasan Eksekutif (Opsional)</label>
                <textarea 
                    id="notes" 
                    name="notes" 
                    rows="4" 
                    placeholder="Tuliskan catatan evaluasi, ringkasan kendala, atau rekomendasi tindak lanjut penanganan pengaduan pada bulan ini..."
                >{{ old('notes') }}</textarea>
            </div>

            <div style="margin-top: 24px; display: flex; gap: 10px; align-items: center;">
                <button 
                    type="submit" 
                    class="btn" 
                    @disabled($existingReport) 
                    style="font-weight: 600; padding: 12px 20px;"
                >
                    Simpan Sebagai Arsip Laporan
                </button>
                <a class="btn secondary" href="{{ route('admin.monthly-reports.index') }}">Batal</a>
            </div>
        </form>
    </section>

    {{-- Panel Pratinjau Rekapitulasi Data Pengaduan --}}
    <section class="panel" style="background: #fafcfb;">
        <div class="row" style="margin-bottom: 14px;">
            <h2 style="font-size: 18px; margin: 0; color: var(--ink);">
                Pratinjau Rekapitulasi Data
            </h2>
            <span class="badge" style="background: #e6f4ea; color: #137333;">
                {{ $monthsList[$currentMonth] }} {{ $currentYear }}
            </span>
        </div>

        <p class="muted" style="margin-top: 0; font-size: 14px;">
            Berikut adalah kalkulasi data riil dari tabel <code>complaints</code> pada bulan yang dipilih:
        </p>

        {{-- Statistik Angka --}}
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px; margin-bottom: 20px;">
            <div style="background: white; border: 1px solid var(--line); border-radius: 4px; padding: 12px 14px;">
                <div class="muted" style="font-size: 12px; text-transform: uppercase;">Total Pengaduan Masuk</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--ink); margin-top: 4px;">{{ $previewStats['total'] }}</div>
            </div>
            <div style="background: white; border: 1px solid var(--line); border-radius: 4px; padding: 12px 14px;">
                <div class="muted" style="font-size: 12px; text-transform: uppercase;">Selesai Ditangani</div>
                <div style="font-size: 24px; font-weight: 700; color: var(--green); margin-top: 4px;">{{ $previewStats['completed'] }}</div>
            </div>
            <div style="background: white; border: 1px solid var(--line); border-radius: 4px; padding: 12px 14px;">
                <div class="muted" style="font-size: 12px; text-transform: uppercase;">Sedang Diverifikasi</div>
                <div style="font-size: 20px; font-weight: 700; color: #b45309; margin-top: 4px;">{{ $previewStats['pending'] }}</div>
            </div>
            <div style="background: white; border: 1px solid var(--line); border-radius: 4px; padding: 12px 14px;">
                <div class="muted" style="font-size: 12px; text-transform: uppercase;">Sedang Diproses</div>
                <div style="font-size: 20px; font-weight: 700; color: #0284c7; margin-top: 4px;">{{ $previewStats['processing'] }}</div>
            </div>
        </div>

        {{-- Breakdown per Kategori --}}
        <h3 style="font-size: 14px; text-transform: uppercase; color: var(--muted); margin: 16px 0 10px;">
            Rincian Berdasarkan Kategori:
        </h3>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th style="text-align: right;">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($previewCategories as $cat)
                    <tr>
                        <td>{{ $cat['name'] }}</td>
                        <td style="text-align: right; font-weight: 600;">{{ $cat['count'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="muted">Belum ada kategori terdaftar.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if ($previewStats['total'] === 0)
            <div style="margin-top: 14px; font-size: 13px; color: var(--muted); font-style: italic;">
                ℹ️ Belum ada laporan pengaduan mahasiswa yang masuk pada bulan ini. Anda tetap dapat menyimpan arsip laporan jika periode tersebut memang nihil laporan.
            </div>
        @endif
    </section>
</div>
@endsection
