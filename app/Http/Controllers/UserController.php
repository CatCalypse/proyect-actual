<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\userTraits; 

class UserController extends Controller
{
    /*
        Añadir funciones compartidas
    */
    use userTraits; 


    public function register(Request $request) {
        $incomingFields = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'user' => ['required', 'unique:usuarios,usuario'],
            'password' => 'required',
            'mail' => ['required', 'unique:usuarios,correo'],
        ],
        ['user.unique' => 'El usuario introducido no está disponible']);

        if($request ->has('remember')){
            $recordar = true;
        }else{
            $recordar = false;
        }

        DB::table('usuarios')->insert([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellido'),
            'correo' => $request->input('mail'),
            'rol' => 3,
            'usuario' => $request->input('user'),
            'password' => Hash::make($request->input('password')),
            'activo' => true,
        ]);

        if (Auth::attempt([
            'usuario' => $request->input('user'),
            'password' => $request->input('password')
        ], $recordar)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }

        return redirect('/');
    }


    public function create(Request $request) {
        $validator = Validator::make($request->all(),[
            'nombre' => 'required',
            'apellido' => 'required',
            'user' => ['required', 'unique:usuarios,usuario'],
            'password' => 'required',
            'mail' => ['required', 'unique:usuarios,correo'],
            'rol' => 'required'
        ],
        ['user.unique' => 'El usuario introducido no está disponible',
        'mail.unique' => 'Ya existe una cuenta enlazada a este correo'])->validateWithBag('create');

        if($request ->has('activo')){
            $activo = 1;
        }else{
            $activo = 0;
        }

        DB::table('usuarios')->insert([
            'nombre' => $request->input('nombre'),
            'apellidos' => $request->input('apellido'),
            'correo' => $request->input('mail'),
            'rol' => $request->input('rol'),
            'usuario' => $request->input('user'),
            'password' => Hash::make($request->input('password')),
            'activo' =>  $activo,
        ]);

        return redirect ('/admin/usuarios')->withErrors(['message'=> 'Usuario creado correctamente'], 'status');
    }


    public function edit(Request $request){
        $validator = Validator::make($request->all(),[
            'nombre' => 'required',
            'apellido' => 'required',
            'user' => ['required'],
            'mail' => ['required'],
            'rol' => 'required',
            'id' => 'required'
        ],
        ['user.unique' => 'El usuario introducido no está disponible',
        'mail.unique' => 'Ya existe una cuenta enlazada a este correo'])->validateWithBag('edit');

        if($request->has('activo')){
            $activo = 1;
        }else{
            $activo = 0;
        }


        if(!$this->isLastAdmin($request->input('id'))){
            if($request->has('password')){
                $affected = DB::table('usuarios')
                ->where('id', $request->input('id'))
                ->update(['nombre' => $request->input('nombre'),
                'apellidos' => $request->input('apellido'),
                'usuario' => $request->input('user'),
                'password' => Hash::make($request->input('password')),
                'rol' => $request->input('rol'),
                'correo' => $request->input('mail'),
                'activo' => $activo]);
    
            }else{
                $affected = DB::table('usuarios')
                ->where('id', $request->input('id'))
                ->update(['nombre' => $request->input('nombre'),
                'apellidos' => $request->input('apellido'),
                'usuario' => $request->input('user'),
                'rol' => $request->input('rol'),
                'correo' => $request->input('mail'),
                'activo' => $activo]);
            }
        }else{
            return redirect ('/admin/usuarios')->withErrors(['message'=> 'No se puede editar al útlimo administrador activo'], 'status');
        }


        return redirect ('/admin/usuarios')->withErrors(['message'=> 'Usuario editado correctamente'], 'status');
    }

    public function delete(Request $request){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if(DB::table('usuarios')->where('id', $id)->exists()){
                if(!$this->isLastAdmin($id)){
                    $deleted = DB::table('usuarios')->where('id', $id)->delete();
                    return redirect ('/admin/usuarios')->withErrors(['message'=> 'Usuario editado correctamente'], 'status');
                }else{
                    return redirect ('/admin/usuarios')->withErrors(['message'=> 'No se puede eliminar al útlimo administrador activo'], 'status');
                }

            }else{
                return redirect ('/admin/usuarios')->withErrors(['message'=> 'Error al eliminar al usuario'], 'status');
            }

        }else{
            return redirect ('/admin/usuarios')->withErrors(['message'=> 'Error al eliminar al usuario'], 'status');
        }
    }

}