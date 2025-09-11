<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('username',$request->username)->where('role','sales')->first();
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json([
                'message'=>'Invalid credentials'
            ],401);
        }

        $token = $user->createToken('sales_token')->plainTextToken;
        return response()->json([
            'user'=>$user,
            'token'=>$token
        ]);
    }
}
