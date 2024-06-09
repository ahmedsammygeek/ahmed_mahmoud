<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseTeacherGroupStudent extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }


    public function CourseTeacherGroup()
    {
        return $this->belongsTo(CourseTeacherGroup::class , 'course_teacher_group_id');
    }


    public function student()
    {
        return $this->belongsTo(Student::class , 'student_id');
    }



}
