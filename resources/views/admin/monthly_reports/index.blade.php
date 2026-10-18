@extends('admin.layout')

@section('title', 'Daftar Arsip Laporan Bulanan')

@section('content')
<div class="row" style="margin-bottom: 20px;">
    <div>
        <h1>Arsip Laporan Bulanan</h1>
        <p class="subtitle" style="margin-bottom: 0;">Daftar rekapitulasi data pengaduan bulanan yang telah diarsipkan ke dalam sistem.</p>
    </div>
    <div>
        <a class="btn" href="{{ route('admin.monthly-reports.create') }}" style="font-weight: 600;">
            + Buat Laporan Bulanan Baru
        </a>
    </div>
</div>

<div style="background: #fdf8e2; border-left: 4px solid #b7791f; padding: 12px 16px; margin-bottom: 20px; border-radius: 0 4px 4px 0; font-size: 14px; color: #744210;">
    <strong>Catatan Arsip:</strong> Laporan bulanan yang telah dibuat bersifat arsip permanen (tidak dapat diedit/diubah) guna menjaga integritas data riwayat rekapitulasi pengaduan.
</div>

<section class="panel">
    {{-- Form Filter Periode --}}
    <form class="filters" method="GET" action="{{ route('admin.monthly-reports.index') }}">
        <select name="year" aria-label="Filter Tahun">
            <option value="">Semua Tahun</option>
            @foreach ($availableYears as $year)
                <option value="{{ $year }}" @selected(request('year') == $year)>Tahun {{ $year }}</option>
            @endforeach
        </select>
        <select name="month" aria-label="Filter Bulan">
            <option value="">Semua Bulan</option>
            @php
                $months = [
                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                ];
            @endphp
            @foreach ($months as $num => $name)
                <option value="{{ $num }}" @selected(request('month') == $num)>{{ $name }}</option>
            @endforeach
        </select>
        <button class="btn" type="submit">Filter Arsip</button>
        @if (request()->hasAny(['year', 'month']))
            <a class="btn secondary" href="{{ route('admin.monthly-reports.index') }}">Reset</a>
        @endif
    </form>

    {{-- Tabel Data Laporan Bulanan --}}
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No. Arsip</th>
                    <th>Periode</th>
                    <th>Judul Laporan</th>
                    <th style="text-align: center;">Total Pengaduan</th>
                    <th>Rekap Status</th>
                    <th>Dibuat Oleh</th>
                    <th>Tanggal Arsip</th>
                    <th style="text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($reports as $report)
                <tr>
                    <td>
                        <strong style="color: var(--green);">{{ $report->report_number }}</strong>
                    </td>
                    <td>
                        <strong>{{ $report->period_text }}</strong>
                    </td>
                    <td>
                        {{ $report->title }}
                    </td>
                    <td style="text-align: center;">
                        <span style="font-size: 16px; font-weight: 700; color: var(--ink);">
                            {{ $report->total_complaints }}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 4px; flex-wrap: wrap;">
                            <span class="badge" title="Sedang Diverifikasi" style="background: #fef3c7; color: #92400e;">
                                Menunggu: {{ $report->total_pending }}
                            </span>
                            <span class="badge" title="Sedang Diproses" style="background: #e0f2fe; color: #0369a1;">
                                Diproses: {{ $report->total_processing }}
                            </span>
                            <span class="badge" title="Selesai" style="background: #d1fae5; color: #065f46;">
                                Selesai: {{ $report->total_completed }}
                            </span>
                        </div>
                    </td>
                    <td>{{ $report->creator->name ?? 'Sistem' }}</td>
                    <td>{{ $report->created_at?->format('d/m/Y H:i') }}</td>
                    <td style="text-align: right;">
                        <a class="btn secondary" href="{{ route('admin.monthly-reports.show', $report) }}" style="font-size: 13px; padding: 6px 12px;">
                            Lihat Arsip
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px 16px;" class="muted">
                        <p style="margin: 0 0 10px;">Belum ada arsip laporan bulanan yang dibuat.</p>
                        <a class="btn" href="{{ route('admin.monthly-reports.create') }}">Buat Laporan Sekarang</a>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div style="margin-top: 20px;">
        {{ $reports->links() }}
    </div>
</section>
@endsection
