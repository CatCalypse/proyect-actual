<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait userTraits
{
    protected function isLastAdmin($id) {
        
        if(DB::table('usuarios')->where('id', $id)->exists()){
            $usuario = DB::table('usuarios')->where('id', $id)->first();

            if($usuario->rol == 1){
                if($usuario->activo == 1){
                    if(DB::table('usuarios')->where('activo', 1)->where('rol', 1)->count() > 1){
                        return false;
                    }else{
                        return true;    
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }
}