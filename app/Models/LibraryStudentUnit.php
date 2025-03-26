<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryStudentUnit extends Model
{
    protected $fillable = ['student_id' , 'user_id' , 'unit_id' , 'is_allowed'  ,  'course_id'];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }


    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }


}
