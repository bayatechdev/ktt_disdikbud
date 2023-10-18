<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\GalleryAlbum;
use App\Models\GalleryFoto;
use App\Models\GalleryVideo;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function berita()
    {
        $items = Berita::where('publish', 1)->get();
        // dd($items);
        return view('pages.gallery-berita', [
            'items'  => $items
        ]);
    }

    public function foto()
    {
        $albums = GalleryAlbum::where('publish', 1)->get();
        $items = GalleryFoto::with(['albums'])->whereRelation('albums', 'publish', 1)->where('publish', 1)->get();

        // dd($items);
        return view('pages.gallery-foto', [
            'albums'  => $albums,
            'items'  => $items,
        ]);
    }

    public function video()
    {
        $items = GalleryVideo::where('publish', 1)->get();

        return view('pages.gallery-video', [
            'items'  => $items
        ]);
    }
}
