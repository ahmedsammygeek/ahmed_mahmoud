<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExamAnswer extends Model
{
    use HasFactory;


    public function student()
    {
        return $this->belongsTo(Student::class , 'student_id');
    }


    public function question()
    {
        return $this->belongsTo(Question::class , 'question_id');
    }


    public function exam()
    {
        return $this->belongsTo(Exam::class , 'exam_id');
    }

    public function ansswer()
    {
        return $this->belongsTo(QuestionAnswer::class , 'answer_id');
    }
}
