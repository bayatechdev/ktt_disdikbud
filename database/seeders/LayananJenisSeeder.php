<?php

namespace Database\Seeders;

use App\Models\LayananJenis;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LayananJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = 'Layanan 1';
        LayananJenis::create([
            'title' => $title,
            'token' => md5(microtime() . Str::random(3)),
            'slug'  => Str::slug($title),
            'order' => 1
        ]);
        $title = 'Layanan 2';
        LayananJenis::create([
            'title' => $title,
            'token' => md5(microtime() . Str::random(3)),
            'slug'  => Str::slug($title),
            'order' => 2
        ]);
        $title = 'Layanan 3';
        LayananJenis::create([
            'title' => $title,
            'token' => md5(microtime() . Str::random(3)),
            'slug'  => Str::slug($title),
            'order' => 3
        ]);
    }
}
