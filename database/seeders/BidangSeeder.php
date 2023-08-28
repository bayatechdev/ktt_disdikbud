<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bidang::create([
            'title' => 'Kepala Dinas',
            'token' => md5(microtime() . Str::random(10)),
            'slug' => Str::slug('Kepala Dinas'),
            'nick' => 'Kadis',
            'publish' => true,
            'order' => 1,
        ]);
        Bidang::create([
            'title' => 'Sekretariat',
            'token' => md5(microtime() . Str::random(10)),
            'slug' => Str::slug('Sekretariat'),
            'nick' => 'Sekretariat',
            'publish' => true,
            'order' => 2,
        ]);
        Bidang::create([
            'title' => 'Umum dan Kepegawaian',
            'token' => md5(microtime() . Str::random(10)),
            'slug' => Str::slug('Umum dan Kepegawaian'),
            'nick' => 'Kepegawaian',
            'publish' => true,
            'order' => 3,
        ]);
        Bidang::create([
            'title' => 'Program Keuangan',
            'token' => md5(microtime() . Str::random(10)),
            'slug' => Str::slug('Program Keuangan'),
            'nick' => 'Keuangan',
            'publish' => true,
            'order' => 4,
        ]);
        Bidang::create([
            'title' => 'Bidang Pendidikan Dasar',
            'token' => md5(microtime() . Str::random(10)),
            'slug' => Str::slug('Bidang Pendidikan Dasar'),
            'nick' => 'Dikdas',
            'publish' => true,
            'order' => 5,
        ]);
        Bidang::create([
            'title' => 'Bidang PNFI',
            'token' => md5(microtime() . Str::random(10)),
            'slug' => Str::slug('Bidang PNFI'),
            'nick' => 'PNFI',
            'publish' => true,
            'order' => 6,
        ]);
        Bidang::create([
            'title' => 'Bidang Kebudayaan',
            'token' => md5(microtime() . Str::random(10)),
            'slug' => Str::slug('Bidang Kebudayaan'),
            'nick' => 'Kebudayaan',
            'publish' => true,
            'order' => 7,
        ]);
        Bidang::create([
            'title' => 'Pengawas',
            'token' => md5(microtime() . Str::random(10)),
            'slug' => Str::slug('Pengawas'),
            'nick' => 'Pengawas',
            'publish' => true,
            'order' => 8,
        ]);
        Bidang::create([
            'title' => 'Kelompok Jabatan Fungsional',
            'token' => md5(microtime() . Str::random(10)),
            'slug' => Str::slug('Kelompok Jabatan Fungsional'),
            'nick' => 'Fungsional',
            'publish' => true,
            'order' => 9,
        ]);
    }
}
