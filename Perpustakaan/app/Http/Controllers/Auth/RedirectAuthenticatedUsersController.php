<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectAuthenticatedUsersController extends Controller
{
    public function home()
    {
        if (auth()->user()->isAdmin == 1) {
            return redirect('/adminDashboard');
        }
        elseif(auth()->user()->isAdmin == 0){
            return redirect('/userDashboard');
        }
        elseif(auth()->user()->isAdmin == 'guest'){
            return redirect('/guestDashboard');
        }
        else{
            return auth()->logout();
        }
    }
}
