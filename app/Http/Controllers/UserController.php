<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request) {
        $incomingFields = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'user' => ['required', 'unique:usuarios,usuario'],
            'password' => 'required',
            'mail' => 'required',
        ],
        ['user.unique' => 'El usuario introducido no está disponible']);

        DB::table('usuarios')->insert([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellido'),
            'correo' => $request->input('mail'),
            'rol' => 3,
            'usuario' => $request->input('user'),
            'password' => Hash::make($request->input('password')),
            'activo' => true,
        ]);

        return redirect('/');
    }

    public function create(Request $request) {
        $incomingFields = $request->validate([
            'user' => ['required', 'exists:usuarios,usuario'],
            'password' => 'required'
        ]);

        //facer a comprobacion dos datos coa bdd

        return redirect('/');
    }

}