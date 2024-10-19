<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonFileView extends Model
{
    use HasFactory;


    public function student()
    {
        return $this->belongsTo(Student::class , 'student_id');
    }


    public function lessonFile()
    {
        return $this->belongsTo(LessonFile::class , 'lesson_file_id');
    }
}
