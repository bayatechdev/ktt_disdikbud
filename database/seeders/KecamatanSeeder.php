<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kecamatan::create([
            'kode' => '65.04.01',
            'title' => 'Sesayap',
            'slug' => 'sesayap',
            'maps_id' => 'kecsesayap',
            'urut' => 1
        ]);

        Kecamatan::create([
            'kode' => '65.04.02',
            'title' => 'Sesayap Hilir',
            'slug' => 'sesayap-hilir',
            'maps_id' => 'kecsesayaphilir',
            'urut' => 2
        ]);

        Kecamatan::create([
            'kode' => '65.04.03',
            'title' => 'Tana Lia',
            'slug' => 'tana-lia',
            'maps_id' => 'kectanalia',
            'urut' => 3
        ]);

        Kecamatan::create([
            'kode' => '65.04.04',
            'title' => 'Betayau',
            'slug' => 'betayau',
            'maps_id' => 'kecbetayau',
            'urut' => 4
        ]);
        
        Kecamatan::create([
            'kode' => '65.04.05',
            'title' => 'Muruk Rian',
            'slug' => 'muruk-rian',
            'maps_id' => 'kecmurukrian',
            'urut' => 5
        ]);
    }
}
