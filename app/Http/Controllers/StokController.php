<?php

namespace App\Http\Controllers;

use App\Http\Resources\StokResource;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StokController extends Controller
{
    public function index()
    {
        $stok = Stok::all();

        if ($stok->isEmpty()) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        return StokResource::collection($stok);
    }

    public function show($id)
    {
        $stok = Stok::find($id);

        if (!$stok) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        return new StokResource($stok);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'hargabeli' => 'required|integer',
            'hargajual' => 'required|integer',
            'stok' => 'required|integer',
            'kategori' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data cannot be processed'
            ], 422);
        }

        Stok::create([
            'nama' => $request->input('nama'),
            'hargabeli' => $request->input('hargabeli'),
            'hargajual' => $request->input('hargajual'),
            'stok' => $request->input('stok'),
            'kategori' => $request->input('kategori'),
        ]);

        return response()->json([
            'message' => 'create success'
        ], 200);

    }

    public function update(Request $request, $id)
    {
        $stok = Stok::find($id);

        if (!$stok) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'hargabeli' => 'required|integer',
            'hargajual' => 'required|integer',
            'stok' => 'required|integer',
            'kategori' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data cannot be updated'
            ], 400);
        }

        $stok->update([
            'nama' => $request->input('nama'),
            'hargabeli' => $request->input('hargabeli'),
            'hargajual' => $request->input('hargajual'),
            'stok' => $request->input('stok'),
            'kategori' => $request->input('kategori'),
        ]);
        $stok->save();

        return response()->json([
            'message' => 'update success'
        ], 200);
    }

    public function destroy($id)
    {
        $stok = Stok::find($id);

        if (!$stok) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $stok->delete();

        return response()->json([
            'message' => 'delete success'
        ], 200);
    }
}
