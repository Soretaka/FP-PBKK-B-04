<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowDetails extends Model
{
    use HasFactory;
    protected $table = "borrow_details";
    protected $fillable = [
        'borrow_id',
        'book_id',
        'return_date',
        'denda',
    ];

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function borrow() {
        return $this->belongsTo(Borrow::class);
    }
}
