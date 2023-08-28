<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'kecamatan_id',
        'title',
        'slug',
        'image',
        'shp',
        'urut'
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id')
            ->select('id', 'kode', 'title', 'image', 'shp');
    }
}
