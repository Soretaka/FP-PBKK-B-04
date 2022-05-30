<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BorrowController extends Controller
{
    // show input form
    public function showInputForm() {
        return view('borrow.create', [
            "title" => "Borrow Input Form"
        ]);
    }

    // store data
    public function store(Request $request) {
        $validateData = $request->validate([
            "isbn" => 'required',
            "tanggal_peminjaman" => 'required',
            "tanggal_kembali" => 'required'
        ]);
        
        Borrow::create($validateData);
        
        return redirect()->route('book.index')->with('status', 'Kategori buku berhasil ditambah!');
    }
}
