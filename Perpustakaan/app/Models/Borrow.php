<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    protected $table = "Books";
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Book::class, 'isbn');
    }
}
