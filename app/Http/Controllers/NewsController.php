<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class NewsController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'categoria' => 'required',
            'text-editor' => 'required',
        ]);


        $basePath = public_path().'/noticias/' . date('Y') . '/' . date('m');

        if (! File::exists($basePath)) {
            File::makeDirectory($basePath);
        }else{

        }
        echo $basePath;
        echo $request->input('text-editor');
    }
}
