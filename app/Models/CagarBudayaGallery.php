<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CagarBudayaGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'cagar_budaya_id',
        'title',
        'deskripsi',
        'file',
        'order',
    ];
}
