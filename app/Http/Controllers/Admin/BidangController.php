<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Bidang;
use App\Models\Pegawai;

class BidangController extends Controller
{
  public function index()
  {
    $ttl = Bidang::where('publish', 1)->count();
    return view('pages.admin.berita.index', [
      'ttl' => $ttl,
      'user_role' => Auth::user()->role,
    ]);
  }

  public function list()
  {
    $items = Bidang::orderby('urutan')->get();
    return response()->json(['data' => $items]);
  }

  public function store(Request $request)
  {
    $data = $request->all();
    if ($data['token'] == null) {
      $data['token'] = md5(microtime() . Str::random(10));
    }
    $data['slug'] = Str::slug($data['title']);

    // dd($data);
    Bidang::updateOrCreate(['token' => $data['token']], $data);
    return response()->json(['status'  => 200]);
  }

  public function edit(Request $request)
  {
    $request = $request->all();
    $data = Bidang::where('token', $request['token'])->first();

    if ($data) $response = 200;
    else $response = 201;

    return response()
      ->json([
        'data'  => $data,
      ], $response);
  }

  public function delete(Request $request)
  {
    $item = Bidang::where('token', $request['token'])->first();
    $cek = Pegawai::where('bidang_id', $item->id)->count();
    if ($cek) {
      $status = 201;
    } else {
      $status = 200;
      Bidang::destroy($item->id);
    }
    return response()->json([
      'status' => $status,
    ]);
  }
}
