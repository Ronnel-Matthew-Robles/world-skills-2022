<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminUser;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $user = AdminUser::where('username', $credentials['username'])->first();

        if (!$user || $user->password !== $credentials['password']) {
            return redirect('/admin')
                ->withInput($request->except('password'))
                ->withErrors(['credentials' => 'Invalid credentials']);
        }
        
        Auth::guard('admin')->login($user);

        return redirect('/admin/dashboard');
    }
}