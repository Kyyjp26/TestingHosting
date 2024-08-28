<?php

namespace App\Http\Controllers;

use App\Http\Resources\PendapatanTenantResource;
use App\Models\PendapatanTenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PendapatanTenantController extends Controller
{
    public function index()
    {
        $pendapatanTenant = PendapatanTenant::all();

        if ($pendapatanTenant->isEmpty()) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        return PendapatanTenantResource::collection($pendapatanTenant);
    }

    public function show($id)
    {
        $pendapatanTenant = PendapatanTenant::find($id);

        if (!$pendapatanTenant) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        return new PendapatanTenantResource($pendapatanTenant);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'IDtenant' => 'required|exists:tenants,IDtenant',
            'totalPendapatan' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data cannot be processed'
            ], 422);
        }

        $setoranTenant = $request->totalPendapatan * (15 / 100);

        PendapatanTenant::create([
            'tanggal' => now(),
            'IDtenant' => $request->input('IDtenant'),
            'totalPendapatan' => $request->input('totalPendapatan'),
            'setoranTenant' => $setoranTenant
        ]);

        return response()->json([
            'message' => 'create success'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $pendapatanTenant = PendapatanTenant::find($id);

        if (!$pendapatanTenant) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'IDtenant' => 'required|exists:tenants,IDtenant',
            'totalPendapatan' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data cannot be updated'
            ], 400);
        }

        $setoranTenant = $request->totalPendapatan * (15 / 100);

        $pendapatanTenant->update([
            'tanggal' => now(),
            'IDtenant' => $request->input('IDtenant'),
            'totalPendapatan' => $request->input('totalPendapatan'),
            'setoranTenant' => $setoranTenant
        ]);

        return response()->json([
            'message' => 'update success'
        ], 200);
    }

    public function destroy($id)
    {
        $pendapatanTenant = PendapatanTenant::find($id);

        if (!$pendapatanTenant) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $pendapatanTenant->delete();

        return response()->json([
            'message' => 'delete success'
        ]);
    }
}
