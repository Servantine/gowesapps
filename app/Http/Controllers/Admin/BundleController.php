<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bundle;
use App\Models\Resto;
use App\Models\Destinasi;
use App\Models\Penginapan;
use Illuminate\Http\Request;

class BundleController extends Controller
{
    public function index()
    {
        $bundles = Bundle::with(['restos', 'destinasis', 'penginapans'])
                         ->orderBy('nama_bundle', 'asc')
                         ->paginate(10);
                         
        return view('admin.bundles.index', compact('bundles'));
    }

    public function create()
    {
        $restos = Resto::all();
        $destinasis = Destinasi::all();
        $penginapans = Penginapan::all();
        return view('admin.bundles.create', compact('restos', 'destinasis', 'penginapans'));
    }

    public function store(Request $request)
    {
        // REVISI BARU: Tambahkan validasi untuk kolom baru
        $request->validate([
            'nama_bundle' => 'required|string|max:255',
            'kesulitan' => 'required|string',
            'jarak' => 'required|integer',
            'titik_kumpul' => 'required|string',
            'kabupaten' => 'required|string',
            'gambar' => 'nullable|url',
            'link_maps' => 'nullable|url',
            'gambar_thumbnail_maps' => 'nullable|url',
            'rating' => 'nullable|numeric|between:0,5.0',
            'restos' => 'nullable|array',
            'destinasis' => 'nullable|array',
            'penginapans' => 'nullable|array',
        ]);

        // REVISI BARU: Tambahkan kolom baru saat membuat data
        $bundle = Bundle::create([
            'nama_bundle' => $request->nama_bundle,
            'kesulitan' => $request->kesulitan,
            'jarak' => $request->jarak,
            'titik_kumpul' => $request->titik_kumpul,
            'kabupaten' => $request->kabupaten,
            'gambar' => $request->gambar,
            'link_maps' => $request->link_maps,
            'gambar_thumbnail_maps' => $request->gambar_thumbnail_maps,
            'rating' => $request->rating,
        ]);
        
        $bundle->restos()->attach($request->restos);
        $bundle->destinasis()->attach($request->destinasis);
        $bundle->penginapans()->attach($request->penginapans);

        return redirect()->route('bundles.index')->with('success', 'Bundle berhasil ditambahkan!');
    }
    
    public function destroy(Bundle $bundle)
    {
        $bundle->delete();
        return redirect()->route('bundles.index')->with('success', 'Bundle berhasil dihapus!');
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'bundle_id', 'id_bundle');
    }
    }