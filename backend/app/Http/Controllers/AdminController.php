<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index() {
        echo Hash::make('admin');
        return view('admin.login');
    }

    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)){
            $adminUser = Admin::find(Auth::user()->id);
            $adminUser->last_login_at = now();
            $adminUser->save();

            return redirect('/admin/user');
        }

        return redirect('/admin')->withErrors(['login' => 'Invalid credentials']);
    }

    public function logout() {
        Auth::logout();
        return redirect('/admin');
    }
}