<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resto;
use Illuminate\Http\Request;

class RestoController extends Controller
{
    public function index()
    {
        $restos = Resto::orderBy('nama_resto', 'asc')->paginate(10); 
        return view('admin.restos.index', compact('restos'));
    }

    public function create()
    {
        return view('admin.restos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_resto' => 'required|string|max:255',
            'harga_resto' => 'required|integer',
            'lokasi_resto' => 'required|string',
            'gambar' => 'nullable|url', // REVISI: Validasi URL
        ]);

        Resto::create([
            'nama_resto' => $request->nama_resto,
            'harga_resto' => $request->harga_resto,
            'lokasi_resto' => $request->lokasi_resto,
            'gambar' => $request->gambar, // REVISI: Ambil langsung link URL
        ]);

        return redirect()->route('restos.index')->with('success', 'Restoran berhasil ditambahkan!');
    }

    public function destroy(Resto $resto)
    {
        // REVISI: Logika hapus file di storage sudah dihapus
        $resto->delete();
        return redirect()->route('restos.index')->with('success', 'Restoran berhasil dihapus!');
    }
}