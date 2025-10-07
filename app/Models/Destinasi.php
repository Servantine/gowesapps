<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    use HasFactory;
    
    // Nama tabel sudah sesuai konvensi (destinasis), jadi tidak wajib
    // protected $table = 'destinasis'; 
    protected $primaryKey = 'id_destinasi';
    public $timestamps = false;

    protected $fillable = [
        'nama_destinasi',
        'lokasi_destinasi',
        'gambar',
    ];

    /**
     * Relasi many-to-many ke model Bundle.
     */
    public function bundles()
    {
        return $this->belongsToMany(Bundle::class, 'bundle_destinasi', 'id_destinasi', 'id_bundle');
    }
}