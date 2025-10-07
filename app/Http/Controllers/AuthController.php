<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika login berhasil, periksa role pengguna
            $user = Auth::user();

            // Arahkan ke halaman admin jika role admin
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Arahkan ke halaman home jika role user
            return redirect()->route('home');
        }

        // Jika login gagal
        return back()->withErrors(['email' => 'Login failed']);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
