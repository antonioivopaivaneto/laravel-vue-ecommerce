<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
            'remember' => 'boolean',
        ]);

        $remember = $credentials['remember'] ?? false;
        unset($credentials['remember']);
        if(!Auth::attempt($credentials, $remember)){
            return response([
                'message' => 'Authentication failed'
            ],422);
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        if(!$user->is_admin){
                Auth::logout();

                return response([
                    'message' => 'You dont have permission to auth as admin'
                ],403);
        }

        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => new UserResource($user),
            'token' => $token
        ]);
}

    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response('',204);
    }

    public function getUser(Request $request) {
        return new UserResource($request->user());
    }

}
