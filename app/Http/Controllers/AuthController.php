<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class AuthController extends Controller
{
    
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^[0-9]{10}$/'
        ]);

        $user = User::where('phone', $request->input('phone'))->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid phone number');
        }

    return redirect()->route('verify');

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}

