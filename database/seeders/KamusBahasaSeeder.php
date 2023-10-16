<?php

namespace Database\Seeders;

use App\Models\KamusBahasa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KamusBahasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KamusBahasa::create([
            'title'         => 'Indonesia - Tidung',
            'alias'         => 'IND-TDG',
            'description'   => NULL,
            'order'         => 1,
            'active'        => TRUE
        ]);

        KamusBahasa::create([
            'title'         => 'Tidung - Indonesia',
            'alias'         => 'TDG-IND',
            'description'   => NULL,
            'order'         => 2,
            'active'        => TRUE
        ]);

        KamusBahasa::create([
            'title'         => 'Indonesia - Belusu',
            'alias'         => 'IND-BLS',
            'description'   => NULL,
            'order'         => 3,
            'active'        => TRUE
        ]);

        KamusBahasa::create([
            'title'         => 'Belusu - Indonesia',
            'alias'         => 'BLS-IND',
            'description'   => NULL,
            'order'         => 4,
            'active'        => TRUE
        ]);
    }
}
