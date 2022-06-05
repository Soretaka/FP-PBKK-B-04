<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // show profile
    public function detail($id) {
        $admin = User::find($id);
        
        return view('admin.profile', [
            "title" => "Profile",
            "admin" => $admin
        ]);
    }

    public function showEditForm($id) {
        $admin = User::where('id', $id)->first();

        return view('admin.edit', [
            "title" => "Profile Edit Form",
            "admin" => $admin
        ]);
    }

    public function update(Request $request, $id) {
        $admin = User::findOrFail($id);
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required | email',
            'TL' => 'required',
            'Alamat' => 'required',
            'JK' => 'required',
        ]);
        // dd($validateData);
        $admin->update($validateData);

        return redirect()->route('admin.profile', ['id' => auth()->user()->id])->with('status', 'Profile Anda berhasil diedit!');
    }
}
