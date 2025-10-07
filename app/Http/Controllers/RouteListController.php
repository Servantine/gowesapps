<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use Illuminate\Http\Request;

class RouteListController extends Controller
{
    public function index(Request $request)
    {
        $query = Bundle::query()->withCount(['restos', 'penginapans']);

        // 1. Handle Pencarian (Search)
        if ($request->filled('search')) {
            $query->where('nama_bundle', 'like', '%' . $request->search . '%');
        }

        // 2. Handle Filter dari offcanvas
        if ($request->filled('kabupaten')) {
            $query->where('kabupaten', $request->kabupaten);
        }

        if ($request->filled('kesulitan')) {
            $query->where('kesulitan', $request->kesulitan);
        }
        
        if ($request->filled('rating') && is_numeric($request->rating)) {
            $query->where('rating', '>=', $request->rating);
        }

        // 3. Handle Pengurutan (Sort)
        
        // REVISI: Gunakan filled() untuk memeriksa apakah parameter 'sort' ada dan tidak kosong.
        // Ini akan mencegah error jika form mengirim sort="".
        $sort = $request->filled('sort') ? $request->input('sort') : 'nama_bundle';
        
        $direction = in_array($sort, ['jarak', 'rating']) ? 'desc' : 'asc';
        
        // Validasi sederhana untuk memastikan $sort adalah kolom yang diizinkan
        $allowedSorts = ['nama_bundle', 'jarak', 'rating'];
        if (!in_array($sort, $allowedSorts)) {
            $sort = 'nama_bundle'; // Fallback ke default jika nilai tidak valid
        }

        $query->orderBy($sort, $direction);

        // 4. Ambil data dengan pagination
        $bundles = $query->paginate(9)->withQueryString();
        
        $kabupatens = Bundle::select('kabupaten')->distinct()->orderBy('kabupaten', 'asc')->get();

        // 5. Kirim data ke view
        return view('rutelist', [
            'bundles' => $bundles,
            'kabupatens' => $kabupatens
        ]);
    }

    public function show(Bundle $bundle)
    {
        $bundle->load(['destinasis', 'restos', 'penginapans', 'reviews']);
        return view('rute-detail', compact('bundle'));
    }
}