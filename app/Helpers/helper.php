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

    function getCategoriaText($cat){
        $textCategoria = DB::table('categorias')->where('id', $cat)->first();

        return $textCategoria->categoria;
    }

    function getWriter($id){
        $writer = DB::table('usuarios')->where('id', $id)->first();

        return $writer->nombre;
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

    function paginateNoticiasAdmin(){
        $news = DB::table('noticias')->orderBy('id', 'desc')->paginate(10);
        return view('paginado.noticiasAdmin', compact('news'));
    }

    function paginateNoticiasCategoria($categoria){
        $news = DB::table('noticias')->where('categoria', $categoria)->where('activo', 1)->orderBy('id', 'desc')->paginate(12);
        return view('paginado.noticiasCategoria', compact('news'));
    }

    function getNewsData($id){
        $newsData = DB::table('noticias')->where('id', $id)->first();
        return $newsData;
    }

    function getImageFromStorage($destacado){
        $path = "/storage/images/destacado/" . $destacado;

        return $path;
    }

    function checkActive(){
        $id = Auth::user()->id;

        if(DB::table('usuarios')->where('id', $id)->exists()){
            $usuario = DB::table('usuarios')->where('id', $id)->first();
            if($usuario->activo == 1){
                return true;
            }else{
                return false;
            }
        }
    }


    function getNoticiaWithSlug($slug){
        if(DB::table('noticias')->where('slug', $slug)->exists()){
            $noticia = DB::table('noticias')->where('slug', $slug)->first();

            return($noticia);
        }else{
            return redirect('/');
        }
    }


    function getNoticiasActualidad(){
        $noticias = DB::table('noticias')->where('activo', 1)->orderBy('id', 'desc')->limit(6)->get();

        return $noticias;
    }

    
    function getNoticiasCategoriaPortada($noticiasUsadas, $idCategoria){
        $noticiasUsadasArray = [];

        foreach($noticiasUsadas as $new){
            $noticiasUsadasArray[] = $new->id;
        }

        $noticias = DB::table('noticias')->where('activo', 1)->where('categoria', $idCategoria)->whereNotIn('id', $noticiasUsadasArray)->orderBy('id', 'desc')->limit(6)->get();

        return $noticias;
    }

