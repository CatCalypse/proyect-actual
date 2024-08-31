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
            'editorData' => 'required',
        ]);

        $titular = $request->input('titular');
        $categoria = DB::table('categorias')->where('id', $request->input('categoria'))->first();


        $basePath = resource_path() . '/noticias';
        $path = $basePath . '/' . Str::slug($categoria->categoria);

        $slug = Str::slug($titular);

        if(Str::length($titular) > 150){
            return redirect('/admin/redactar');
        }

        $count = 0;

        $slugBucle = $slug;
        do{
            $slugBucle = $slug . $count;
            $multimedia = $path . '/' . date('Y') . '/' . date('m') . '/' . $slugBucle;
            $count ++;
        }while((DB::table('noticias')->where('slug', $slugBucle)->exists()));

        if(Str::length($slugBucle) > 150){
            return redirect('/admin/redactar');
        }

        DB::table('noticias')->insert([
            'titular' => strip_tags($titular),
            'categoria' => $categoria->id,
            'ano' => date('Y'),
            'mes' => date('m'),
            'escritor' => Auth::user()->id,
            'slug' => $slugBucle,
            'multimedia' => $multimedia
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
            }
        }else{
            $path = $path . '/' . date('Y');
            
            if (! File::exists($path)) {
                File::makeDirectory($path);

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
        }
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
        $request->validate([
            'idNoticia' => 'required',
            'titular' => 'required',
            'categoria' => 'required',
            'editorData' => 'required',
        ]);

        $id = $request->input('idNoticia');

        if(DB::table('noticias')->where('id', $id)->exists()){
            $noticia = DB::table('noticias')->where('id', $id)->first();

            $path = $noticia->multimedia;

            $disk = Storage::build([
                'driver' => 'local',
                'root' => $path,
            ]);

            $disk->delete('/noticia.json');
            $disk->put('noticia.json', $request->input('editorData'));
        }else{
            return redirect('/admin/noticias');
        }

        
    }
}
