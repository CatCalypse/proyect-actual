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

class NewsController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'categoria' => 'required',
            'text-editor' => 'required',
        ]);

        $categoria = DB::table('categorias')->where('id', $request->input('categoria'))->first();

        $content =preg_replace("~<!--(.*?)-->~s", "", $request->input('text-editor'));

        $dom = new \DOMDocument();
        @$dom->loadHTML($content);
    
        $headers = [];
        for ($i = 1; $i <= 6; $i++) {
            foreach ($dom->getElementsByTagName("h$i") as $header) {
                $headers[] = [
                    'level' => $i,
                    'text' => $header->textContent,
                ];
            }
        }

        $basePath = public_path().'/noticias/';
        $path = $basePath . $categoria->categoria;

        $slug = Str::slug($headers[0]['text'], '-');

        if(Str::length($headers[0]['text']) > 150){
            return redirect('/admin/redactar');
        }

        $count = 0;

        $slugBucle = $slug;
        do{
            $slugBucle = $slug . $count;
            $multimedia = $path . '/' . date('Y') . '/' . date('m') . '/' . $slugBucle;
            $count ++;
        }while((DB::table('noticias')->where('slug', $slugBucle)->exists()));

        if(Str::length($slugBucle) > 175){
            return redirect('/admin/redactar');
        }

        $imagenes = [];

        DB::table('noticias')->insert([
            'titular' => strip_tags($headers[0]['text']),
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

        $path = $basePath . $categoria->categoria . '/' . date('Y') . '/' . date('m') . '/' . $slugBucle;
        if (! File::exists($path)) {
            File::makeDirectory($path);
        }
    }
}
