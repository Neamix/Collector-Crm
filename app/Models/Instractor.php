<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instractor extends Model
{
    use HasFactory;

    protected $fillable = ['year_of_experience','name','birthday'];

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
        return $this->belongsToMany(InstractorAttributes::class,'instractor_values')->withPivot('value');
    }
}
