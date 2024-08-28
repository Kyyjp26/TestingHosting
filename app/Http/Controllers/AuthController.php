<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid login'
            ]);
        }

        $validated = $validator->safe()->only(['username', 'password']);
        if (!Auth::attempt($validated)) {
            return response()->json([
                'message' => 'invalid login'
            ]);
        }

        $user = Auth::user();
        $token = md5($user->username);
        $user->token = $token;
        $user->save();

        return response()->json([
            'message' => 'login success',
            'token' => $token,
            'role' => $user->role
        ], 200);

    }

    public function logout(Request $request){
        $token = $request->query('token');
        $user = User::where('token', $token)->first();

        if ($user) {
            $user->token = null;
            $user->save();

            Auth::logout();

            return response()->json([
                'message' => 'logout success'
            ], 200);
        }
    }
}
