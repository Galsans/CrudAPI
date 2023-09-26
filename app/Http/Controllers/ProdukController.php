<?php

namespace App\Http\Controllers;

use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = produk::with('kategori')->get();
        return response()->json([
            'status' => true,
            'msg' => 'List Data Produk',
            'data' => $produk
        ]);
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
    public function store(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required|max:100',
            'dkr' => 'required|max:225',
            'harga' => 'required|integer|min:5',
            'kategori_id' => 'required|exists:kategoris,id'
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors());
        }

        $produk = produk::create($request->all());
        return response()->json([
            'status' => true,
            'msg' => 'Produk Berhasil Disimpan',
            'data' => $produk
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produk = produk::with('kategori')->get()->find($id);
        if ($produk == null) {
            return response()->json([
                'status' => false,
                'msg' => 'data tidak ditemukan'
            ], 404);
        } else {
            return response()->json([
                'status' => true,
                'msg' => 'List Detail Kategori',
                'data' => $produk
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, produk $produk)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required|max:100',
            'dkr' => 'required|max:225',
            'harga' => 'required|integer',
            'kategori_id' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors());
        }
        $produk->update($request->all());
        return response()->json([
            'status' => true,
            'msg' => 'Produk Berhasil Diubah',
            'data' => $produk
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produk = produk::find($id);
        if ($produk == null) {
            return response()->json([
                'status' => false,
                'msg' => 'data tidak ditemukan'
            ], 404);
        } else {
            $produk->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Data Berhasil Dihapus',
                'data' => $produk
            ]);
        }
    }
}
