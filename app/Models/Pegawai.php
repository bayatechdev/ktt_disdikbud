<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'token',
        'bidang_id',
        'jabatan_id',
        'golongan_id',
        'eselon_id',
        'nip',
        'nama',
        'jkel',
        'lahir_tempat',
        'lahir_tanggal',
        'alamat',
        'gambar',
        'notelp',
        'agama',
        'publish',
        'urutan',
        'pptk',
        'pemberi_perintah',
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id')->select(['id', 'title']);
    }
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id')->select(['id', 'title']);
    }
    public function golongan()
    {
        return $this->belongsTo(Golongan::class, 'golongan_id', 'id')->select(['id', 'title', 'description']);
    }
    public function eselon()
    {
        return $this->belongsTo(Eselon::class, 'eselon_id', 'id')->select(['id', 'title']);
    }
}
