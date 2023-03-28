<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SigninController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only(['username', 'password']);
        $user = User::where([['username', $credentials['username']],['password', $credentials['password']]])->withTrashed()->first();
        if (!$user) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Wrong username or password'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'token' => $user->createToken('api')->plainTextToken
        ]);
    }
}