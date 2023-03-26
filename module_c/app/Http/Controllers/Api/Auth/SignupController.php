<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SignupController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users|min:4|max:60',
            'password' => 'required|min:8|max:65536',
        ]);

       $credentials = $request->only('username', 'password');
        $user = new User();
        $user->username = $credentials['username'];
        $user->password = $credentials['password'];
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => $user->createToken('api')->plainTextToken,
        ]);
    }
}