<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'bidang_id',
        'user_id',
        'title',
        'token',
        'slug',
        'image',
        'headline',
        'tanggal',
        'content',
        'publish',
        'tags',
        'hits',
    ];
}
