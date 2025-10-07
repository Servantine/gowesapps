<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use Illuminate\Http\Request;

class DestinasiController extends Controller
{
    public function index()
    {
        $destinasis = Destinasi::orderBy('nama_destinasi', 'asc')->paginate(10);
        return view('admin.destinasis.index', compact('destinasis'));
    }

    public function create()
    {
        return view('admin.destinasis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_destinasi' => 'required|string|max:255',
            'lokasi_destinasi' => 'required|string',
            'gambar' => 'nullable|url', // REVISI: Validasi URL
        ]);

        Destinasi::create([
            'nama_destinasi' => $request->nama_destinasi,
            'lokasi_destinasi' => $request->lokasi_destinasi,
            'gambar' => $request->gambar, // REVISI: Ambil langsung link URL
        ]);

        return redirect()->route('destinasis.index')->with('success', 'Destinasi berhasil ditambahkan!');
    }

    public function destroy(Destinasi $destinasi)
    {
        // REVISI: Logika hapus file di storage sudah dihapus
        $destinasi->delete();
        return redirect()->route('destinasis.index')->with('success', 'Destinasi berhasil dihapus!');
    }
}