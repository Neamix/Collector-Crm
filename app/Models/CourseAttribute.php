<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseAttribute extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden  = ['created_at','updated_at'];

    // Relations
    public function courses()
    {
        return $this->belongsToMany(Course::class,'course_values')->withPivot('value');
    }
}
