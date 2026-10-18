<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    private const STATUS_VERIFYING = 'Sedang Diverifikasi Admin';
    private const STATUS_PROCESSING = 'Sedang Diproses / Ditindaklanjuti';
    private const STATUS_DONE = 'Selesai';

    public function index(Request $request)
    {
        $complaints = Complaint::with(['user', 'category'])
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->string('search')->toString();
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhereHas('user', fn ($users) => $users->where('name', 'like', "%{$search}%"));
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.complaints.index', compact('complaints'));
    }

    public function show(Complaint $complaint)
    {
        $complaint->load(['user', 'category']);

        return view('admin.complaints.show', compact('complaint'));
    }

    public function update(Request $request, Complaint $complaint)
    {
        $status = $request->input('status');
        $isDone = $status === self::STATUS_DONE;

        $validated = $request->validate([
            'status' => ['required', 'in:'.implode(',', [self::STATUS_VERIFYING, self::STATUS_PROCESSING, self::STATUS_DONE])],
            'admin_response' => ['nullable', 'string', 'max:5000'],
            'completion_note' => [$isDone ? 'required' : 'nullable', 'string', 'max:5000'],
            'completion_photo' => [$isDone && !$complaint->completion_photo ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        if ($request->hasFile('completion_photo')) {
            $oldPhoto = $complaint->completion_photo;
            $validated['completion_photo'] = $request->file('completion_photo')->store('completion-proofs', 'public');
        }

        $complaint->update([
            'status' => $validated['status'],
            'admin_response' => $validated['admin_response'] ?? null,
            'completion_note' => $validated['completion_note'] ?? $complaint->completion_note,
            ... (isset($validated['completion_photo']) ? ['completion_photo' => $validated['completion_photo']] : []),
        ]);

        if (isset($oldPhoto)) {
            Storage::disk('public')->delete($oldPhoto);
        }

        return redirect()->route('admin.pengaduan.show', $complaint)
            ->with('success', 'Tindak lanjut pengaduan berhasil disimpan.');
    }
}