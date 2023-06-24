<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name','grade','birthday'];

    /*** Load Students Attributes */
    public function loadAttributes()
    {
        return $this->attributesValues->mapWithKeys(function($attribute) {
            return [$attribute['attribute'] => $attribute['value']];
        })->all();
    }

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
    public function attributesValues()
    {
        return $this->morphMany(AttributeValue::class,'model');
    }
}
