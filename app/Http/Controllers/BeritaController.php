<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function detail($slug)
    {
        $item = Berita::with(['user'])->where('slug', $slug)->first();

        return view('pages.berita-detail', [
            'item'  => $item
        ]);
    }
}
