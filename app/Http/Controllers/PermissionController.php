<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminControlller extends Controller{
    public function getRole() {
        $id = Auth::id();

        return redirect('/');
    }
}