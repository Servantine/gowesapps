<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('visitor.welcome'); // Menampilkan halaman welcome untuk pengunjung
    }

    public function userHome()
    {
        return view('user.home'); // Halaman untuk user
    }

    public function rutelist()
    {
        return view('visitor.rutelist'); // Menampilkan halaman rutelist untuk pengunjung
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
