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
                'message' => 'You have successfully logged in.',
                'data' => [
                    'token' => $token,
                    'user' => new UserResource($user)
                ]
            ]);

        } else {
            return \response()->json([
                'message' => 'Incorrect password/email.'
            ], 404);
        }
        // \abort(404, 'Incorrect password/email.');

    }

    public function logout() {
        // Delete tokens from DB
        Auth::user()->tokens->first()->delete();

        return 'You have successfully logged out';
    }
}
