<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'bundle_id',
        'nama',
        'rating',
        'feedback',
    ];

    /**
     * Sebuah review dimiliki oleh satu bundle.
     */
    public function bundle()
    {
        return $this->belongsTo(Bundle::class, 'bundle_id', 'id_bundle');
    }
}