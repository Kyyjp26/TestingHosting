<?php

namespace App\Http\Controllers;

use App\Http\Resources\PenjualanResource;
use App\Models\Penjualan;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::all();

        if ($penjualan->isEmpty()) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        return PenjualanResource::collection($penjualan);
    }

    public function show($id)
    {
        $penjualan = Penjualan::find($id);

        if (!$penjualan) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        return new PenjualanResource($penjualan);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'IDproduk' => 'required|exists:stoks,IDproduk',
            'qty' => 'required|integer',
            'dibayar' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data cannot be processed'
            ], 422);
        }

        $stok = Stok::find($request->IDproduk);
        $hargajual = $stok->hargajual;
        $total = $request->qty * $hargajual;
        $kembali = $request->dibayar - $total;

        Penjualan::create([
            'IDproduk' => $request->input('IDproduk'),
            'tanggal' => now(),
            'qty' => $request->input('qty'),
            'hargajual' => $hargajual,
            'total' => $total,
            'dibayar' => $request->input('dibayar'),
            'kembali' => $kembali
        ]);

        return response()->json([
            'message' => 'create success'
        ], 200);

    }

    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::find($id);

        if (!$penjualan) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'IDproduk' => 'required|exists:stoks,IDproduk',
            'qty' => 'required|integer',
            'dibayar' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data cannot be updated'
            ], 400);
        }

        $stok = Stok::find($request->IDproduk);
        $hargajual = $stok->hargajual;
        $total = $request->qty * $hargajual;
        $kembali = $request->dibayar - $total;

        $penjualan->update([
            'IDproduk' => $request->input('IDproduk'),
            'tanggal' => now(),
            'qty' => $request->input('qty'),
            'hargajual' => $hargajual,
            'total' => $total,
            'dibayar' => $request->input('dibayar'),
            'kembali' => $kembali
        ]);
        $penjualan->save();

        return response()->json([
            'message' => 'update success'
        ], 200);

    }

    public function destroy($id)
    {
        $penjualan = Penjualan::find($id);

        if (!$penjualan) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $penjualan->delete();

        return response()->json([
            'message' => 'delete success'
        ], 200);
    }

}
