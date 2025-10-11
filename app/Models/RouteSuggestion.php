<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteSuggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengirim',
        'email_pengirim',
        'nama_rute',
        'lokasi',
        'deskripsi',
        'estimasi_jarak',
        'tingkat_kesulitan',
        'status', // status tidak diisi user, tapi kita masukkan agar bisa di-update oleh admin
    ];
}