<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\BeritaKategori;
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

    public function kategori($slug)
    {
        $kategori = BeritaKategori::where('slug', $slug)->firstOrFail();
        $items = Berita::with(['user'])->where('kategori_id', $kategori->id)->where('publish', 1)->paginate(10);

        return view('pages.berita-all', [
            'items'  => $items
        ]);
    }
}
