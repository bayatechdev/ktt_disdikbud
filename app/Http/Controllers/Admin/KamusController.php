<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Kamus;
use App\Models\KamusBahasa;

class KamusController extends Controller
{
  public function index($bahasa)
  {
    if ($bahasa == 'tidung') {
      $ttl1 = Kamus::where('kamus_bahasa_id', 1)->count();
      $ttl2 = Kamus::where('kamus_bahasa_id', 2)->count();
      $bahasa1 = 'Indonesia';
      $bahasa2 = 'Tidung';
      $bhs1 = 'IND-TDG';
      $bhs2 = 'TDG-IND';
    } else if ($bahasa == 'belusu') {
      $ttl1 = Kamus::where('kamus_bahasa_id', 3)->count();
      $ttl2 = Kamus::where('kamus_bahasa_id', 4)->count();
      $bahasa1 = 'Indonesia';
      $bahasa2 = 'Belusu';
      $bhs1 = 'IND-BLS';
      $bhs2 = 'BLS-IND';
    }

    return view('pages.admin.kamus.index', [
      'ttl1' => $ttl1,
      'ttl2' => $ttl2,
      'bahasa1' => $bahasa1,
      'bahasa2' => $bahasa2,
      'bhs1' => $bhs1,
      'bhs2' => $bhs2,

    ]);
  }

  public function kamus_page($bhs_id)
  {
    $kamus_bahasa = KamusBahasa::where('alias', $bhs_id)->firstOrFail();
    return view('pages.admin.kamus.kamus_bahasa', [
      'bhs_id' => $kamus_bahasa->id,
      'kamus_bahasa' => $kamus_bahasa,
      'bahasa' => config('global.bahasa')[$kamus_bahasa->id]['title'],
    ]);
  }

  public function kamus_list($bhs_id)
  {
    $items = Kamus::where('kamus_bahasa_id', $bhs_id)->orderBy('word')->get();
    return response()->json(['data' => $items]);
  }

  public function kamus_store(Request $request)
  {
    $data = $request->all();
    // dd($data);
    Kamus::create($data);
    return response()->json(['status'  => 200]);
  }

  public function kamus_update(Request $request)
  {
    $data = $request->all();
    $item = Kamus::find($request->id);
    $item->update($data);
    return response()->json(['status'  => 200]);
  }

  public function kamus_edit($id)
  {
    $data = Kamus::where('id', $id)->firstOrFail();
    return response()->json([
      'data'  => $data
    ]);
  }

  public function kamus_delete(Request $request)
  {
    Kamus::destroy($request->id);
    return response()->json([
      'status' => 200,
    ]);
  }

  public function cek_word($bhs_id, $word, $id)
  {
    if ($id == '-') {
      $data = Kamus::where('word', $word)->first();
      if ($data) {
        $status = 1;
      } else {
        $status = 0; // Jika id Tidak ada dan word belum digunakan ada buat baru
      }
    } else {
      $cek = Kamus::where('id', $id)->firstOrFail(); // Jika Token ada
      if ($cek) {
        // dd($cek);
        if ($cek->word == $word) {
          $status = 2; // Jika id ada dan word sebelumnya sama maka update
        } else {
          $data = Kamus::where('word', $word)->first();
          if ($data) {
            $status = 1;
          } else {
            $status = 2;
          }
        }
      }
    }
    return response()->json([
      'status'  => $status
    ]);
  }
}
