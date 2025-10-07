<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    use HasFactory;

    protected $table = 'bundles';
    protected $primaryKey = 'id_bundle';
    public $timestamps = false;

    protected $fillable = [
        'nama_bundle',
        'deskripsi',
        'kesulitan',
        'jarak',
        'titik_kumpul',
        'gambar',
        'kabupaten',
        'link_maps',
        'gambar_thumbnail_maps',
        'rating',
    ];

    /**
     * REVISI BARU: Accessor untuk menerjemahkan tingkat kesulitan.
     * Ini memungkinkan kita memanggil $bundle->difficulty_in_english di view.
     */

    public function reviews()
    {
        return $this->hasMany(Review::class, 'bundle_id', 'id_bundle');
    }

    public function restos()
    {
        return $this->belongsToMany(Resto::class, 'bundle_resto', 'id_bundle', 'id_resto');
    }

    public function penginapans()
    {
        return $this->belongsToMany(Penginapan::class, 'bundle_penginapan', 'id_bundle', 'id_penginapan');
    }

    public function destinasis()
    {
        return $this->belongsToMany(Destinasi::class, 'bundle_destinasi', 'id_bundle', 'id_destinasi');
    }
}