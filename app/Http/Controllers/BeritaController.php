<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\BeritaKategori;
use App\Models\Tags;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function detail($slug)
    {
        $item = Berita::with(['user'])->where('slug', $slug)->first();
        $tags_all = Tags::where('publish', 1)->get();

        return view('pages.berita-detail', [
            'item'  => $item,
            'tags_all'  => $tags_all,
        ]);
    }

    public function kategori($slug)
    {
        $kategori = BeritaKategori::where('slug', $slug)->firstOrFail();
        $items = Berita::with(['user'])->where('kategori_id', $kategori->id)->where('publish', 1)->paginate(10);

        return view('pages.berita-all', [
            'subtitle'  => "Kategori " . $kategori->title,
            'items'  => $items,
        ]);
    }

    public function tag($id)
    {
        $tag = Tags::where('id', $id)->first();
        $items = Berita::with(['user'])->where('tags', 'LIKE', '%"' . $tag->id . '"%')->where('publish', 1)->paginate(10);


        return view('pages.berita-all', [
            'subtitle'  => "Tag Berita: " . $tag->title,
            'items'  => $items
        ]);
    }
}
