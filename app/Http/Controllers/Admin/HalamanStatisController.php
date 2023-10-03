<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\BeritaKategori;
use App\Models\Bidang;
use App\Models\HalamanStatis;
use App\Models\Tags;
use App\Http\Requests\HalamanStatisRequest;

class HalamanStatisController extends Controller
{
  public function index()
  {
    $ttl = HalamanStatis::count();
    return view('pages.admin.halaman-statis.index', [
      'ttl' => $ttl,
      'user_role' => Auth::user()->role,
    ]);
  }

  public function create()
  {
    return view('pages.admin.halaman-statis.create');
  }

  public function edit($id)
  {
    $item = HalamanStatis::where('id', $id)->firstOrFail();
    return view('pages.admin.halaman-statis.edit', [
      'item' => $item,
    ]);
  }

  public function list()
  {
    $items = HalamanStatis::orderBy('order')->get();
    return response()->json(['data' => $items]);
  }

  public function store(HalamanStatisRequest $request)
  {
    $data = $request->all();
    $data['token'] = md5(microtime() . Str::random(10));
    $data['slug'] = Str::slug($request->title) . '-' . Str::random(2);
    if (!$request->order) {
      $cek = HalamanStatis::orderByDesc('order')->first();
      if ($cek) {
        $data['order'] = $cek->order + 1;
      } else {
        $data['order'] = 1;
      }
    }
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

      $img->save(public_path('storage/halaman-statis/images/') . $filename);
      $img->resize(150, null, function ($constraint) {
        $constraint->aspectRatio();
      });
      $img->save(public_path('storage/halaman-statis/images/') . $thumbnail);
      $data['image'] = $filename;
    }

    HalamanStatis::create($data);
    return redirect()->route('halaman_statis_index');
  }

  public function update(Request $request, $token)
  {
    $item = HalamanStatis::where('token', $token)->firstOrFail();
    if ($item) {
      $data = $request->all();
      $data['user_id'] = Auth::user()->id;
      if ($request->title <> $item->title) {
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(2);
      }
      $data['tags'] = json_encode($request->tags);
      $data['tanggal'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->tanggal)->format('Y-m-d');
      if (!$request->content) {
        unset($data['content']);
      }
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

        $img->save(public_path('storage/halaman-statis/images/') . $filename);
        $img->resize(150, null, function ($constraint) {
          $constraint->aspectRatio();
        });
        $img->save(public_path('storage/halaman-statis/images/') . $thumbnail);
        $data['image'] = $filename;

        File::delete(public_path('storage/halaman-statis/images/' . $item->image));
        File::delete(public_path('storage/halaman-statis/images/thumb_' . $item->image));
      }

      $item->update($data);
    }
    return redirect()->route('halaman_statis_index');
  }

  public function delete(Request $request)
  {
    $item = HalamanStatis::where('token', $request['token'])->first();
    // dd($item);
    HalamanStatis::destroy($item->id);
    File::delete(public_path('storage/halaman-statis/images/' . $item->image));
    File::delete(public_path('storage/halaman-statis/images/thumb_' . $item->image));
    return response()->json([
      'status' => 200,
    ]);
  }
}
