<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class BorrowController extends Controller
{
    public function index() {
        if(Auth::user()->isAdmin){
        $borrows = Borrow::all();
      //  dd($borrows);
        return view('borrow.index', [
            "title" => "borrow",
            "borrows" => $borrows
        ]);
        }else{
            $borrows = Borrow::where('user_id',Auth::user()->id)->get();
            // $borrows = DB::table('borrows')->where('user_id',Auth::user()->id)->get();
            // $borrows = Borrow::all();   
           // dd($borrows);     
            return view('user.history',[
                "title" => "borrow",
                "borrows" => $borrows
            ]);
        }
    }
    // show input form
    public function showInputForm() {
        $books = Book::all();
        $users = user::all();
        return view('borrow.create', [
            "title" => "Borrow Input Form",
            "books" => $books,
            "users" => $users
        ]);
    }

    // store data
    public function store(Request $request) {
        // $user_id = Auth::user()->id;
        // $books = Book::all();
        // // return $user_id;
        // // return $request->post();
        // $borrow= ([
        //     "user_id" => $user_id,
        //     "book_id" => $books->id,
        //     "tanggal_peminjaman" => $request->tanggal_peminjaman,
        //     "tanggal_kembali" => $request->tanggal_kembali
        // ]);
        // return $borrow;
        // $book = DB::table('books')->where('judul',$request->judul_buku)->first();
        // dd($book);
        // $validateData = $request->validate([
        //     "tanggal_peminjaman" => 'required',
        //     "tanggal_kembali" => 'required'
        // ]);
        //  dd($borrow);
        //  Borrow::create($borrow);
        
        // return redirect()->route('borrow.index')->with('status', 'Formulir buku berhasil dikirim!');
        $validateData = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required',
        ]);
        Borrow::create($validateData);

        return redirect()->route('borrow.index')->with('status', 'Peminjaman buku berhasil ditambah!');
    }
    public function detail($id) {
        $borrows = Borrow::where('id', $id)->first();
    
        return view('borrow.detail', [
            "title" => "Borrow Detail",
            "borrows" => $borrows
        ]);
    }

    // show edit form 
    public function showEditForm($id) {
        $borrows = Borrow::where('id', $id)->first();
        $books = Book::all();
        $users = user::all();

        return view('borrow.edit', [
            "title" => "borrow Edit Form",
            "borrows" => $borrows,
            "books" => $books,
            "users" => $users
        ]);
    }

    // store edit data
    public function update(Request $request, $id) {
        // $user_id = Auth::user()->id;
        // $books = Book::all();
        // // return $user_id;
        // // return $request->post();
        // $borrows = Borrow::findOrFail($id);
        // $borrow= ([
        //     "user_id" => $user_id,
        //     "book_id" => $books->id,
        //     "tanggal_peminjaman" => $request->tanggal_peminjaman,
        //     "tanggal_kembali" => $request->tanggal_kembali
        // ]);
        // return $borrow;
        // $book = DB::table('books')->where('judul',$request->judul_buku)->first();
        // dd($book);
        // $validateData = $request->validate([
        //     "tanggal_peminjaman" => 'required',
        //     "tanggal_kembali" => 'required'
        // ]);
        //  dd($borrow);
        // $borrows->update($borrow);
        
        // return redirect()->route('borrow.index')->with('status', 'Formulir buku berhasil dikirim!');
        $borrow = Borrow::findOrFail($id);
        $validateData = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required'
        ]);
        
        $borrow->update($validateData);
        
        return redirect()->route('borrow.index')->with('status', 'Data peminjaman buku berhasil diedit!');
    
    }

    // delete
    public function destroy($id) {
        $borrow = Borrow::findOrFail($id);
        
        $borrow->delete();

        return redirect()->route('borrow.index')->with('status', 'Data peminjaman buku berhasil dihapus!');
    }

}

