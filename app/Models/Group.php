<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }


    public function course()
    {
        return $this->belongsTo(Course::class , 'course_id');
    }


    // public function students()
    // {
    //     return $this->hasMany(CourseTeacherGroupStudent::class , 'course_teacher_group_id');
    // }


    public function times()
    {
        return $this->hasMany(GroupTime::class);
    }

}