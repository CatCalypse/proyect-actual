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

        return redirect('/register')->withError(['errors' => 'Se ha producido un error en el registro']);
    }


    public function create(Request $request) {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'user' => ['required', 'unique:usuarios,usuario'],
            'password' => 'required',
            'mail' => ['required', 'unique:usuarios,correo'],
            'rol' => 'required'
        ],
        ['user.unique' => 'El usuario introducido no está disponible',
        'mail.unique' => 'Ya existe una cuenta enlazada a este correo']);

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

        return redirect ('/admin/usuarios/create')->with(['message'=> 'Usuario creado correctamente']);
    }


    public function edit(Request $request){
        $validator = Validator::make($request->all(),[
            'nombre' => 'required',
            'apellido' => 'required',
            'user' => ['required'],
            'mail' => ['required'],
            'rol' => 'required',
            'id' => 'required'
        ])->validateWithBag('errors');

        if($request->has('activo') && $request->activo){
            $activo = 1;
        }else{
            $activo = 0;
        }

        $id = $request->input('id');

        if(!$this->isLastAdmin($id)){
            if($request->has('password') && ($request->input('password') != "")){
                $affected = DB::table('usuarios')
                ->where('id', $id)
                ->update(['nombre' => $request->input('nombre'),
                'apellidos' => $request->input('apellido'),
                'usuario' => $request->input('user'),
                // 'password' => $request->input('password'),
                'password' => Hash::make($request->input('password')),
                'rol' => $request->input('rol'),
                'correo' => $request->input('mail'),
                'activo' => $activo]);
    
            }else{
                $affected = DB::table('usuarios')
                ->where('id', $id)
                ->update(['nombre' => $request->input('nombre'),
                'apellidos' => $request->input('apellido'),
                'usuario' => $request->input('user'),
                'rol' => $request->input('rol'),
                'correo' => $request->input('mail'),
                'activo' => $activo]);
            }
        }else{
            return redirect ("/admin/usuarios/edit?id=$id")->withErrors(['error'=> 'No se puede editar al útlimo administrador activo']);
        }
        return redirect ("/admin/usuarios/edit?id=$id")->with(['message'=> 'Usuario editado correctamente']);
    }

    public function delete(Request $request){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if(DB::table('usuarios')->where('id', $id)->exists()){
                if(!$this->isLastAdmin($id)){
                    if(!DB::table('noticias')->where('escritor', $id)->exists()){
                        $deleted = DB::table('usuarios')->where('id', $id)->delete();
                        return redirect ('/admin/usuarios')->with(['message'=> 'Usuario editado correctamente']);
                    }else{
                        return redirect ('/admin/usuarios')->withErrors(['error'=> 'No se puede eliminar al usuario ya que es autor de una noticia']);
                    }

                }else{
                    return redirect ('/admin/usuarios')->withErrors(['error'=> 'No se puede eliminar al útlimo administrador activo']);
                }

            }else{
                return redirect ('/admin/usuarios')->withErrors(['error'=> 'Error al eliminar al usuario']);
            }

        }else{
            return redirect ('/admin/usuarios')->withErrors(['error'=> 'Error al eliminar al usuario']);
        }
    }

}