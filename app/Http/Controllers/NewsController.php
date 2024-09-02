<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class NewsController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'titular' => 'required',
            'categoria' => 'required',
            'destacado' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'editorData' => 'required',
        ]);

        $json = json_decode($request->editorData);    

        foreach ($json as $json_data){
            if(is_array($json_data)){
                if(empty($json_data)){
                    return redirect ('/admin/redactar')->withErrors(['error'=> 'El contenido no puede estar vacio'], 'status')->withInput();
                }
            }
        }

        

        $titular = $request->input('titular');
        $categoria = DB::table('categorias')->where('id', $request->input('categoria'))->first();

        $basePath = resource_path() . '/noticias';
        $path = $basePath . '/' . Str::slug($categoria->categoria);

        if(Str::length($titular) > 150){
            return redirect('/admin/redactar');
        }
        
        $slug = Str::slug($titular);

        $count = 0;

        $slugBucle = $slug;
        do{
            $slugBucle = $slug . $count;
            $multimedia = $path . '/' . date('Y') . '/' . date('m') . '/' . $slugBucle;
            $count ++;
        }while((DB::table('noticias')->where('slug', $slugBucle)->exists()));

        if(Str::length($slugBucle) > 155){
            return redirect('/admin/redactar');
        }

        $imageName = $slugBucle . '.' . $request->destacado->extension();

        DB::table('noticias')->insert([
            'titular' => strip_tags($titular),
            'categoria' => $categoria->id,
            'destacado' => $imageName,
            'ano' => date('Y'),
            'mes' => date('m'),
            'escritor' => Auth::user()->id,
            'slug' => $slugBucle,
            'multimedia' => $multimedia,
            'activo' => 1,
        ]);

        if (! File::exists($path)) {
            File::makeDirectory($path);

            $path = $path . '/' . date('Y');

            if (! File::exists($path)) {
                File::makeDirectory($path);

                $path = $path . '/' . date('m');
                
                if (! File::exists($path)) {
                    File::makeDirectory($path);

                }
            }else{
                $path = $path . '/' . date('m');
                
                if (! File::exists($path)) {
                    File::makeDirectory($path);

                }
            }
        }else{
            $path = $path . '/' . date('Y');

            if (! File::exists($path)) {
                File::makeDirectory($path);

                $path = $path . '/' . date('m');
                
                if (! File::exists($path)) {
                    File::makeDirectory($path);

                }
            }else{
                $path = $path . '/' . date('m');
                
                if (! File::exists($path)) {
                    File::makeDirectory($path);

                }
            }
        }

        $path = $basePath . '/' . Str::slug($categoria->categoria) . '/' . date('Y') . '/' . date('m') . '/' . $slugBucle;
        if (! File::exists($path)) {
            File::makeDirectory($path);

            $disk = Storage::build([
                'driver' => 'local',
                'root' => $path,
            ]);
             
            $disk->put('noticia.json', $request->input('editorData'));

            $request->destacado->move(($path), $imageName);
        }else{
            return redirect('/admin/redactar');
        }

        return redirect('/admin/redactar');
    }


    public function editorContent(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            if(DB::table('noticias')->where('id', $id)->exists()){
                $noticia = DB::table('noticias')->where('id', $id)->first();
                $url = $noticia->multimedia;

                $editorData = file_get_contents($url ."/noticia.json");
            }else{
                return redirect('/admin/noticias');
            }
        }else{
            return redirect('/admin/noticias');
        }

        return view('admin.noticias.edit', ['editorData' => $editorData, 'idNoticia' => $id]);
    }

    public function edit(Request $request){
        
        if($request->has('destacado') && $request->has('destacado') != ""){
            $request->validate([
                'idNoticia' => 'required',
                'titular' => 'required',
                'categoria' => 'required',
                'destacado' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'editorData' => 'required',
            ]);
        }else{
            $request->validate([
                'idNoticia' => 'required',
                'titular' => 'required',
                'categoria' => 'required',
                'editorData' => 'required',
            ]);
        }
        
        $id = $request->input('idNoticia');


        $json = json_decode($request->editorData);    

        foreach ($json as $json_data){
            if(is_array($json_data)){
                if(empty($json_data)){
                    return redirect("/admin/noticias/editar?id=$id")->withErrors(['error'=> 'El contenido no puede estar vacio'], 'status')->withInput();
                }
            }
        }

        if(DB::table('noticias')->where('id', $id)->exists()){
            $noticia = DB::table('noticias')->where('id', $id)->first();

            $categoria = $request->input('categoria');
            $titular = $request->input('titular');
            $slug = $noticia->slug;


            if($categoria != $noticia->categoria || $titular != $noticia->titular){
                $basePath = resource_path() . '/noticias';
                $catBorrar = DB::table('categorias')->where('id', $noticia->categoria)->first();
                File::deleteDirectory($basePath . '/' . Str::slug($catBorrar->categoria) . '/' . $noticia->ano . '/' . $noticia->mes . '/' . $noticia->slug);


                if(DB::table('categorias')->where('id', $categoria)->exists()){
                    $textCategoria = DB::table('categorias')->where('id', $categoria)->first();
                }else{
                    return redirect('/admin/noticias');
                }

                if($categoria != $noticia->categoria){
                    $path = $basePath . '/' . Str::slug($textCategoria->categoria);

                    if (! File::exists($path)) {
                        File::makeDirectory($path);
            
                        $path = $path . '/' . $noticia->ano;
            
                        if (! File::exists($path)) {
                            File::makeDirectory($path);
            
                            $path = $path . '/' . $noticia->mes;
                            
                            if (! File::exists($path)) {
                                File::makeDirectory($path);
            
                            }
                        }
                    }else{
                        $path = $path . '/' . $noticia->ano;
                        
                        if (! File::exists($path)) {
                            File::makeDirectory($path);
            
                            $path = $path . '/' . $noticia->mes;
                            
                            if (! File::exists($path)) {
                                File::makeDirectory($path);
            
                            }
                        }
                    }
            
                }else{
                    $textCategoria = DB::table('categorias')->where('id', $categoria)->first();
                }

                if($titular != $noticia->titular){
                    if(Str::length($titular) > 150){
                        return redirect("/admin/noticias/editar?id=$id");
                    }
                    $slug = Str::slug($titular);

                    $count = 0;
            
                    $slugBucle = $slug;
                    do{
                        $slugBucle = $slug . $count;
                        $count ++;
                    }while((DB::table('noticias')->where('slug', $slugBucle)->exists()));
                    
                    if(Str::length($slugBucle) > 155){
                        return redirect("/admin/noticias/editar?id=$id");
                    }

                    $slug = $slugBucle;


                   
                }

                $multimedia = $basePath . '/' . Str::slug($textCategoria->categoria) . '/' . $noticia->ano . '/' . $noticia->mes . '/' . $slug;

                
                $affected = DB::table('noticias')
                ->where('id', $id)
                ->update(['titular' => $titular,
                'categoria' => $categoria,
                'slug' => $slug,
                'multimedia' => $multimedia]);

                if (! File::exists($multimedia)) {
                    File::makeDirectory($multimedia);
        
                    $disk = Storage::build([
                        'driver' => 'local',
                        'root' => $multimedia,
                    ]);
                     
                    $disk->put('noticia.json', $request->input('editorData'));
                }else{
                    $disk = Storage::build([
                        'driver' => 'local',
                        'root' => $multimedia,
                    ]);
                     
                    $disk->put('noticia.json', $request->input('editorData'));
                }

            }else{
                $path = $noticia->multimedia;

                $disk = Storage::build([
                    'driver' => 'local',
                    'root' => $path,
                ]);

                if($disk->has('/noticia.json')){
                    $disk->delete('/noticia.json');
                    $disk->put('noticia.json', $request->input('editorData'));
                }else{
                    return redirect('/admin/noticias');
                }

            }

            return redirect('/admin/noticias');

        }else{
            return redirect('/admin/noticias');
        }
    }
}
