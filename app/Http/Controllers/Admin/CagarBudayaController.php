<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Berita;
use App\Models\BeritaKategori;
use App\Models\Bidang;
use App\Models\CagarBudaya;
use App\Models\CagarBudayaGallery;
use App\Models\Desa;
use App\Models\Tags;

class CagarBudayaController extends Controller
{
  public function index()
  {
    $ttl = Berita::count();
    $ttl_1 = Berita::where('publish', true)->count();
    $ttl_0 = Berita::where('publish', false)->count();


    $desas = Desa::with('kecamatan')->get();
    $bidangs = Bidang::where('publish', true)->orderBy('order')->get();
    $tags = Tags::where('publish', true)->orderBy('order')->get();
    return view('pages.admin.cagar-budaya.index', [
      'ttl' => $ttl,
      'ttl_1' => $ttl_1,
      'ttl_0' => $ttl_0,
      'user_role' => Auth::user()->role,

      'desas' => $desas,
      'bidangs' => $bidangs,
      'tags' => $tags,

    ]);
  }

  public function create()
  {
    $desas = Desa::with('kecamatan')->get();
    $bidangs = Bidang::where('publish', true)->orderBy('order')->get();
    $tags = Tags::where('publish', true)->orderBy('order')->get();

    return view('pages.admin.cagar-budaya.create', [
      'desas' => $desas,
      'bidangs' => $bidangs,
      'tags' => $tags,
    ]);
  }

  public function list()
  {
    $items = CagarBudaya::with(['galleries', 'desa'])->orderByDesc('id')->get();
    return response()->json(['data' => $items]);
  }

  public function store(Request $request)
  {
    $data = $request->all();
    $data['slug'] = Str::slug($request->nama_objek) . '-' . Str::random(2);

    CagarBudaya::updateOrCreate(['id' => $data['id']], $data);
    // return redirect()->route('cagarbudaya_index');
    return response()->json(['status'  => 200]);
  }

  public function gallery_store(Request $request)
  {
    $data = $request->all();
    // dd($data);

    if ($request->hasFile('file')) {
      $file = $request->file('file');
      $name = md5(microtime() . Str::random(10));
      $filename = $name . '.' . $file->getClientOriginalExtension();
      $thumbnail = 'thumb_' . $name . '.' . $file->getClientOriginalExtension();
      $img = Image::make($file);

      if (Image::make($file)->width() < 1024) {
        $img->resize(800, null, function ($constraint) {
          $constraint->aspectRatio();
        });
      } else if (Image::make($file)->width() < 3024) {
        $img->resize(1000, null, function ($constraint) {
          $constraint->aspectRatio();
        });
      } else if (Image::make($file)->width() < 6024) {
        $img->resize(1300, null, function ($constraint) {
          $constraint->aspectRatio();
        });
      } else {
        $img->resize(1600, null, function ($constraint) {
          $constraint->aspectRatio();
        });
      }

      $img->save(public_path('storage/cagar-budaya/images/') . $filename);
      $img->resize(150, null, function ($constraint) {
        $constraint->aspectRatio();
      });
      $img->save(public_path('storage/cagar-budaya/images/') . $thumbnail);
      $data['file'] = $filename;
    }

    CagarBudayaGallery::updateOrCreate(['id' => $data['id']], $data);
    return redirect()->route('cagarbudaya_index');
    // return response()->json(['status'  => 200]);
  }

  public function edit($token)
  {
    $data = CagarBudaya::where('id', $token)->firstOrFail();
    return response()->json([
      'data'  => $data
    ]);
  }

  public function gallery_edit($token)
  {
    $data = CagarBudayaGallery::where('id', $token)->select(['id', 'cagar_budaya_id', 'title', 'deskripsi', 'order'])->firstOrFail();
    return response()->json([
      'data'  => $data
    ]);
  }

  public function galleries($id)
  {
    $datas = CagarBudayaGallery::where('cagar_budaya_id', $id)->orderBy('order')->get();
    return view('_partials._pages.page-cagarbudaya-galleries-upload', [
      'datas' => $datas,
    ]);
  }

  // public function delete(Request $request)
  // {
  //   $item = Bidang::where('token', $request['token'])->first();
  //   $cek = Pegawai::where('bidang_id', $item->id)->count();
  //   if ($cek) {
  //     $status = 201;
  //   } else {
  //     $status = 200;
  //     Bidang::destroy($item->id);
  //   }
  //   return response()->json([
  //     'status' => $status,
  //   ]);
  // }
}
