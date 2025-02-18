<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Scopes\VideoScope;
class LessonVideo extends Model
{
    use HasFactory , HasTranslations ;
    public $translatable = ['title' , 'content' ];


    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new VideoScope);
    }


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
