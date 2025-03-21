<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CourseStudent extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }


    public function student()
    {
        return $this->belongsTo(Student::class , 'student_id');
    }


    public function course()
    {
        return $this->belongsTo(Course::class , 'course_id');
    }


    public function group()
    {
        return $this->belongsTo(Group::class , 'group_id');
    }

}
