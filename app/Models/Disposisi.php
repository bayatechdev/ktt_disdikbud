<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disposisi extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'surat_masuk_id',
        'token',
        'penerima_id',
        'status',
        'baca',
    ];

    public function surat_masuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id', 'id');
    }

    public function penerima()
    {
        return $this->belongsTo(Pegawai::class, 'penerima_id', 'id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'penerima_id', 'id')->select(['id', 'gambar', 'nama']);
    }
}
