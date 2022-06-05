<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // index
    public function indexAdm() {
        $categories_count = DB::table('categories')
                                ->select(DB::raw("COUNT(categories.id) as count"))
                                ->get();
        
        $books_count = DB::table('books')
                            ->select(DB::raw("COUNT(books.id) as count"))
                            ->where('status', 'Tersedia')
                            ->get();
        
        $members_count = DB::table('users')
                            ->select(DB::raw("COUNT(users.id) as count"))
                            ->where('isAdmin', 0)
                            ->get();
        
        $borrows_count = DB::table('borrows')
                            ->select(DB::raw("COUNT(borrows.id) as count"))
                            ->join('borrow_details', 'borrows.id', '=', 'borrow_details.borrow_id')
                            ->whereNull('borrow_details.return_date')
                            ->get();
                                
        return view('admin.dashboard', [
            "title" => "Dashboard",
            "categories_count" => $categories_count[0]->count,
            "books_count" => $books_count[0]->count,
            "members_count" => $members_count[0]->count,
            "borrows_count" => $borrows_count[0]->count,
        ]);
    }

    public function indexUser() {
        return view('user.dashboard', [
            "title" => "Dashboard"
        ]);
    }

}