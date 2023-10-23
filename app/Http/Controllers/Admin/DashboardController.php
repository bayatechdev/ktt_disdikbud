<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\CagarBudaya;
use App\Models\Kamus;

class DashboardController extends Controller
{
  public function index()
  {
    $ttl_berita = Berita::where('publish', 1)->count();
    $ttl_cagar = CagarBudaya::count();
    $ttl_tidung = Kamus::where('kamus_bahasa_id', 1)->orWhere('kamus_bahasa_id', 2)->count();
    $ttl_belusu = Kamus::where('kamus_bahasa_id', 3)->orWhere('kamus_bahasa_id', 4)->count();
    return view('pages.admin.dashboard', [
      'ttl_berita' => $ttl_berita,
      'ttl_cagar' => $ttl_cagar,
      'ttl_tidung' => $ttl_tidung,
      'ttl_belusu' => $ttl_belusu,
    ]);
  }
}
