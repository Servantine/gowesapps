<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Bundle $bundle)
    {
        // 1. Validasi input dari form
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'feedback' => 'required|string|min:10',
            'nama' => 'nullable|string|max:100',
        ]);

        // 2. Simpan ulasan baru ke database melalui relasi
        $bundle->reviews()->create([
            'nama' => $validated['nama'] ?? 'Anonim',
            'rating' => $validated['rating'],
            'feedback' => $validated['feedback'],
        ]);

        // 3. Hitung ulang rating rata-rata dan update tabel bundle
        $newAverageRating = $bundle->reviews()->avg('rating');
        $bundle->update(['rating' => $newAverageRating]);

        // 4. Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim.');
    }
}