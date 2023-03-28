<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index', ['users'=>User::withTrashed()->get()]);
    }

    public function show(User $user) {
        return view('user.detail', ['user' => $user]);
    }
}