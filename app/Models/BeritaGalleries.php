<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaGalleries extends Model
{
    use HasFactory;

    protected $fillable = [
        'gal_token',
        'gal_title',
        'gal_image',
        'berita_id',
        'gal_status',
        'gal_order',
    ];

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'berita_id');
    }
}
