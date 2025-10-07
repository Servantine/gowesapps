<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penginapan;
use Illuminate\Http\Request;

class PenginapanController extends Controller
{
    public function index()
    {
        $penginapans = Penginapan::orderBy('nama_penginapan', 'asc')->paginate(10);
        return view('admin.penginapans.index', compact('penginapans'));
    }

    public function create()
    {
        return view('admin.penginapans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penginapan' => 'required|string|max:255',
            'harga_penginapan' => 'required|integer',
            'lokasi_penginapan' => 'required|string',
            'gambar' => 'nullable|url', // REVISI: Validasi URL
        ]);

        Penginapan::create([
            'nama_penginapan' => $request->nama_penginapan,
            'harga_penginapan' => $request->harga_penginapan,
            'lokasi_penginapan' => $request->lokasi_penginapan,
            'gambar' => $request->gambar, // REVISI: Ambil langsung link URL
        ]);

        return redirect()->route('penginapans.index')->with('success', 'Penginapan berhasil ditambahkan!');
    }

    public function destroy(Penginapan $penginapan)
    {
        // REVISI: Logika hapus file di storage sudah dihapus
        $penginapan->delete();
        return redirect()->route('penginapans.index')->with('success', 'Penginapan berhasil dihapus!');
    }
}