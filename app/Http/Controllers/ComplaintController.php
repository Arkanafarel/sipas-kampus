<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    const STATUS_DRAFT = 'Sedang Diverifikasi Admin';
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
            'status' => self::STATUS_DRAFT,
        ]);

        return redirect()->route('home')
            ->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function index()
    {
        $pengaduan = Complaint::with('category')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('mahasiswa.pengaduan.index', compact('pengaduan'));
    }

    public function show($id)
    {
        $pengaduan = Complaint::with('category')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('mahasiswa.pengaduan.show', compact('pengaduan'));
    }
    public function edit($id)
    {
        $pengaduan = Complaint::where('user_id', Auth::id())->findOrFail($id);

        if ($pengaduan->status !== self::STATUS_DRAFT) {
            return redirect()->route('pengaduan.index')
                ->with('error', 'Pengaduan tidak dapat diubah karena sudah diproses.');
        }

        $categories = Category::all();

        return view('mahasiswa.pengaduan.edit', compact('pengaduan', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $pengaduan = Complaint::where('user_id', Auth::id())->findOrFail($id);

        if ($pengaduan->status !== self::STATUS_DRAFT) {
            return redirect()->route('pengaduan.index')
                ->with('error', 'Pengaduan tidak dapat diubah karena sudah diproses.');
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        $data = [
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            if ($pengaduan->image_path && Storage::disk('public')->exists($pengaduan->image_path)) {
                Storage::disk('public')->delete($pengaduan->image_path);
            }
            $data['image_path'] = $request->file('image')->store('complaints', 'public');
        }

        $pengaduan->update($data);

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $pengaduan = Complaint::where('user_id', Auth::id())->findOrFail($id);

        if ($pengaduan->status !== self::STATUS_DRAFT) {
            return redirect()->route('pengaduan.index')
                ->with('error', 'Pengaduan tidak dapat dihapus karena sudah diproses.');
        }

        if ($pengaduan->image_path && Storage::disk('public')->exists($pengaduan->image_path)) {
            Storage::disk('public')->delete($pengaduan->image_path);
        }

        $pengaduan->delete();
        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus!');
    }
}
