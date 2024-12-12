<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
class Lesson extends Model
{
    use HasFactory , HasTranslations , SoftDeletes ;

    public $translatable = ['title' , 'content' ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }


    public function files() {

        return $this->hasMany(LessonFile::class , 'lesson_id');
    }

    public function  unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class , 'lesson_id');
    }


    public function videos()
    {
        return $this->hasMany(LessonVideo::class , 'lesson_id');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class , 'deleted_by');
    }


}
