<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Question extends Model
{
     use HasFactory , HasTranslations ;
     public $translatable = ['content' ];


     public function user()
     {
          return $this->belongsTo(User::class , 'user_id' );
     }


     public function course()
     {
          return $this->belongsTo(Course::class , 'course_id' );
     }


     public function answers()
     {
          return $this->hasMany(QuestionAnswer::class , 'question_id' );
     }


}
