<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAttribute extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden  = ['created_at','updated_at'];

    // Relations
    public function books()
    {
        return $this->belongsToMany(Book::class,'book_values')->withPivot('value');
    }
}
