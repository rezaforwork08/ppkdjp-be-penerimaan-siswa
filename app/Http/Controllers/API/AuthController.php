<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function actionLogin(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            $credentials = $request->only('email', 'password');
            if (!$token = Auth::guard('api')->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            return response()->json(['access_token' => $token, 'token_type' => 'bearer']);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function me()
    {
        return response()->json(Auth::guard('api')->user());
    }
}
