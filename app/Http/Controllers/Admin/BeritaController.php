<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\Berita;
use App\Models\BeritaKategori;
use App\Models\Bidang;
use App\Models\Tags;

class BeritaController extends Controller
{
  public function index()
  {
    $ttl = Berita::count();
    $ttl_1 = Berita::where('publish', true)->count();
    $ttl_0 = Berita::where('publish', false)->count();
    return view('pages.admin.berita.index', [
      'ttl' => $ttl,
      'ttl_1' => $ttl_1,
      'ttl_0' => $ttl_0,
      'user_role' => Auth::user()->role,
    ]);
  }

  public function create()
  {
    $kategoris = BeritaKategori::where('publish', true)->orderBy('order')->get();
    $bidangs = Bidang::where('publish', true)->orderBy('order')->get();
    $tags = Tags::where('publish', true)->orderBy('order')->get();

    return view('pages.admin.berita.create', [
      'kategoris' => $kategoris,
      'bidangs' => $bidangs,
      'tags' => $tags,
    ]);
  }

  public function edit($id)
  {
    $item = Berita::where('token', $id)->firstOrFail();
    $item['tags'] = json_decode($item->tags);
    // dd($item);
    $kategoris = BeritaKategori::where('publish', true)->orderBy('order')->get();
    $bidangs = Bidang::where('publish', true)->orderBy('order')->get();
    $tags = Tags::where('publish', true)->orderBy('order')->get();

    return view('pages.admin.berita.edit', [
      'item' => $item,
      'kategoris' => $kategoris,
      'bidangs' => $bidangs,
      'tags' => $tags,
    ]);
  }

  public function list()
  {
    $items = Berita::orderby('tanggal')->get();
    return response()->json(['data' => $items]);
  }

  public function store(Request $request)
  {
    $data = $request->all();
    $data['token'] = md5(microtime() . Str::random(10));
    $data['user_id'] = Auth::user()->id;
    $data['slug'] = Str::slug($request->title) . '-' . Str::random(2);
    $data['tags'] = json_encode($request->tags);
    $data['tanggal'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');
    // dd($data);

    if ($request->hasFile('image')) {
      $file = $request->file('image');
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

      $img->save(public_path('storage/berita/images/') . $filename);
      $img->resize(150, null, function ($constraint) {
        $constraint->aspectRatio();
      });
      $img->save(public_path('storage/berita/images/') . $thumbnail);
      $data['image'] = $filename;
    }

    Berita::create($data);
    return redirect()->route('berita_index');
  }

  public function update(Request $request, $token)
  {
    $item = Berita::where('token', $token)->firstOrFail();
    if ($item) {
      $data = $request->all();
      $data['user_id'] = Auth::user()->id;
      if ($request->title <> $item->title) {
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(2);
      }
      $data['tags'] = json_encode($request->tags);
      $data['tanggal'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');
      // dd($data);

      if ($request->hasFile('image')) {
        $file = $request->file('image');
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

        $img->save(public_path('storage/berita/images/') . $filename);
        $img->resize(150, null, function ($constraint) {
          $constraint->aspectRatio();
        });
        $img->save(public_path('storage/berita/images/') . $thumbnail);
        $data['image'] = $filename;

        File::delete(public_path('storage/berita/images/' . $item->image));
        File::delete(public_path('storage/berita/images/thumb_' . $item->image));
      }

      $item->update($data);
    }
    return redirect()->route('berita_index');
  }

  // public function edit(Request $request)
  // {
  //   $request = $request->all();
  //   $data = Bidang::where('token', $request['token'])->first();

  //   if ($data) $response = 200;
  //   else $response = 201;

  //   return response()
  //     ->json([
  //       'data'  => $data,
  //     ], $response);
  // }

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
