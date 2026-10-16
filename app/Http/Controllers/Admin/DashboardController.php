<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPengaduan = Complaint::count();

        $menunggu = Complaint::where('status', 'pending')->count();

        $diproses = Complaint::where('status', 'processing')->count();

        $selesai = Complaint::where('status', 'done')->count();

        $complaints = Complaint::with(['user', 'category'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalPengaduan',
            'menunggu',
            'diproses',
            'selesai',
            'complaints'
        ));
    }
}
