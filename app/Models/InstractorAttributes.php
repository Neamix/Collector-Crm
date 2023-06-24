<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstractorAttributes extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden  = ['created_at','updated_at'];

    // Relations
    public function instractors()
    {
        return $this->belongsToMany(Instractor::class,'instractor_values')->withPivot('value');
    }
}
