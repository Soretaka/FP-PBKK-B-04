<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectAuthenticatedUsersController extends Controller
{
    public function home()
    {
        if (auth()->user()->role == 1) {
            return redirect('/dashboard');
        }
        elseif(auth()->user()->role == 0){
            return redirect('/');
        }elseif(auth()->user()->role == 2){
            return redirect('/');
        }
        else{
            return auth()->logout();
        }
    }
}
