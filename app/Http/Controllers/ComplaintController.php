<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view('pengaduan.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('complaints', 'public')
            : null;

        Complaint::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
            'status' => 'pending',
        ]);

        return redirect()->route('home')
            ->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function index()
    {
        $complaints = Complaint::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('mahasiswa.pengaduan.index', compact('complaints'));
    }

    public function show($id)
    {
        $pengaduan = Complaint::where('user_id', auth()->id())
            ->findOrFail($id);

        return view('mahasiswa.pengaduan.show', compact('pengaduan'));
    }
}