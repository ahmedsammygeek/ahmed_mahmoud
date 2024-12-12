<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
class Course extends Model
{
    use HasFactory , HasTranslations , SoftDeletes  ;


    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
        ];
    }



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

    public function groups()
    {
        return $this->hasMany(Group::class , 'course_id');
    }

    public function students()
    {
        return $this->hasMany(CourseStudent::class , 'course_id' );
    }

    public function sessions()
    {
        return $this->hasManyThrough(GroupTime::class , Group::class);
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class , 'deleted_by');
    }
}
