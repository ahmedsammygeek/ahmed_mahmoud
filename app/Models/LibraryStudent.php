<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryStudent extends Model
{
    

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }


    public function course()
    {
        return $this->belongsTo(Course::class , 'course_id');
    }


    public function student()
    {
        return $this->belongsTo(Student::class , 'student_id');
    }
}
