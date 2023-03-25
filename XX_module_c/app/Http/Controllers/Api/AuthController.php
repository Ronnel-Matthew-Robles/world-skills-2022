<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlatformUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        // validate input
        $validated = $request->validate([
            'username' => 'required|unique:platform_users,username|min:4|max:60',
            'password' => 'required|min:8|max:65536',
        ]);

        // create user
        $user = new PlatformUser;
        $user->username = $validated['username'];
        $user->password = $validated['password'];
        $user->save();

        // generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        // return response
        return response()->json([
            'status' => 'success',
            'token' => $token,
        ], 201);
    }

    public function signin(Request $request)
    {
        // validate input
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $userBuilder = PlatformUser::where([['username', $validated['username']],['password', $validated['password']]]);
        // attempt login
        if ($userBuilder->exists()) {
            $user = $userBuilder->first();
            // generate token
            $token = $user->createToken('auth_token')->plainTextToken;

            // return response
            return response()->json([
                'status' => 'success',
                'token' => $token,
            ], 200);
        } else {
            // return response for failed login
            return response()->json([
                'status' => 'invalid',
                'message' => 'Wrong username or password',
            ], 401);
        }
    }

    public function signout(Request $request)
    {
        // revoke current user token
        $request->user()->currentAccessToken()->delete();

        // return response
        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully',
        ]);
    }
}