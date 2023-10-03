<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Golongan;

class GolonganController extends Controller
{
  public function index()
  {
    $ttl = Golongan::where('publish', 1)->count();
    return view('pages.admin.pegawai-golongan.index', [
      'ttl' => $ttl,
    ]);
  }

  public function list()
  {
    $items = Golongan::orderby('urutan')->get();
    return response()->json(['data' => $items]);
  }
}
