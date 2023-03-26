<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index', ['users' => User::withTrashed()->get()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.detail', ['user' => $user]);
    }
}