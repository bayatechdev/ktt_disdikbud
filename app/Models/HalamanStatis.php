<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HalamanStatis extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'title',
        'slug',
        'image',
        'content',
        'hits',
        'order',
        'publish',
    ];
}
