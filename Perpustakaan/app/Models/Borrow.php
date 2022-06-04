<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    protected $table = "Borrows";
    protected $fillable = [
        'admin_id',
        'user_id',
        'must_return_date'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function borrowdetails(){
        return $this->hasMany(BorrowDetails::class);
    }
}
