<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamus extends Model
{
    // use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'kamus_bahasa_id',
        'word',
        'translate',
    ];
}
