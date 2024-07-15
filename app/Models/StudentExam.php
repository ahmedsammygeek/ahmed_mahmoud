<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentExam extends Model
{
    use HasFactory;


    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }


    public function markedBy()
    {
        return $this->belongsTo(User::class , 'marked_by' );
    }

    public function student()
    {
        return $this->belongsTo(Student::class , 'student_id' );
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class , 'exam_id' );
    }
}
