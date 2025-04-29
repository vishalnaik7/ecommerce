<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid Credentials',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();  
        $request->session()->invalidate();
        $request->session()->regenerateToken(); 
        return redirect()->route('admin.login')->with('success', 'Logged out successfully.');
    }
}
