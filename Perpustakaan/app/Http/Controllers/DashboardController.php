<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // index
    public function indexAdm() {
        return view('admin.dashboard', [
            "title" => "Dashboard"
        ]);
    }
    public function indexUser() {
        return view('user.dashboard', [
            "title" => "Dashboard"
        ]);
    }
}
