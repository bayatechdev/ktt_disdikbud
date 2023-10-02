<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;

class KecamatanController extends Controller
{
  public function index()
  {
    $ttl = Kecamatan::count();
    return view('pages.admin.kecamatan.index', [
      'ttl' => $ttl,
    ]);
  }

  public function list()
  {
    $items = Kecamatan::orderBy('urut')->get();
    return response()->json(['data' => $items]);
  }
}
