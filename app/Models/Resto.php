<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resto extends Model
{
    use HasFactory;

    protected $table = 'restos';
    protected $primaryKey = 'id_resto';
    public $timestamps = false;

    protected $fillable = [
        'nama_resto',
        'harga_resto',
        'lokasi_resto',
        'gambar',
    ];

    /**
     * Relasi many-to-many ke model Bundle.
     */
    public function bundles()
    {
        return $this->belongsToMany(Bundle::class, 'bundle_resto', 'id_resto', 'id_bundle');
    }
}