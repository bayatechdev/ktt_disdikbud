<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryFoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'albums_id',
        'title',
        'token',
        'image',
        'publish',
        'order',
    ];

    public function albums()
    {
        return $this->belongsTo(GalleryAlbum::class, 'albums_id');
    }
}
