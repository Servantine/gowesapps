<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penginapan extends Model
{
    use HasFactory;

    protected $table = 'penginapans';
    protected $primaryKey = 'id_penginapan';
    public $timestamps = false;

    protected $fillable = [
        'nama_penginapan',
        'harga_penginapan',
        'lokasi_penginapan',
        'gambar',
    ];

    /**
     * Relasi many-to-many ke model Bundle.
     */
    public function bundles()
    {
        return $this->belongsToMany(Bundle::class, 'bundle_penginapan', 'id_penginapan', 'id_bundle');
    }
}