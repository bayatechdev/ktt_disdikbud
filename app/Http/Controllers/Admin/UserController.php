<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserPasswordRequest;
use App\Models\User;
use App\Models\Pegawai;

class UserController extends Controller
{
  public function index()
  {
    $ttl = User::count();
    return view('pages.admin.user.index', [
      'ttl' => $ttl,
    ]);
  }

  public function list()
  {
    $items = User::orderby('name')->get();
    foreach ($items as $item) {
      $item->role = config('global.user_role')[$item->role];
    }
    return response()->json(['data' => $items]);
  }

  public function store(Request $request)
  {
    $data = $request->all();
    if ($data['token'] == null) {
      $data['token'] = md5(microtime() . Str::random(10));
    }

    if ($data['password']) {
      $data['password'] = bcrypt($data['password']);
    } else {
      $user = User::where('token', $data['token'])->first();
      $data['password'] = $user->password;
    }

    // dd($data);
    User::updateOrCreate(['token' => $data['token']], $data);
    return response()->json(['status'  => 200]);
  }

  public function edit(Request $request)
  {
    $request = $request->all();
    $data = User::where('token', $request['token'])->first();

    if ($data) $response = 200;
    else $response = 201;

    return response()
      ->json([
        'data'  => $data,
      ], $response);
  }

  public function delete(Request $request)
  {
    $item = User::where('token', $request['token'])->first();
    User::destroy($item->id);
    return response()->json([
      'status' => 200,
    ]);
  }

  // USER ACCOUNT DETAIL
  public function detail()
  {
    return view('pages.admin.user.detail', [
      'user' => Auth::User(),
    ]);
  }

  public function update_password(UserPasswordRequest $request)
  {
    $data = $request->all();
    $data['password'] = bcrypt($data['password']);
    $item = User::where('token', $data['token'])->first();
    // dd($data);
    $item->update($data);
    Auth::guard('web')->logout();
    return redirect()->back();
  }
}
