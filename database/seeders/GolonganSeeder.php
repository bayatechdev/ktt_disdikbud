<?php

namespace Database\Seeders;

use App\Models\Golongan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'Ia',
            'slug' => Str::slug('Ia'),
            'description' => 'Juru Muda',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'Ib',
            'slug' => Str::slug('Ib'),
            'description' => 'Juru Muda Tingkat I',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'Ic',
            'slug' => Str::slug('Ic'),
            'description' => 'Juru',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'Id',
            'slug' => Str::slug('Id'),
            'description' => 'Juru Tingkat I',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IIa',
            'slug' => Str::slug('IIa'),
            'description' => 'Pengatur Muda',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IIb',
            'slug' => Str::slug('IIb'),
            'description' => 'Pengatur Muda Tingkat I',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IIc',
            'slug' => Str::slug('IIc'),
            'description' => 'Pengatur',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IId',
            'slug' => Str::slug('IId'),
            'description' => 'Pengatur Tingkat I',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IIIa',
            'slug' => Str::slug('IIIa'),
            'description' => 'Penata Muda',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IIIb',
            'slug' => Str::slug('IIIb'),
            'description' => 'Penata Muda Tingkat I',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IIIc',
            'slug' => Str::slug('IIIc'),
            'description' => 'Penata',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IIId',
            'slug' => Str::slug('IIId'),
            'description' => 'Penata Tingkat I',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IVa',
            'slug' => Str::slug('IVa'),
            'description' => 'Pembina',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IVb',
            'slug' => Str::slug('IVb'),
            'description' => 'Pembina Tingkat I',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IVc',
            'slug' => Str::slug('IVc'),
            'description' => 'Pembina Utama Muda',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IVd',
            'slug' => Str::slug('IVd'),
            'description' => 'Pembina Utama Madya',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IVe',
            'slug' => Str::slug('IVe'),
            'description' => 'Pembina Utama',
        ]);
        Golongan::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'CPNS',
            'slug' => Str::slug('CPNS'),
            'description' => 'Calon Pegawai Negeri Sipil',
        ]);
       
    }
}
