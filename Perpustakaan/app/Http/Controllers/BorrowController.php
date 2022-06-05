<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BorrowDetails;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller {
    // index
    public function index() {
        if(Auth::user()->isAdmin) {
            $borrows = Borrow::all();
            return view('borrow.index', [
                "title" => "borrow",
                "borrows" => $borrows
            ]);
        }
        else {
            $borrows = Borrow::where('user_id',Auth::user()->id)->get();     
            return view('user.history',[
                "title" => "borrow",
                "borrows" => $borrows
            ]);
        }
    }

    // show input form
    public function showInputForm() {
        $books = Book::where('status', 'Tersedia')->get();
        $users = User::where('isAdmin', 0)->get();
        return view('borrow.create', [
            "title" => "Borrow Input Form",
            "books" => $books,
            "users" => $users,
        ]);
    }

    // store data
    public function store(Request $request) {
        $borrow = Borrow::create([
            'user_id' => $request->user_id,
            'admin_id' => auth()->user()->id,
            'must_return_date' => Carbon::now()->addDays(7),
        ]);

        foreach($request->book_id as $id) {
            if($id){
                BorrowDetails::create([
                    'borrow_id' => $borrow->id,
                    'book_id' => $id,
                ]);

                $book = Book::findOrFail($id);
                $book->status = 'Tidak tersedia';
                $book->save();
            }
        }
        
        return redirect()->route('borrow.index')->with('status', 'Peminjaman buku berhasil ditambah!');
    }

    // show each borrow detail
    public function detail($id) {
        $borrows = BorrowDetails::where('borrow_id', $id)->get();
    
        return view('borrow.detail', [
            "title" => "Borrow Detail",
            "borrows" => $borrows
        ]);
    }

    // return book
    public function returnBook($id) {
        $borrow_details = BorrowDetails::findOrFail($id);
        $book = $borrow_details->book;
        $book->status = 'Tersedia';
        $book->save();

        $date = Carbon::parse($borrow_details->borrow->must_return_date);
        $now = Carbon::now();

        $diff = $now->diffInDays($date);
        $borrow_details->return_date = $now;
        if($date < $now){
            $denda = $diff * 1000;
            $borrow_details->denda = $denda;
        }    
        $borrow_details->save();

        return redirect()->route('borrow.detail-data', ['id' => $borrow_details->borrow->id])->with('status', 'Pengembalian buku berhasil!');
    }
}