<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

    function getRol(){
        $rol = Auth::user()->rol;
        return $rol;
    }

    function rolText(int $rol){
        $textRol = DB::table('roles')->where('id', $rol)->first();

        return $textRol->rol;
    }

    function getAllRoles(){
        $rol = DB::table('roles')->get();

        return $rol;
    }

    function getUserData(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $userData = DB::table('usuarios')->where('id', $id)->first();
            return $userData;
        }else{
            return null;
        }
    }

    function paginateUsuarios(){
        $users = DB::table('usuarios')->paginate(10);
        return view('paginado.usuarios', compact('users'));
    }

    function getCategorias(){
        $categorias = DB::table('categorias')->orderBy('id', 'asc')->get();

        return $categorias;
    }

    function getSlug($text){
        $text = Str::slug($text);

        return $text;
    }

    function paginateNoticias(){
        $news = DB::table('noticias')->paginate(10);
        return view('paginado.noticias', compact('news'));
    }

    function paginateBuscador(){

    }

    function getNewsData($id){
        $newsData = DB::table('noticias')->where('id', $id)->first();
        return $newsData;
    }

    

