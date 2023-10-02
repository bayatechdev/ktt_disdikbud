<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Tags;

class TagController extends Controller
{
  public function index()
  {
    $ttl = Tags::count();
    return view('pages.admin.tag.index', [
      'ttl' => $ttl,
      'user_role' => Auth::user()->role,
    ]);
  }

  public function list()
  {
    $items = Tags::orderBy('order')->get();
    return response()->json(['data' => $items]);
  }

  public function store(Request $request)
  {
    $data = $request->all();
    if ($request->token == null) {
      $data['token'] = md5(microtime() . Str::random(3));
    }
    $data['slug'] = Str::slug($request->title) . '-' . Str::random(2);
    if (!$request->order) {
      $cek = Tags::orderByDesc('order')->first();
      if ($cek) {
        $data['order'] = $cek->order + 1;
      } else {
        $data['order'] = 1;
      }
    }

    // dd($data);
    Tags::updateOrCreate(['token' => $data['token']], $data);
    return response()->json(['status'  => 200]);
  }

  public function edit($token)
  {
    $data = Tags::where('token', $token)->select(['title', 'token', 'slug', 'publish', 'order'])->firstOrFail();
    return response()->json([
      'data'  => $data
    ]);
  }

  public function delete(Request $request)
  {
    $item = Tags::where('token', $request->token)->first();
    if ($item) {
      $cek = Berita::where('tags', 'LIKE', '%"' . $item->id . '"%')->first();
      if ($cek) {
        dd("Data Masih Digunakan!!!");
      } else {
        Tags::destroy($item->id);
      }
    }
    return response()->json([
      'status' => 200,
    ]);
  }
}
