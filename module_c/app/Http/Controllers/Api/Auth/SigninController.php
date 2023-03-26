<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SigninController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

       $credentials = $request->only('username', 'password');
        $user = User::where([['username', $credentials['username']],['password', $credentials['password']]]);
        if (!$user) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Wrong username or password'
            ]);
        }

        if ($user->trashed()) {
            return response()->json([
                'status' => 'blocked',
                'message' => 'User blocked',
                'reason' => User::$DELETE_REASONS[$user->delete_reason] ?? null,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => $user->createToken('api')->plainTextToken,
        ]);
    }
}