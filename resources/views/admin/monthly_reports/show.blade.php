@extends('admin.layout')

@section('title', $monthlyReport->title)

@section('content')
<style>
    @media print {
        header, .no-print, nav, .btn {
            display: none !important;
        }
        body {
            background: white !important;
            color: black !important;
        }
        main {
            padding: 0 !important;
            max-width: 100% !important;
        }
        .panel {
            border: 1px solid #ccc !important;
            box-shadow: none !important;
        }
    }
</style>

<div class="row no-print" style="margin-bottom: 20px;">
    <div>
        <a class="btn secondary" href="{{ route('admin.monthly-reports.index') }}">← Kembali ke Daftar Arsip</a>
    </div>
    <div style="display: flex; gap: 8px;">
        <button class="btn" onclick="window.print()" type="button" style="background: #2563eb;">
            🖨️ Cetak / Simpan PDF
        </button>
    </div>
</div>

<article class="panel" style="padding: 32px 28px;">
    {{-- Header Lembar Arsip --}}
    <div style="border-bottom: 2px solid var(--ink); padding-bottom: 16px; margin-bottom: 24px; display: flex; justify-content: space-between; align-items: flex-start; gap: 20px; flex-wrap: wrap;">
        <div>
            <div style="font-size: 13px; font-weight: 700; color: var(--green); text-transform: uppercase; letter-spacing: 0.5px;">
                SIPAS KAMPUS &bull; ARSIP RESMI LAPORAN BULANAN
            </div>
            <h1 style="font-size: 24px; margin: 6px 0 4px; color: var(--ink);">
                {{ $monthlyReport->title }}
            </h1>
            <div class="muted" style="font-size: 14px;">
                Periode Rekapitulasi: <strong>{{ $monthlyReport->period_text }}</strong>
            </div>
        </div>
        <div style="text-align: right;">
            <div style="font-family: monospace; font-size: 14px; font-weight: 700; background: #eef2f0; padding: 6px 12px; border-radius: 4px; display: inline-block;">
                {{ $monthlyReport->report_number }}
            </div>
            <div class="muted" style="font-size: 12px; margin-top: 6px;">
                Diarsipkan pada: {{ $monthlyReport->created_at?->format('d/m/Y H:i') }}
            </div>
            <div class="muted" style="font-size: 12px;">
                Oleh Admin: <strong>{{ $monthlyReport->creator->name ?? 'Administrator' }}</strong>
            </div>
        </div>
    </div>

    {{-- Ringkasan Angka Rekapitulasi --}}
    <h3 style="font-size: 15px; text-transform: uppercase; color: var(--muted); margin-bottom: 12px;">
        I. Rekapitulasi Status Penanganan Pengaduan
    </h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-bottom: 28px;">
        <div style="border: 1px solid var(--line); border-radius: 4px; padding: 14px 16px; background: #fafcfb;">
            <span class="muted" style="font-size: 12px; text-transform: uppercase;">Total Pengaduan</span>
            <div style="font-size: 28px; font-weight: 700; color: var(--ink); margin-top: 4px;">
                {{ $monthlyReport->total_complaints }}
            </div>
        </div>
        <div style="border: 1px solid var(--line); border-radius: 4px; padding: 14px 16px; background: #f0fdf4;">
            <span class="muted" style="font-size: 12px; text-transform: uppercase; color: #166534;">Selesai Ditangani</span>
            <div style="font-size: 28px; font-weight: 700; color: var(--green); margin-top: 4px;">
                {{ $monthlyReport->total_completed }}
            </div>
        </div>
        <div style="border: 1px solid var(--line); border-radius: 4px; padding: 14px 16px; background: #fefce8;">
            <span class="muted" style="font-size: 12px; text-transform: uppercase; color: #854d0e;">Sedang Diproses</span>
            <div style="font-size: 28px; font-weight: 700; color: #0284c7; margin-top: 4px;">
                {{ $monthlyReport->total_processing }}
            </div>
        </div>
        <div style="border: 1px solid var(--line); border-radius: 4px; padding: 14px 16px; background: #fffbeb;">
            <span class="muted" style="font-size: 12px; text-transform: uppercase; color: #92400e;">Menunggu Verifikasi</span>
            <div style="font-size: 28px; font-weight: 700; color: #b45309; margin-top: 4px;">
                {{ $monthlyReport->total_pending }}
            </div>
        </div>
    </div>

    {{-- Rekapitulasi per Kategori --}}
    @if (!empty($monthlyReport->category_summary))
        <h3 style="font-size: 15px; text-transform: uppercase; color: var(--muted); margin-bottom: 12px;">
            II. Rekapitulasi Berdasarkan Kategori Layanan
        </h3>
        <div class="table-wrap" style="margin-bottom: 28px;">
            <table>
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Nama Kategori</th>
                        <th style="text-align: right; width: 150px;">Jumlah Pengaduan</th>
                        <th style="text-align: right; width: 140px;">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($monthlyReport->category_summary as $index => $cat)
                    @php
                        $percentage = $monthlyReport->total_complaints > 0 
                            ? round(($cat['count'] / $monthlyReport->total_complaints) * 100, 1) 
                            : 0;
                    @endphp
                    <tr>
                        <td class="muted">{{ $index + 1 }}</td>
                        <td><strong>{{ $cat['name'] }}</strong></td>
                        <td style="text-align: right; font-weight: 600;">{{ $cat['count'] }}</td>
                        <td style="text-align: right;" class="muted">{{ $percentage }}%</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- Catatan Arsip --}}
    @if ($monthlyReport->notes)
        <h3 style="font-size: 15px; text-transform: uppercase; color: var(--muted); margin-bottom: 12px;">
            III. Catatan & Evaluasi Pengelola
        </h3>
        <div style="background: #f8faf9; border: 1px solid var(--line); border-radius: 4px; padding: 16px; margin-bottom: 28px; white-space: pre-line; font-size: 14px; line-height: 1.6;">
            {{ $monthlyReport->notes }}
        </div>
    @endif

    {{-- Rincian Data Pengaduan Periode Ini --}}
    <h3 style="font-size: 15px; text-transform: uppercase; color: var(--muted); margin-bottom: 12px;">
        IV. Daftar Pengaduan Mahasiswa Pada Periode Ini
    </h3>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width: 40px;">No</th>
                    <th>Judul Pengaduan</th>
                    <th>Pelapor (Mahasiswa)</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal Masuk</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($complaints as $idx => $comp)
                <tr>
                    <td class="muted">{{ $idx + 1 }}</td>
                    <td><strong>{{ $comp->title }}</strong></td>
                    <td>
                        {{ $comp->user->name ?? '-' }}
                        @if ($comp->user?->npm)
                            <br><small class="muted">NPM: {{ $comp->user->npm }}</small>
                        @endif
                    </td>
                    <td>{{ $comp->category->name ?? '-' }}</td>
                    <td><span class="badge">{{ $comp->status }}</span></td>
                    <td>{{ $comp->created_at?->format('d/m/Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="muted" style="text-align: center; padding: 20px;">
                        Tidak ada pengaduan yang diajukan pada periode bulan ini.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- Tanda Tangan Pengesahan untuk Cetak Dokumen --}}
    <div style="margin-top: 48px; display: flex; justify-content: flex-end; text-align: center;">
        <div style="width: 250px;">
            <div style="font-size: 13px;" class="muted">
                Kampus, {{ $monthlyReport->created_at?->format('d F Y') }}
            </div>
            <div style="font-size: 14px; font-weight: 600; margin-top: 4px;">
                Administrator SIPAS Kampus
            </div>
            <div style="height: 70px;"></div>
            <div style="font-weight: 700; text-decoration: underline;">
                {{ $monthlyReport->creator->name ?? 'Administrator' }}
            </div>
            <div class="muted" style="font-size: 12px;">
                NIP / ID: {{ $monthlyReport->creator->id ?? '-' }}
            </div>
        </div>
    </div>
</article>
@endsection
