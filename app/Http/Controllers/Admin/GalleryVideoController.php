<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use App\Models\GalleryVideo;

class GalleryVideoController extends Controller
{
  public function index()
  {
    $ttl = GalleryVideo::count();
    return view('pages.admin.gallery-video.index', [
      'ttl' => $ttl,
      'user_role' => Auth::user()->role,
    ]);
  }

  public function list()
  {
    $items = GalleryVideo::orderBy('order')->get();
    return response()->json(['data' => $items]);
  }

  public function store(Request $request)
  {
    $data = $request->all();
    if ($request->token == null) {
      $data['token'] = md5(microtime() . Str::random(3));
    }
    if (!$request->title) {
      $data['title'] = '-';
      $data['slug'] = Str::random(5);
    } else {
      $data['slug'] = Str::slug($request->title) . '-' . Str::random(2);
    }
    if (!$request->order) {
      $cek = GalleryVideo::orderByDesc('order')->first();
      if ($cek) {
        $data['order'] = $cek->order + 1;
      } else {
        $data['order'] = 1;
      }
    }


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

      $img->save(public_path('storage/videos/images/') . $filename);
      $img->resize(150, null, function ($constraint) {
        $constraint->aspectRatio();
      });
      $img->save(public_path('storage/videos/images/') . $thumbnail);
      $data['image'] = $filename;

      $item = GalleryVideo::where('token', $data['token'])->first();
      if ($item) {
        File::delete(public_path('storage/videos/images/' . $item->image));
        File::delete(public_path('storage/videos/images/thumb_' . $item->image));
      }
    }
    // dd($data);
    GalleryVideo::updateOrCreate(['token' => $data['token']], $data);
    return response()->json(['status'  => 200]);
  }

  public function edit($token)
  {
    $data = GalleryVideo::where('token', $token)->select(['title', 'token', 'slug', 'link', 'publish', 'order'])->firstOrFail();
    return response()->json([
      'data'  => $data
    ]);
  }

  public function delete(Request $request)
  {
    $item = GalleryVideo::where('token', $request->token)->first();
    GalleryVideo::destroy($item->id);
    File::delete(public_path('storage/videos/images/' . $item->image));
    File::delete(public_path('storage/videos/images/thumb_' . $item->image));

    return response()->json([
      'status' => 200,
    ]);
  }
}
