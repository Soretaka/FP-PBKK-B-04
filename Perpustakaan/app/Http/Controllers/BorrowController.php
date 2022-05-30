<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class BorrowController extends Controller
{
    // show input form
    public function showInputForm() {
        $books = Book::all();

        return view('borrow.create', [
            "title" => "Borrow Input Form",
            "books" => $books
        ]);
    }

    // store data
    public function store(Request $request) {
        $user_id = Auth::user()->id;
        // return $user_id;
        // return $request->post();
        $borrow= ([
            "user_id" => $user_id,
            "book_id" => $request->id,
            "tanggal_peminjaman" => $request->tanggal_peminjaman,
            "tanggal_kembali" => $request->tanggal_kembali
        ]);
        // return $borrow;
        // $book = DB::table('books')->where('judul',$request->judul_buku)->first();
        // dd($book);
        // $validateData = $request->validate([
        //     "tanggal_peminjaman" => 'required',
        //     "tanggal_kembali" => 'required'
        // ]);
        //  dd($borrow);
         Borrow::create($borrow);
        
        return redirect()->route('book.index')->with('status', 'Formulir buku berhasil dikirim!');
    }
}
