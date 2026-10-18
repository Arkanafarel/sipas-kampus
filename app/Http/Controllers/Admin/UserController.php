<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter pencarian berdasarkan nama, email, atau NPM
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('npm', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan peran (role)
        if ($request->filled('role')) {
            $query->where('role', $request->input('role'));
        }

        // Statistik ringkas pengguna
        $totalUsers = User::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();

        // Ambil data dengan pagination dan pertahankan parameter query string
        $users = $query->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', compact(
            'users',
            'totalUsers',
            'totalAdmin',
            'totalMahasiswa'
        ));
    }
}
