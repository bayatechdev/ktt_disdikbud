<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Kamus;

class KamusController extends Controller
{
  public function index()
  {
    $ind_bls = Kamus::where('kamus_bahasa_id', 3)->count();
    $bls_ind = Kamus::where('kamus_bahasa_id', 4)->count();
    return view('pages.admin.kamus.index_belusu', [
      'ind_bls' => $ind_bls,
      'bls_ind' => $bls_ind,
      'user_role' => Auth::user()->role,
    ]);
  }

  public function bls_ind_page()
  {
    return view('pages.admin.kamus.page_bls_ind', [
      'bhs_id' => 4,
    ]);
  }

  public function bls_ind_list()
  {
    $items = Kamus::where('kamus_bahasa_id', 4)->orderBy('word')->get();
    return response()->json(['data' => $items]);
  }

  public function bls_ind_store(Request $request)
  {
    $data = $request->all();
    $data['kamus_bahasa_id'] = 4;

    // dd($data);
    Kamus::create($data);
    return response()->json(['status'  => 200]);
  }

  public function bls_ind_update(Request $request)
  {
    $data = $request->all();
    $item = Kamus::find($request->id);
    dd($data);
    $item->update($data);
    return response()->json(['status'  => 200]);
  }

  public function bls_ind_edit($id)
  {
    $data = Kamus::where('id', $id)->firstOrFail();
    return response()->json([
      'data'  => $data
    ]);
  }

  public function bls_ind_delete(Request $request)
  {
    Kamus::destroy($request->id);
    return response()->json([
      'status' => 200,
    ]);
  }

  public function cek_word($bhs_id, $word)
  {
    $data = Kamus::where('kamus_bahasa_id', $bhs_id)->where('word', $word)->first();
    return response()->json([
      'data'  => $data
    ]);
  }
}
