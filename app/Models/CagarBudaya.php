<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CagarBudaya extends Model
{
    use HasFactory;

    protected $fillable = [
        'desa_id',
        'nama_objek',
        'slug',
        'nama_tempat',
        'alamat',
        'deskripsi',
        'riwayat_kepemilikan',
        'latar_sejarah',
        'koordinat_lat',
        'koordinat_long',
    ];

    public function desa() {
        return $this->belongsTo(Desa::class, 'desa_id')->with(['kecamatan']);
    }
}
