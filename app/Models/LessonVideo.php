<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class LessonVideo extends Model
{
    use HasFactory , HasTranslations ;
    public $translatable = ['title' , 'content' ];



    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function files()
    {
        return $this->hasMany(LessonFile::class , 'video_id');
    }


    public function lesson()
    {
        return $this->belongsTo(Lesson::class , 'lesson_id');
    }

}
