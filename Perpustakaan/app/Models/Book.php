<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = "Books";
    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class, 'kategori_id');
    }
    public function borrow() {
        return $this->hasMany(Borrow::class);
    }
}
