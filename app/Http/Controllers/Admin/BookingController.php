<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('bundle')->latest()->paginate(15);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }
    
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate(['status_pembayaran' => 'required|in:pending,paid,cancelled']);
        
        $booking->update([
            'status_pembayaran' => $request->status_pembayaran
        ]);

        return back()->with('success', 'Status pemesanan berhasil diperbarui!');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Pemesanan berhasil dihapus.');
    }
}