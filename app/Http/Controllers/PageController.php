<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Bundle;
use App\Models\Review;

class PageController extends Controller
{
    public function home()
    {
        return view('user.home'); // Halaman untuk user
    }


    public function admin()
    {
        return view('admin.dashboard'); // Halaman untuk admin
    }

    public function visitor()
{

        $rekomendasiBundles = Bundle::where('rating', '>=', 4) 
                                      ->orderBy('rating', 'desc')
                                      ->limit(6)
                                      ->get();

        $bundleChunks = $rekomendasiBundles->chunk(3);
        
        $reviews = Review::with('bundle')->latest()->limit(3)->get();

        return view('visitor.welcome', [ 
            'bundleChunks' => $bundleChunks,
            'reviews'      => $reviews,
        ]);
    }

    public function userHome()
    {
        return view('user.home'); // Halaman untuk user
    }

    public function rutelist()
    {
        return view('visitor.rutelist'); // Menampilkan halaman rutelist untuk pengunjung
    }
        public function kontak()
    {
        return view('visitor.kontak'); // Halaman untuk user
    }

    public function detailrute()
    {
        return view('visitor.detailrute'); // Menampilkan halaman detailrute untuk pengunjung
    }
        public function pembayaran()
    {
        return view('visitor.pembayaran'); // Menampilkan halaman pembayaran untuk pengunjung
    }
    
}
