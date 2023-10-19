<?php

namespace App\Http\Controllers;

use App\Models\Kamus;
use App\Models\KamusBahasa;
use Illuminate\Http\Request;

class KamusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function translate(Request $request)
    {
        $data = $request->all();
        $sbahasa = "$data[slang]-$data[dlang]";
        $translate = [];

        if ($data['slang'] == $data['dlang'])
            return response()->json([
                'status'    => 'error',
                'message'   => "pilih 2 bahasa yang berbeda",
                'data'      => [
                    'bahasa'    => '',
                    'translate' =>  $translate
                ]
            ]);

        if (strlen($data['word']) < 2)
            return response()->json([
                'status'    => 'error',
                'message'   => "masukkan kata minimal 2 huruf",
                'data'      => [
                    'bahasa'    => '',
                    'translate' =>  $translate
                ]
            ]);

        $bahasa = KamusBahasa::where('alias', $sbahasa)->first();

        if (!$bahasa) {
            return response()->json([
                'status'    => 'error',
                'message'   => "Database <b>$sbahasa</b> tidak tersedia",
                'data'      => [
                    'bahasa'    => '',
                    'translate' =>  $translate
                ]
            ]);
        } else {
            $translate = Kamus::where('kamus_bahasa_id', $bahasa->id)
                ->where('word', 'like', "%{$data['word']}%")
                ->get();

            if ($translate->count()) {
                return response()->json(
                    [
                        'status'    => 'success',
                        'message'   => '',
                        'data'      => [
                            'bahasa'    => $bahasa->title,
                            'translate' =>  $translate
                        ]
                    ]
                );
            } else {
                return response()->json([
                    'status'    => 'success',
                    'message'   => "Kata \"$data[word]\" tidak ditemukan",
                    'data'      => [
                        'bahasa'    => $bahasa->title,
                        'translate' =>  $translate
                    ]
                ]);
            }
        }
    }
}
