<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // index
    public function index() {
        $books = Book::all();

        return view('book.index', [
            "title" => "Book",
            "books" => $books
        ]);
    }

    // show input form 
    public function showInputForm() {
        $categories = Category::all();

        return view('book.create', [
            "title" => "Book Input Form",
            "categories" => $categories
        ]);
    }

    // store data
    public function store(Request $request) {
        $validateData = $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'isbn' => 'required',
            'jumlah' => 'required',
            'kategori_id' => 'required'
        ]);

        Book::create($validateData);

        return redirect()->route('book.index')->with('status', 'Data buku berhasil ditambah!');
    }

    // show detail 
    public function detail($id) {
        $book = Book::where('id', $id)->first();

        return view('book.detail', [
            "title" => "Book Detail",
            "book" => $book
        ]);
    }

    // show edit form 
    public function showEditForm($id) {
        $book = Book::where('id', $id)->first();
        $categories = Category::all();
        return view('book.edit', [
            "title" => "Book Edit Form",
            "book" => $book,
            "categories" => $categories
        ]);
    }

    // store edit data
    public function update(Request $request, $id) {
        $book = Book::findOrFail($id);
        $validateData = $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'isbn' => 'required',
            'jumlah' => 'required',
            'kategori_id' => 'required'
        ]);
        $book->update($validateData);
        
        return redirect()->route('book.index')->with('status', 'Data buku berhasil diedit!');
    }

    // delete
    public function destroy($id) {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('book.index')->with('status', 'Data buku berhasil dihapus!');
    }
}
