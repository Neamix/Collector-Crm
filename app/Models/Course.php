<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name','subject','start_date','end_date','instractor_id'];

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
        return $this->belongsToMany(CourseAttribute::class,'course_values')->withPivot('value');
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
