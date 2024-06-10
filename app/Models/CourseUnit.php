<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class CourseUnit extends Model
{
    use HasFactory , HasTranslations ;


    public $translatable = ['title' ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }


    public function course()
    {
        return $this->belongsTo(User::class);
    }

    public  function lessons()
    {
        return $this->hasMany(CourseUnitLesson::class);
    }
}
