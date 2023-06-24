<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title','auther'];

    /*** Filter Student Data */
    public function scopeFilter($query,$request)
    {
        if ( isset($request['id']) ) {
            $query->where('id',$request['id']);
        }

        if ( isset($request['name']) ) {
            $query->where('name','like','%'.$request['name'].'%');
        }

        return $query;
    }

    // Relations 
    public function attributes()
    {
        return $this->belongsToMany(BookAttribute::class,'book_values')->withPivot('value');
    }

    public function instractor()
    {
        return $this->belongsTo(Instractor::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
