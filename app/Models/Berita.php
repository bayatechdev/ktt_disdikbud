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

    public function kategori()
    {
        return $this->belongsTo(BeritaKategori::class, 'kategori_id')->select(['id', 'title']);
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id')->select(['id', 'title']);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select(['id', 'name']);
    }
}
