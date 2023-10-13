<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'layananjenis_id',
        'layanan_tab_id',
        'token',
        'title',
        'order',
        'file',
        'publish',
        'hits',
    ];
}
