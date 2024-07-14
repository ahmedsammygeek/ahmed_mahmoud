<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Exam extends Model
{
    use HasFactory , HasTranslations ;
    public $translatable = ['title'  ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }


    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' );
    }


    public function course()
    {
        return $this->belongsTo(Course::class , 'course_id' );
    }


    public function questions()
    {
        return $this->hasMany(ExamQuestion::class , 'exam_id' );
    }
}
