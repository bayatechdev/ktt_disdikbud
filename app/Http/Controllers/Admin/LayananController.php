<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Category;
use App\Models\Layanan;
use App\Models\LayananJenis;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{

    public function index()
    {
        // dd(\File::size(public_path('storage/layanan/0024d3f56883a03f86d46e6524c784c9.png')));
        $ttl = LayananJenis::count();
        return view('pages.admin.layanan.index', [
            'ttl' => $ttl,
            'jns' =>  json_encode(config('global.jenis_berkas')),
        ]);
    }

    public function list()
    {
        $items = LayananJenis::orderByDesc('order')->get();
        return response()->json(['data' => $items]);
    }


    public function layanan_tab($id, $tab)
    {
        $item = LayananJenis::with(['layanans'])->orderByDesc('order')->find($id);
        // dd($item);
        return view('pages.admin.layanan.page-tab', [
            'item' => $item,
            'tab' => $tab,
        ]);
    }

    // public function create()
    // {
    //     $categories = Category::orderBy('id')->get();
    //     $tags = Tag::where('active', true)->orderBy('id')->get();

    //     return view('pages.admin.berita.create', [
    //         'title' => 'Berita',
    //         'subtitle' => 'Tambah Berita',
    //         'categories' => $categories,
    //         'tags' => $tags
    //     ]);
    // }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['token'] = md5(microtime() . Str::random(10));
        $layanan = Layanan::where('layananjenis_id', $data['layananjenis_id'])->where('layanan_tab_id', $data['layanan_tab_id'])->first();
        if ($layanan) {
            $data['order'] = $layanan->order + 1;
        } else {
            $data['order'] = 1;
        }

        // dd($data);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = md5(microtime() . Str::random(10));
            $filename = $name . '.' . $file->getClientOriginalExtension();
            $thumbnail = 'thumb_' . $name . '.' . $file->getClientOriginalExtension();

            $ekstensi = $file->getClientOriginalExtension();
            if ($ekstensi == 'jpg' || $ekstensi == 'jpeg' || $ekstensi == 'png') {
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

                $img->save(public_path('storage/layanan/') . $filename);
                $img->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path('storage/layanan/') . $thumbnail);
            } else {
                $request->file('file')->move(public_path('storage/layanan/'), $filename);
            }
            $data['file'] = $filename;
        }

        Layanan::create($data);
        return redirect()->route('layanan_index');
    }

    public function delete_file(Request $request)
    {
        $item = Layanan::where('token', $request->token)->firstOrFail();
        // dd($item);
        $item->delete();
        File::delete(public_path('storage/layanan/' . $item->file));
        File::delete(public_path('storage/layanan/thumb_' . $item->file));
        return response()->json([
            'status' => 200,
        ]);
        // return redirect()->back();
    }

    // public function show($id)
    // {
    //     //
    // }

    // public function edit($id)
    // {
    //     $item = Post::findOrFail($id);
    //     $categories = Category::orderBy('id')->get();
    //     $tags = Tag::where('active', true)->orderBy('id')->get();
    //     $item['tags'] = json_decode($item->tags);

    //     return view('pages.admin.berita.edit', [
    //         'title' => 'Berita',
    //         'subtitle' => 'Edit Berita',
    //         'categories' => $categories,
    //         'tags' => $tags,
    //         'item' => $item
    //     ]);
    // }

    // public function update(PostRequest $request, $id)
    // {
    //     $data = $request->all();
    //     $data['user_id'] = Auth::user()->id;
    //     $data['slug'] = Str::slug($request->title);
    //     $data['tags'] = json_encode($request->tags);
    //     $item = Post::findOrFail($id);

    //     if ($request->image) {
    //         File::delete(public_path('storage/') . $item->image);
    //         $file = $request->file('image');
    //         $filename = time() . '.' . $file->getClientOriginalExtension();
    //         $img = Image::make($file);

    //         if (Image::make($file)->width() > 1366) {
    //             $img->resize(1366, null, function ($constraint) {$constraint->aspectRatio();});
    //         }

    //         $img->save(public_path('storage/images/') . $filename);
    //         $data['image'] = ('assets/images/') . $filename;
    //     }


    //     $item->update($data);

    //     return redirect()->route('post.index');
    // }

    // public function destroy($id)
    // {
    //     $item = Post::findOrFail($id);
    //     $item->delete();
    //     File::delete(public_path('storage/' . $item->image));
    //     return redirect()->route('post.index');
    // }
}
