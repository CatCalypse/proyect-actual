<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller{
    public function login(Request $request) {
        $incomingFields = $request->validate([
            'user' => ['required', 'exists:usuarios,usuario'],
            'password' => ['required']
        ]);


        if (Auth::attempt([
            'usuario' => $request->input('user'),
            'password' => $request->input('password')
            ])) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }

        return redirect('/login');
    }

    public function logout(Request $request) {
        if(Auth::check()){
            Auth::logout();
 
            $request->session()->invalidate();
 
            $request->session()->regenerateToken();
 
            return redirect('/');
        }

        return redirect('/');
    }

}