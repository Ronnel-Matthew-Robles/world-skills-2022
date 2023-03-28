<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('admin.login');
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        if (Auth::attempt($credentials)) {
            $adminUser = Admin::find(Auth::user()->id);
            $adminUser->last_login_at = now();
            $adminUser->save();

            return redirect('/');
        }

        return redirect('/admin')->withErrors(['login' => 'Invalid credentials']);
    }

     /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        redirect('/admin');
    }
}