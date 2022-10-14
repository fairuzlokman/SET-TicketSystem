<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        
        /**
         * Authenticate user
         */
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $data['email'])->first();

        if($user && Hash::check($data['password'], $user->password)) {
            // Generate token
            $token = $user->createToken('API Token')->plainTextToken;

            // Return token to user
            return \response()->json([
                'message' => 'Successfully logged in',
                'data' => [
                    'token' => $token,
                    'user' => new UserResource($user)
                ]
            ]);

        } \abort(404, 'User not registered');

        return \response()->json([
            'message' => 'User not registered'
        ], 404);
    }

    public function logout() {
        // Delete tokens from DB
        Auth::user()->tokens->first()->delete();

        return 'Successfully logged out';
    }
}
