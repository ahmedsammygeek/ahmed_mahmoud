<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTeacher extends Model
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

    public function teacher()
    {
        return $this->belongsTo(Teacher::class , 'teacher_id');
    }


    public function groups()
    {
        return $this->hasMany(CourseTeacherGroup::class , 'course_teacher_id' );
    }
}
