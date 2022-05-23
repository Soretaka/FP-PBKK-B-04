<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // index
    public function index() {
        $categories = Category::all();

        return view('category.index', [
            "title" => "Category",
            "categories" => $categories
        ]);
    }

    // show input form
    public function showInputForm() {
        return view('category.create', [
            "title" => "Input Form"
        ]);
    }

    // store data
    public function store(Request $request) {
        $validateData = $request->validate([
            "kategori_buku" => 'required'
        ]);
        
        Category::create($validateData);
        
        return redirect()->route('category.index')->with('status', 'Kategori buku berhasil ditambah!');
    }

    // show edit form
    public function showEditForm($id) {
        $category = Category::where('id', $id)->first();
        return view('category.edit', [
            "title" => "Edit Form",
            "category" => $category
        ]);
    }

    // store update data
    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);
        $validateData = $request->validate([
            "kategori_buku" => "required"
        ]);
        $category->update($validateData);

        return redirect()->route('category.index')->with('status', 'Kategori buku berhasil diedit!');
    }

    // delete data
    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('status', 'Kategori buku berhasil dihapus!');
    }
}
