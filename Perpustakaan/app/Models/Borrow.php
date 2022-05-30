<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    protected $table = "Borrows";
    protected $fillable = [
        'user_id',
        'book_id',
        'tanggal_peminjaman',
        'tanggal_kembali'
    ];
    public function book() {
        return $this->belongsTo(Book::class);
    }
    public function user() {
        return $this->belongsTo(user::class);
    }
}
