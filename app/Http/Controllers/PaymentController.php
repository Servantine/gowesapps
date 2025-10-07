<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create()
    {
        return view('payment.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'bundle_id' => 'required|exists:bundles,id_bundle',
            'nama_lengkap' => 'required|string|max:255',
            'nomer_wa' => 'required|string|max:20',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after_or_equal:tanggal_checkin',
            'catatan' => 'nullable|string',
            'detail_pesanan' => 'required|json',
            'total_harga' => 'required|integer',
            'metode_pembayaran' => 'required|string|in:QRIS,Cash',
        ]);

        // REVISI KRUSIAL: Ubah string JSON dari form menjadi PHP array
        // sebelum disimpan ke database untuk menghindari double encoding.
        // Argumen 'true' memastikan hasilnya adalah associative array.
        $validated['detail_pesanan'] = json_decode($validated['detail_pesanan'], true);

        // Sekarang, saat create() dipanggil, Eloquent akan menerima array
        // dan menyimpannya sebagai objek JSON yang bersih dan benar.
        Booking::create($validated);
        
        // Hapus sessionStorage setelah pesanan berhasil dibuat
        session()->flash('clear-checkout-session', true);

        return redirect()->route('payment.success');
    }

    public function success()
    {
        return view('payment.success');
    }
}