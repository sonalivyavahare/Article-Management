<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class AuthController extends Controller
{
    /**
     * Do login and get token
     */
    public function login(Request $request) {
        
        $user = User::where('email', $request->email )->first();
        if(! $user || !Hash::check($request->password, $user->password)) {
            return response(['message' => 'Not a valid user']);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response);
    }
}
