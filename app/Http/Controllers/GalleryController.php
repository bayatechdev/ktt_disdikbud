<?php

namespace App\Http\Controllers;

use App\Models\Berita;
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
        $items = GalleryFoto::where('publish', 1)->get();

        // dd($items);
        return view('pages.gallery-foto', [
            'items'  => $items
        ]);
    }

    public function video()
    {
        $items = GalleryVideo::where('publish', 1)->get();

        dd($items);
        return view('pages.gallery-foto', [
            'items'  => $items
        ]);
    }
}
