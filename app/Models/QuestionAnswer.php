<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class QuestionAnswer extends Model
{
    use HasFactory , HasTranslations ;
    public $translatable = ['content' ];

    protected $fillable = ['question_id' , 'content' , 'user_id' , 'is_correct_answer' ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' );
    }


    public function question()
    {
        return $this->belongsTo(Course::class , 'question_id' );
    }




}
