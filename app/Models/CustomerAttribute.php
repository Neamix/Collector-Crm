<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAttribute extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden  = ['created_at','updated_at'];

    // Relations
    public function customers()
    {
        return $this->belongsToMany(Book::class,'customer_values')->withPivot('value');
    }
}
