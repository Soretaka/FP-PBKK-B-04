<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    protected $table = "Borrows";
    
    protected $fillable = [
        'isbn',
        'tanggal_peminjaman',
        'tanggal_kembali',
        'books_id'
    ];

    public function book() {
        return $this->belongsTo(Book::class);
    }
}
