<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'bundle_id',
        'nama_lengkap',
        'nomer_wa',
        'tanggal_checkin',
        'tanggal_checkout',
        'catatan',
        'detail_pesanan',
        'total_harga',
        'metode_pembayaran',
        'status_pembayaran',
    ];

    protected $casts = [
        'detail_pesanan' => 'array', // Otomatis konversi JSON ke array
    ];

    public function bundle()
    {
        return $this->belongsTo(Bundle::class, 'bundle_id', 'id_bundle');
    }
}