<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananJenis extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'token',
        'slug',
        'image',
        'description',
        'hits',
        'publish',
        'order',
    ];

    public function Layanans()
    {
        return $this->hasMany(Layanan::class, 'layananjenis_id', 'id');
    }
}
