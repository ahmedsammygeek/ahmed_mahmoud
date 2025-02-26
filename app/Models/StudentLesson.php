<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLesson extends Model
{
    use HasFactory;

    protected $fillable = ['lesson_id' , 'student_id' , 'user_id' , 'allowed' , 'total_views_till_now' , 'allowed_views' , 'remains_views' , 'video_id' ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class , 'lesson_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class , 'student_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}
