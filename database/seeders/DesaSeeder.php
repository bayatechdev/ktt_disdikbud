<?php

namespace Database\Seeders;

use App\Models\Desa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sesayap
        Desa::create([
            'kode' => '65.04.01.2001',
            'kecamatan_id' => 1,
            'title' => 'Tideng Pale',
            'slug' => 'tidengpale',
            'maps_id' => 'tidengpale',
            'urut' => 1
        ]);
        Desa::create([
            'kode' => '65.04.01.2002',
            'kecamatan_id' => 1,
            'title' => 'Limbu Sedulun',
            'slug' => 'limbusedulun',
            'maps_id' => 'limbusedulun',
            'urut' => 2
        ]);
        Desa::create([
            'kode' => '65.04.01.2003',
            'kecamatan_id' => 1,
            'title' => 'Sebidai',
            'slug' => 'sebidai',
            'maps_id' => 'sebidai',
            'urut' => 3
        ]);
        Desa::create([
            'kode' => '65.04.01.2004',
            'kecamatan_id' => 1,
            'title' => 'Sedulun',
            'slug' => 'sedulun',
            'maps_id' => 'sedulun',
            'urut' => 4
        ]);
        Desa::create([
            'kode' => '65.04.01.2005',
            'kecamatan_id' => 1,
            'title' => 'Tideng Pale Timur',
            'slug' => 'tidengpaletimur',
            'maps_id' => 'tidengpaletimur',
            'urut' => 5
        ]);
        Desa::create([
            'kode' => '65.04.01.2006',
            'kecamatan_id' => 1,
            'title' => 'Gunawan',
            'slug' => 'gunawan',
            'maps_id' => 'gunawan',
            'urut' => 6
        ]);
        Desa::create([
            'kode' => '65.04.01.2007',
            'kecamatan_id' => 1,
            'title' => 'Sebawang',
            'slug' => 'sebawang',
            'maps_id' => 'sebawang',
            'urut' => 7
        ]);

        // Sesayap Hilir
        Desa::create([
            'kode' => '65.04.02.2001',
            'kecamatan_id' => 2,
            'title' => 'Sesayap',
            'slug' => 'sesayap',
            'maps_id' => 'sesayap',
            'urut' => 1
        ]);
        Desa::create([
            'kode' => '65.04.02.2002',
            'kecamatan_id' => 2,
            'title' => 'Sengkong',
            'slug' => 'sengkong',
            'maps_id' => 'sengkong',
            'urut' => 2
        ]);
        Desa::create([
            'kode' => '65.04.02.2003',
            'kecamatan_id' => 2,
            'title' => 'Bebatu',
            'slug' => 'bebatu',
            'maps_id' => 'bebatu',
            'urut' => 3
        ]);
        Desa::create([
            'kode' => '65.04.02.2004',
            'kecamatan_id' => 2,
            'title' => 'Bandan Bikis',
            'slug' => 'bandanbikis',
            'maps_id' => 'bandanbikis',
            'urut' => 4
        ]);
        Desa::create([
            'kode' => '65.04.02.2005',
            'kecamatan_id' => 2,
            'title' => 'Sepala Dalung',
            'slug' => 'sepaladalung',
            'maps_id' => 'sepaladalung',
            'urut' => 5
        ]);
        Desa::create([
            'kode' => '65.04.02.2006',
            'kecamatan_id' => 2,
            'title' => 'Seludau',
            'slug' => 'seludau',
            'maps_id' => 'seludau',
            'urut' => 6
        ]);
        Desa::create([
            'kode' => '65.04.02.2007',
            'kecamatan_id' => 2,
            'title' => 'Menjelutung',
            'slug' => 'menjelutung',
            'maps_id' => 'menjelutung',
            'urut' => 7
        ]);
        Desa::create([
            'kode' => '65.04.02.2008',
            'kecamatan_id' => 2,
            'title' => 'Sesayap Selor',
            'slug' => 'sesayapselor',
            'maps_id' => 'sesayapselor',
            'urut' => 8
        ]);

        // Tana Lia
        Desa::create([
            'kode' => '65.04.03.2001',
            'kecamatan_id' => 3,
            'title' => 'Tanah Merah',
            'slug' => 'tanahmerah',
            'maps_id' => 'tanahmerah',
            'urut' => 1
        ]);
        Desa::create([
            'kode' => '65.04.03.2002',
            'kecamatan_id' => 3,
            'title' => 'Tengku Dacing',
            'slug' => 'tengkudacing',
            'maps_id' => 'tengkudacing',
            'urut' => 2
        ]);
        Desa::create([
            'kode' => '65.04.03.2003',
            'kecamatan_id' => 3,
            'title' => 'Sambungan',
            'slug' => 'sambungan',
            'maps_id' => 'sambungan',
            'urut' => 3
        ]);
        Desa::create([
            'kode' => '65.04.03.2004',
            'kecamatan_id' => 3,
            'title' => 'Tanah Merah Barat',
            'slug' => 'tanahmerahbarat',
            'maps_id' => 'tanahmerahbarat',
            'urut' => 4
        ]);
        Desa::create([
            'kode' => '65.04.03.2005',
            'kecamatan_id' => 3,
            'title' => 'Sambungan Selatan',
            'slug' => 'sambunganselatan',
            'maps_id' => 'sambunganselatan',
            'urut' => 5
        ]);

        // Betayau
        Desa::create([
            'kode' => '65.04.04.2001',
            'kecamatan_id' => 4,
            'title' => 'Buong Baru',
            'slug' => 'buongbaru',
            'maps_id' => 'buongbaru',
            'urut' => 1
        ]);
        Desa::create([
            'kode' => '65.04.04.2002',
            'kecamatan_id' => 4,
            'title' => 'Bebakung',
            'slug' => 'bebakung',
            'maps_id' => 'bebakung',
            'urut' => 2
        ]);
        Desa::create([
            'kode' => '65.04.04.2003',
            'kecamatan_id' => 4,
            'title' => 'Kujau',
            'slug' => 'kujau',
            'maps_id' => 'kujau',
            'urut' => 3
        ]);
        Desa::create([
            'kode' => '65.04.04.2004',
            'kecamatan_id' => 4,
            'title' => 'Mendupo',
            'slug' => 'mendupo',
            'maps_id' => 'mendupo',
            'urut' => 4
        ]);
        Desa::create([
            'kode' => '65.04.04.2005',
            'kecamatan_id' => 4,
            'title' => 'Maning',
            'slug' => 'maning',
            'maps_id' => 'maning',
            'urut' => 5
        ]);
        Desa::create([
            'kode' => '65.04.04.2006',
            'kecamatan_id' => 4,
            'title' => 'Periuk',
            'slug' => 'periuk',
            'maps_id' => 'periuk',
            'urut' => 6
        ]);

        // Muruk Rian
        Desa::create([
            'kode' => '65.04.05.2001',
            'kecamatan_id' => 5,
            'title' => 'Seputuk',
            'slug' => 'seputuk',
            'maps_id' => 'seputuk',
            'urut' => 1
        ]);
        Desa::create([
            'kode' => '65.04.05.2002',
            'kecamatan_id' => 5,
            'title' => 'Rian',
            'slug' => 'rian',
            'maps_id' => 'rian',
            'urut' => 2
        ]);
        Desa::create([
            'kode' => '65.04.05.2003',
            'kecamatan_id' => 5,
            'title' => 'Balayan Ari',
            'slug' => 'balayanari',
            'maps_id' => 'balayanari',
            'urut' => 3
        ]);
        Desa::create([
            'kode' => '65.04.05.2004',
            'kecamatan_id' => 5,
            'title' => 'Rian Rayo',
            'slug' => 'rianrayo',
            'maps_id' => 'rianrayo',
            'urut' => 4
        ]);
        Desa::create([
            'kode' => '65.04.05.2005',
            'kecamatan_id' => 5,
            'title' => 'Kapuak',
            'slug' => 'kapuak',
            'maps_id' => 'kapuak',
            'urut' => 5
        ]);
        Desa::create([
            'kode' => '65.04.05.2006',
            'kecamatan_id' => 5,
            'title' => 'Sapari',
            'slug' => 'sapari',
            'maps_id' => 'sapari',
            'urut' => 6
        ]);
    }
}
