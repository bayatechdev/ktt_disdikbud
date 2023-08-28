<?php

namespace Database\Seeders;

use App\Models\BeritaKategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class BeritaKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BeritaKategori::create([
            'title' => 'Kabar Berita',
            'token' => md5(microtime() . Str::random(10)),
            'slug' => Str::slug('Kabar Berita'),
            'publish' => true,
            'order' => 1,
        ]);
        BeritaKategori::create([
            'title' => 'Pengumuman',
            'token' => md5(microtime() . Str::random(10)),
            'slug' => Str::slug('Pengumuman'),
            'publish' => true,
            'order' => 2,
        ]);
    }
}
