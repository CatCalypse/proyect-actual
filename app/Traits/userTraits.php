<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait userTraits
{
    protected function isLastAdmin($id) {
        if(DB::table('usuarios')->where('activo', 1)->where('rol', 1)->count() > 1){
            return false;
        }else{
            return true;
        }
    }
}