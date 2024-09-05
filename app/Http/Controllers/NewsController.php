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
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'editorData' => 'required',
        ]);

        $json = json_decode($request->editorData);    

        foreach ($json as $json_data){
            if(is_array($json_data)){
                if(empty($json_data)){
                    return redirect('/admin/redactar')->withErrors(['editorData' => 'El contenido no puede estar vacio'])->withInput();
                }
            }
        }

        

        $titular = $request->input('titular');
        $categoria = DB::table('categorias')->where('id', $request->input('categoria'))->first();

        $basePath = resource_path() . '/noticias';
        $path = $basePath . '/' . Str::slug($categoria->categoria);

        if(Str::length($titular) > 150){
            return redirect('/admin/redactar')->withErrors(['titular' => 'El titular es demasiado largo'])->withInput();
        }
        
        $slug = Str::slug($titular);

        $count = 0;

        $slugBucle = $slug;
        do{
            $slugBucle = $slug . $count;
            $multimedia = '/noticias/' . date('Y') . '/' . date('m') . '/' . $slugBucle;
            $count ++;
        }while((DB::table('noticias')->where('slug', $slugBucle)->exists()));

        if(Str::length($slugBucle) > 155){
            return redirect('/admin/redactar')->withErrors(['editorData' => 'El titular es demasiado largo'])->withInput();
        }

        $imageName = $slugBucle . '.' . $request->upload->extension();

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


            $pathDestacado = $request->file('upload')->storeAs(
                'public/images/destacado', $imageName
            );
        }else{
            return redirect('/admin/redactar')->withErrors(['newsError' => 'Error al publicar la noticia'])->withInput();;
        }

        return redirect('/admin/redactar')->with('message', 'Se ha publicado la noticia correctamente');;
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
        
        if($request->has('upload') && $request->has('upload') != ""){
            $request->validate([
                'idNoticia' => 'required',
                'titular' => 'required',
                'categoria' => 'required',
                'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'editorData' => 'required',
            ]);

            $destacado = $request->upload;
        }else{
            $request->validate([
                'idNoticia' => 'required',
                'titular' => 'required',
                'categoria' => 'required',
                'editorData' => 'required',
            ]);
        }


        if($request ->has('activo')){
            $activo = 1;
        }else{
            $activo = 0;
        }
        
        $id = $request->input('idNoticia');

        $json = json_decode($request->editorData);    

        foreach ($json as $json_data){
            if(is_array($json_data)){
                if(empty($json_data)){
                    return redirect("/admin/noticias/editar?id=$id")->withErrors(['error'=> 'El contenido no puede estar vacio'])->withInput();
                }
            }
        }

        if(DB::table('noticias')->where('id', $id)->exists()){

            $affected = DB::table('noticias')
            ->where('id', $id)
            ->update(['activo' => $activo]);


            $noticia = DB::table('noticias')->where('id', $id)->first();

            $categoria = $request->input('categoria');
            $titular = $request->input('titular');
            $slug = $noticia->slug;


            if(isset($destacado)){
                $imageName = $slug . '.' . $request->upload->extension();

                $pathDestacado = $request->file('upload')->storeAs(
                    'public/images/destacado', $imageName
                );

                $affected = DB::table('noticias')
                ->where('id', $id)
                ->update(['destacado' => $imageName]);
            }

            if($categoria != $noticia->categoria || $titular != $noticia->titular){
                $basePath = resource_path() . '/noticias';
                $catBorrar = DB::table('categorias')->where('id', $noticia->categoria)->first();
                File::deleteDirectory($basePath . '/' . Str::slug($catBorrar->categoria) . '/' . $noticia->ano . '/' . $noticia->mes . '/' . $noticia->slug);


                if(DB::table('categorias')->where('id', $categoria)->exists()){
                    $textCategoria = DB::table('categorias')->where('id', $categoria)->first();
                }else{
                    return redirect("/admin/noticias/editar?id=$id")->withErrors(['error'=> 'Error al actualizar los datos'])->withInput();
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
                        return redirect("/admin/noticias/editar?id=$id")->withErrors(['error'=> 'El titular es demasiado largo'])->withInput();
                    }
                    $slug = Str::slug($titular);

                    $count = 0;
            
                    $slugBucle = $slug;
                    do{
                        $slugBucle = $slug . $count;
                        $count ++;
                    }while((DB::table('noticias')->where('slug', $slugBucle)->exists()));
                    
                    if(Str::length($slugBucle) > 155){
                        return redirect("/admin/noticias/editar?id=$id")->withErrors(['error'=> 'El titular es demasiado largo'])->withInput();
                    }

                    $slug = $slugBucle;


                   
                }

                $multimedia = '/noticias/' . Str::slug($textCategoria->categoria) . '/' . $noticia->ano . '/' . $noticia->mes . '/' . $slug;

                
                $affected = DB::table('noticias')
                ->where('id', $id)
                ->update(['titular' => $titular,
                'categoria' => $categoria,
                'slug' => $slug,
                'multimedia' => $multimedia]);

                $filePath = $basePath . $multimedia;

                if (! File::exists($filePath)) {
                    File::makeDirectory($filePath);
        
                    $disk = Storage::build([
                        'driver' => 'local',
                        'root' => $filePath,
                    ]);
                     
                    $disk->put('noticia.json', $request->input('editorData'));
                }else{
                    $disk = Storage::build([
                        'driver' => 'local',
                        'root' => $filePath,
                    ]);
                     
                    $disk->put('noticia.json', $request->input('editorData'));
                }
                
                return redirect("/admin/noticias/editar?id=$id")->with(['message'=> 'La noticia ha sido editada correctamente'])->withInput();
            }else{
                $path = $noticia->multimedia;

                $filePath = resource_path() . $multimedia;

                $disk = Storage::build([
                    'driver' => 'local',
                    'root' => $filePath,
                ]);

                if($disk->has('/noticia.json')){
                    $disk->delete('/noticia.json');
                    $disk->put('noticia.json', $request->input('editorData'));
                }else{
                    $disk->put('noticia.json', $request->input('editorData'));
                }

                return redirect("/admin/noticias/editar?id=$id")->with(['message'=> 'La noticia ha sido editada correctamente'])->withInput();
            }

            return redirect("/admin/noticias/editar?id=$id")->with(['message'=> 'La noticia ha sido editada correctamente'])->withInput();

        }else{
            return redirect("/admin/noticias")->withErrors(['error'=> 'Se ha producido un error al editar la noticia'])->withInput();
        }
    }

    public function delete(){
        if(isset($_GET['id']) && $_GET['id'] != ""){
            $id = $_GET['id'];
            if(DB::table('noticias')->where('id', $id)->exists()){
                $noticia = DB::table('noticias')->where('id', $id)->first();
                $catBorrar = DB::table('categorias')->where('id', $noticia->categoria)->first();


                $basePath = resource_path() . '/noticias';

                $path = $noticia->multimedia;

                $filePath = $basePath . $path;

                $disk = Storage::build([
                    'driver' => 'local',
                    'root' => $path,
                ]);

                if($disk->has('/noticia.json')){
                    $disk->delete('/noticia.json');
                }


                File::deleteDirectory($basePath . '/' . Str::slug($catBorrar->categoria) . '/' . $noticia->ano . '/' . $noticia->mes . '/' . $noticia->slug);

                $deleted = DB::table('noticias')->where('id', $noticia->id)->delete();

                return redirect("/admin/noticias");
            }
        }
    }
}
