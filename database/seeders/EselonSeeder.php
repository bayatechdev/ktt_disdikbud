<?php

namespace Database\Seeders;

use App\Models\Eselon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class EselonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eselon::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'I a',
            'slug' => Str::slug('I a'),
        ]);
        Eselon::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'I b',
            'slug' => Str::slug('I b'),
        ]);
        Eselon::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'II a',
            'slug' => Str::slug('II a'),
        ]);
        Eselon::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'II b',
            'slug' => Str::slug('II b'),
        ]);
        Eselon::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'III a',
            'slug' => Str::slug('III a'),
        ]);
        Eselon::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'III b',
            'slug' => Str::slug('III b'),
        ]);
        Eselon::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IV a',
            'slug' => Str::slug('IV a'),
        ]);
        Eselon::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'IV b',
            'slug' => Str::slug('IV b'),
        ]);
        Eselon::create([
            'token' => md5( microtime() . Str::random(10)),
            'title' => 'V a',
            'slug' => Str::slug('V a'),
        ]);
       
    }
}
