<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class DesaController extends Controller
{
  public function index()
  {
    $ttl = Desa::count();
    return view('pages.admin.desa.index', [
      'ttl' => $ttl,
    ]);
  }

  public function list()
  {
    $items = Desa::with(['kecamatan'])->orderBy('kecamatan_id')->get();
    return response()->json(['data' => $items]);
  }
}
