<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideUtama extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'token',
        'image',
        'order',
        'publish',
        'note',
    ];
}
