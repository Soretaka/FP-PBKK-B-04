<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class BookController extends Controller
{
    // index
    public function index() {
        $books = Book::all();
        if(Auth::user()->isAdmin){
        return view('book.index', [
            "title" => "Book",
            "books" => $books
        ]);
        }else{
            return view('user.buku',[
                "title" => "Book",
                "books" => $books
            ]);
        }
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
            'image' => 'required | image | mimes:jpeg,png,jpg | max:2048',
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'isbn' => 'required',
            'status' => 'required',
            'kategori_id' => 'required'
        ]);
        if($request->file('image')) {
            $validateData['image'] = $request->file('image')->store('book-image');
        }
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
            'image' => 'required | image | mimes:jpeg,png,jpg | max:2048',
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'isbn' => 'required',
            'status' => 'required',
            'kategori_id' => 'required'
        ]);
        if($request->file('image')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('book-image');
        }
        $book->update($validateData);
        
        return redirect()->route('book.index')->with('status', 'Data buku berhasil diedit!');
    }

    // delete
    public function destroy($id) {
        $book = Book::findOrFail($id);
        if($book->image) {
            Storage::delete($book->image);
        }
        $book->delete();

        return redirect()->route('book.index')->with('status', 'Data buku berhasil dihapus!');
    }
}