<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttributes extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden  = ['created_at','updated_at'];

    // Relations
    public function students()
    {
        return $this->belongsToMany(Student::class,'student_values')->withPivot('value');
    }
}
