<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $kategori = kategori::paginate(5);
        $kategori = kategori::all();
        if ($kategori == null) {
            return response()->json([
                'msg' => 'data belum ada'
            ]);
        } else {
            return response()->json([
                'msg' => 'List Data Kategori',
                'data' => $kategori
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'dkr' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors());
        }

        $kategori = kategori::create($request->all());
        return response()->json([
            'status' => true,
            'msg' => 'data berhasil disimpan',
            'data' => $kategori
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $kategori = kategori::where('nama', $id)->get();
        $kategori  = kategori::find($id);
        if ($kategori != null) {
            return response()->json([
                'status' => true,
                'msg' => 'Detail Kategori',
                'data' => $kategori
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => 'Data Tidak Tersedia'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, kategori $kategori)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'dkr' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors());
        }
        $kategori->update($request->all());
        return response()->json([
            'status' => true,
            'msg' => 'data berhasil diubah',
            'data' => $kategori
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = kategori::find($id);
        if ($kategori == null) {
            return response()->json([
                'status' => false,
                'msg' => 'data tidak ditemukan'
            ], 404);
        } else {
            $kategori->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Data Berhasil Dihapus',
                'data' => $kategori
            ]);
        }
    }
}
