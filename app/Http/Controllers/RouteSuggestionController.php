<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RouteSuggestion; // Import model

class RouteSuggestionController extends Controller
{
    // --- UNTUK USER ---

    // Menampilkan form saran rute ke user
    public function create()
    {
        return view('visitor.suggestions');
    }

    // Menyimpan data dari form yang diisi user
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'nama_pengirim' => 'required|string|max:255',
            'email_pengirim' => 'required|email|max:255',
            'nama_rute' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'estimasi_jarak' => 'required|numeric|min:0',
            'tingkat_kesulitan' => 'required|in:Easy,Intermediate,Expert',
        ]);

        // 2. Simpan ke database
        RouteSuggestion::create($validatedData);

        // 3. Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Terima kasih! Saran rute Anda telah kami terima dan akan segera ditinjau oleh admin.');
    }

    // --- UNTUK ADMIN ---

    // Menampilkan daftar saran di dashboard admin
    public function adminIndex()
    {
        $suggestions = RouteSuggestion::latest()->get(); // Ambil semua data, urutkan dari yang terbaru
        return view('admin.suggestions.index', ['suggestions' => $suggestions]);
    }
    
    // Fungsi untuk update status (akan kita buat di langkah selanjutnya)
    public function updateStatus(Request $request, RouteSuggestion $suggestion)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected']);

        $suggestion->update(['status' => $request->status]);

        return redirect()->route('suggestions.index')->with('success', 'Status saran berhasil diperbarui.');
    }

    // Fungsi untuk hapus data (akan kita buat di langkah selanjutnya)
    public function destroy(RouteSuggestion $suggestion)
    {
        $suggestion->delete();
        return redirect()->route('suggestions.index')->with('success', 'Saran berhasil dihapus.');
    }
}