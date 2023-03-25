<?php

namespace App\Http\Controllers\PlatformUser;

use App\Http\Controllers\Controller;
use App\Models\PlatformUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $platformUsers = PlatformUser::all();
        return view('admin.users.index', ['platformUsers' => $platformUsers]);
    }

    public function show($username) {
        $platformUser = PlatformUser::where('username', $username)->firstOrFail();
        return view('users.profile', ['platformUser' => $platformUser]);
    }

    public function block(Request $request, $username) {
        $platformUser = PlatformUser::where('username', $username)->firstOrFail();
        $platformUser->is_blocked = true;
        $platformUser->block_reason = $request->input('block_reason');
        $platformUser->save();
        return redirect()->back();
    }

    public function unblock(Request $request, $username)
    {
        $platformUser = PlatformUser::where('username', $username)->firstOrFail();
        $platformUser->is_blocked = false;
        $platformUser->block_reason = null;
        $platformUser->save();
        return redirect()->back();
    }
}