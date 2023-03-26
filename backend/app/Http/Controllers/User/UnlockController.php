<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UnlockController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user, Request $request)
    {
        $user->restore();
        $user->delete_reason = null;
        $user->save();
        
        return redirect()->back();
    }
}