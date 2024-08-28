<?php

namespace App\Http\Controllers;

use App\Http\Resources\TenantResource;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TenantController extends Controller
{
    public function index()
    {
        $tenant = Tenant::all();

        if ($tenant->isEmpty()) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        return TenantResource::collection($tenant);
    }

    public function show($id)
    {
        $tenant = Tenant::find($id);

        if (!$tenant) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        return new TenantResource($tenant);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'namatenant' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data cannot be processed'
            ], 422);
        }

        Tenant::create([
            'namatenant' => $request->input('namatenant'),
            'detail' => $request->input('detail')
        ]);

        return response()->json([
            'message' => 'create success'
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $tenant = Tenant::find($id);

        if (!$tenant) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'namatenant' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data cannot be updated'
            ], 400);
        }

        $tenant->update([
            'namatenant' => $request->input('namatenant'),
            'detail' => $request->input('detail')
        ]);
        $tenant->save();

        return response()->json([
            'message' => 'update success'
            ], 200);
    }

    public function destroy($id)
    {
        $tenant = Tenant::find($id);

        if (!$tenant) {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }

        $tenant->delete();

        return response()->json([
            'message' => 'delete success'
        ], 200);

    }
}
