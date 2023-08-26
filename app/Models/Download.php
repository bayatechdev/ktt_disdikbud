<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'title',
        'token',
        'file',
        'publish',
        'hits',
        'note',
        'order',
        'extension',
    ];
}
