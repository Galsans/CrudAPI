<?php

namespace App\Http\Controllers;

use App\Models\rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rating = rating::all();
        return response()->json([
            'status' => true,
            'msg' => 'Data List Rating',
            'data' => $rating
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
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'star' => 'required|max:5',
            'produk_id' => 'required|exists:produks,id'
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors());
        }
        $rating = rating::create($request->all());
        return response()->json([
            'status' => true,
            'msg' => 'Data Berhasil Disimpan',
            'data' => $rating
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rating = rating::find($id);
        if ($rating == null) {
            return response()->json([
                'status' => false,
                'msg' => 'Data Tidak Ada'
            ], 404);
        } else {
            return response()->json([
                'status' => true,
                'msg' => 'List Detail Rating',
                'data' => $rating
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rating $rating)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rating $rating)
    {
        $validate = Validator::make($request->all(), [
            'star' => 'required|max:5',
            'produk_id' => 'required|exists:produks,id'
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors());
        }
        $rating->update($request->all());
        return response()->json([
            'status' => true,
            'msg' => 'Data Berhasil DiUbah',
            'data' => $rating
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rating = rating::find($id);
        if ($rating == null) {
            return response()->json([
                'status' => false,
                'msg' => 'Data Tidak Ditemukan'
            ]);
        } else {
            $rating->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Data Berhasil Dihapus',
                'data' => $rating
            ]);
        }
    }
}
