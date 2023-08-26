<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaKategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'token',
        'slug',
        'publish',
        'order',
    ];
}
