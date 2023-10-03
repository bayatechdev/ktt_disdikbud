<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\Bidang;
use App\Models\Eselon;
use App\Models\Golongan;
use App\Models\User;
// use App\Http\Controllers\Route;

class PegawaiController extends Controller
{
  public function index()
  {
    $ttl = Pegawai::count();
    $jabatans = Jabatan::where('publish', 1)->orderBy('urutan')->get();
    $bidangs = Bidang::where('publish', 1)->orderBy('order')->get();
    $eselons = Eselon::where('publish', 1)->orderBy('urutan')->get();
    $golongans = Golongan::where('publish', 1)->orderBy('urutan')->get();
    return view('pages.admin.pegawai.index', [
      'ttl' => $ttl,
      'jabatans' => $jabatans,
      'bidangs' => $bidangs,
      'eselons' => $eselons,
      'golongans' => $golongans,
      'user_role' => Auth::user()->role,
    ]);
  }

  public function list()
  {
    $items = Pegawai::with(['jabatan', 'bidang', 'eselon', 'golongan'])->orderby('nama')->get();
    return response()->json(['data' => $items]);
  }

  public function store(Request $request)
  {
    $data = $request->all();
    if ($data['token'] == null) {
      $data['token'] = md5(microtime() . Str::random(10));
    }
    if ($request->lahir_tanggal) {
      $data['lahir_tanggal'] = \Carbon\Carbon::createFromFormat('d/m/Y', $request->lahir_tanggal)->format('Y-m-d');
    }

    if (!$request->urutan) {
      $cek = Pegawai::orderByDesc('urutan')->first();
      if ($cek) {
        $data['urutan'] = $cek->urutan + 1;
      } else {
        $data['urutan'] = 1;
      }
    }


    // dd($data);
    if ($request->hasFile('gambar')) {
      $file = $request->file('gambar');
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

      $img->save(public_path('storage/pegawai/images/') . $filename);
      $img->resize(150, null, function ($constraint) {
        $constraint->aspectRatio();
      });
      $img->save(public_path('storage/pegawai/images/') . $thumbnail);
      $data['gambar'] = $filename;

      // Hapus gambar sebelumnya
      if ($request->token) {
        $item = Pegawai::where('token', $request->token)->first();
        File::delete(public_path('storage/pegawai/images/' . $item->gambar));
        File::delete(public_path('storage/pegawai/images/thumb_' . $item->gambar));
      }
    }

    // dd($data);
    Pegawai::updateOrCreate(['token' => $data['token']], $data);
    return response()->json(['status'  => 200]);
  }

  public function edit(Request $request)
  {
    $request = $request->all();
    $data = Pegawai::where('token', $request['token'])
      ->select(['token', 'bidang_id', 'jabatan_id', 'golongan_id', 'eselon_id', 'nip', 'nama', 'jkel', 'lahir_tempat', 'lahir_tanggal', 'alamat', 'notelp', 'agama', 'publish', 'urutan'])
      ->first();

    if ($data) $response = 200;
    else $response = 201;

    return response()
      ->json([
        'data'  => $data,
      ], $response);
  }

  public function detail($token)
  {
    $item = Pegawai::where('token', $token)->first();
    $user = User::where('pegawai_id', $item->id)->first();
    // dd($item);
    return view('pages.admin.pegawai.detail', [
      'item' => $item,
      'user' => $user,
    ]);
  }

  public function delete(Request $request)
  {
    $item = Pegawai::where('token', $request['token'])->first();
    Pegawai::destroy($item->id);
    File::delete(public_path('storage/pegawai/images/' . $item->gambar));
    File::delete(public_path('storage/pegawai/images/thumb_' . $item->gambar));
    return response()->json([
      'status' => 200,
    ]);
  }
}
