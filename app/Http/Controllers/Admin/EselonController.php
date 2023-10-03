<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Eselon;

class EselonController extends Controller
{
  public function index()
  {
    $ttl = Eselon::where('publish', 1)->count();
    return view('pages.admin.pegawai-eselon.index', [
      'ttl' => $ttl,
    ]);
  }

  public function list()
  {
    $items = Eselon::orderby('urutan')->get();
    return response()->json(['data' => $items]);
  }
}
