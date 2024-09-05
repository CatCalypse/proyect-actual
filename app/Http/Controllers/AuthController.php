<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller{
    public function login(Request $request) {
        $incomingFields = $request->validate([
            'user' => ['required', 'exists:usuarios,usuario'],
            'password' => ['required']
        ],['user.exists' => 'El usuario no existe']);

        if($request ->has('remember')){
            $recordar = true;
        }else{
            $recordar = false;
        }

        $usuario = DB::table('usuarios')->where('usuario', $request->input('user'))->first();

        if (Auth::attempt([
            'usuario' => $request->input('user'),
            'password' => $request->input('password')
        ], $recordar)) {
            $request->session()->regenerate();

        }else{
            return back()->withErrors(['errors' => 'El usuario o la contraseña son incorrectos'])->withInput();
        }

        if($usuario->activo == 1){
            return redirect('/');
        }else{
            if(Auth::check()){
                Auth::logout();
     
                $request->session()->invalidate();
     
                $request->session()->regenerateToken();
            }

            return back()->withErrors(['errors' => 'El usuario no está activo'])->withInput();
        }
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