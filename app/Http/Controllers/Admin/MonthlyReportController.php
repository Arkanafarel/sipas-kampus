<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\MonthlyReport;
use Illuminate\Http\Request;

class MonthlyReportController extends Controller
{
    private const STATUS_VERIFYING = 'Sedang Diverifikasi Admin';
    private const STATUS_PROCESSING = 'Sedang Diproses / Ditindaklanjuti';
    private const STATUS_DONE = 'Selesai';


    public function index(Request $request)
    {
        $query = MonthlyReport::with('creator');

        if ($request->filled('year')) {
            $query->where('year', (int) $request->input('year'));
        }

        if ($request->filled('month')) {
            $query->where('month', (int) $request->input('month'));
        }

        $reports = $query->orderByDesc('year')
            ->orderByDesc('month')
            ->paginate(12)
            ->withQueryString();

        // Opsi daftar tahun yang tersedia untuk filter
        $availableYears = MonthlyReport::select('year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');

        if ($availableYears->isEmpty()) {
            $availableYears = collect([(int) date('Y')]);
        }

        return view('admin.monthly_reports.index', compact('reports', 'availableYears'));
    }

    public function create(Request $request)
    {
        $currentMonth = (int) ($request->input('month', date('n')));
        $currentYear = (int) ($request->input('year', date('Y')));

        // Cek apakah arsip untuk periode ini sudah ada
        $existingReport = MonthlyReport::where('month', $currentMonth)
            ->where('year', $currentYear)
            ->first();

        // Hitung kalkulasi preview rekapitulasi pengaduan pada periode yang dipilih
        $previewComplaints = Complaint::with(['category', 'user'])
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->get();

        $previewStats = [
            'total' => $previewComplaints->count(),
            'pending' => $previewComplaints->where('status', self::STATUS_VERIFYING)->count(),
            'processing' => $previewComplaints->where('status', self::STATUS_PROCESSING)->count(),
            'completed' => $previewComplaints->where('status', self::STATUS_DONE)->count(),
        ];

        $categories = Category::all();
        $previewCategories = $categories->map(function ($cat) use ($previewComplaints) {
            return [
                'name' => $cat->name,
                'count' => $previewComplaints->where('category_id', $cat->id)->count(),
            ];
        });

        $monthsList = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        return view('admin.monthly_reports.create', compact(
            'currentMonth',
            'currentYear',
            'existingReport',
            'previewStats',
            'previewCategories',
            'monthsList'
        ));
    }

    public function store(Request $request)
    {
        $monthsList = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        $validated = $request->validate([
            'month' => ['required', 'integer', 'between:1,12'],
            'year' => ['required', 'integer', 'min:2020', 'max:' . ((int) date('Y') + 5)],
            'title' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $month = (int) $validated['month'];
        $year = (int) $validated['year'];

        // Pastikan arsip periode ini belum pernah dibuat sebelumnya
        $alreadyExists = MonthlyReport::where('month', $month)
            ->where('year', $year)
            ->exists();

        if ($alreadyExists) {
            return back()
                ->withInput()
                ->withErrors(['month' => "Laporan bulanan untuk periode {$monthsList[$month]} {$year} sudah pernah dibuat sebagai arsip."]);
        }

        // Query rekapitulasi data pengaduan dari tabel complaints
        $complaints = Complaint::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        $totalComplaints = $complaints->count();
        $totalPending = $complaints->where('status', self::STATUS_VERIFYING)->count();
        $totalProcessing = $complaints->where('status', self::STATUS_PROCESSING)->count();
        $totalCompleted = $complaints->where('status', self::STATUS_DONE)->count();

        // Rekapitulasi per kategori
        $categories = Category::all();
        $categorySummary = $categories->map(function ($cat) use ($complaints) {
            return [
                'category_id' => $cat->id,
                'name' => $cat->name,
                'count' => $complaints->where('category_id', $cat->id)->count(),
            ];
        })->values()->all();

        // Nomor registrasi arsip laporan unik
        $periodCode = sprintf('%04d%02d', $year, $month);
        $countInMonth = MonthlyReport::where('year', $year)->where('month', $month)->count() + 1;
        $reportNumber = 'LAP-' . $periodCode . '-' . sprintf('%03d', $countInMonth);

        // Judul default jika admin tidak mengisi judul custom
        $monthName = $monthsList[$month] ?? (string) $month;
        $title = !empty(trim($validated['title'] ?? ''))
            ? trim($validated['title'])
            : "Laporan Rekapitulasi Pengaduan Periode {$monthName} {$year}";

        $report = MonthlyReport::create([
            'report_number' => $reportNumber,
            'title' => $title,
            'month' => $month,
            'year' => $year,
            'total_complaints' => $totalComplaints,
            'total_pending' => $totalPending,
            'total_processing' => $totalProcessing,
            'total_completed' => $totalCompleted,
            'category_summary' => $categorySummary,
            'notes' => $validated['notes'] ?? null,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('admin.monthly-reports.show', $report)
            ->with('success', "Laporan bulanan periode {$monthName} {$year} berhasil dibuat dan diarsipkan.");
    }

    public function show(MonthlyReport $monthlyReport)
    {
        $monthlyReport->load('creator');

        // Ambil daftar pengaduan pada periode laporan untuk audit/inspeksi arsip
        $complaints = Complaint::with(['user', 'category'])
            ->whereYear('created_at', $monthlyReport->year)
            ->whereMonth('created_at', $monthlyReport->month)
            ->latest()
            ->get();

        return view('admin.monthly_reports.show', compact('monthlyReport', 'complaints'));
    }
}
