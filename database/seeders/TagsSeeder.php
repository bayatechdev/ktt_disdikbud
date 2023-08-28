<?php

namespace Database\Seeders;

use App\Models\Tags;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tags::create([
            'title' => 'Olahraga',
            'token' => md5(microtime() . Str::random(10)),
            'slug' => Str::slug('Olahraga'),
            'publish' => true,
            'order' => 1,
        ]);
        Tags::create([
            'title' => 'Lomba',
            'token' => md5(microtime() . Str::random(10)),
            'slug' => Str::slug('Lomba'),
            'publish' => true,
            'order' => 2,
        ]);
        Tags::create([
            'title' => 'Beasiswa',
            'token' => md5(microtime() . Str::random(10)),
            'slug' => Str::slug('Beasiswa'),
            'publish' => true,
            'order' => 3,
        ]);
    }
}
