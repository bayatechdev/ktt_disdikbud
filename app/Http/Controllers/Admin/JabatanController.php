<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Jabatan;

class JabatanController extends Controller
{
  public function index()
  {
    $ttl = Jabatan::where('publish', 1)->count();
    return view('pages.admin.pegawai-jabatan.index', [
      'ttl' => $ttl,
      'user_role' => Auth::user()->role,
    ]);
  }

  public function list()
  {
    $items = Jabatan::orderby('urutan')->get();
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
    Jabatan::updateOrCreate(['token' => $data['token']], $data);
    return response()->json(['status'  => 200]);
  }

  public function edit(Request $request)
  {
    $request = $request->all();
    $data = Jabatan::where('token', $request['token'])->first();

    if ($data) $response = 200;
    else $response = 201;

    return response()
      ->json([
        'data'  => $data,
      ], $response);
  }

  public function delete(Request $request)
  {
    $item = Jabatan::where('token', $request['token'])->first();
    Jabatan::destroy($item->id);
    return response()->json([
      'status' => 200,
    ]);
  }
}
