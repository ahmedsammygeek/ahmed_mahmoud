<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Course extends Model
{
    use HasFactory , HasTranslations ;


    public $translatable = ['title' , 'content' ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class , 'teacher_id' );
    }


    public function grade()
    {
        return $this->belongsTo(Grade::class , 'grade_id');
    }

    public function units()
    {
        return $this->hasMany(Unit::class );
    }


    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class , Unit::class);
    }

    public function educationalSystems()
    {
        return $this->hasMany(CourseEducationalSystem::class);
    }
}
