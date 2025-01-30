<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonFile extends Model
{
    use HasFactory;


    protected $fillable = ['lesson_id' , 'video_id' , 'user_id' , 'file' , 'download_allowed_number' , 'name' ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function video()
    {
        return $this->belongsTo(LessonVideo::class  , 'video_id');
    }

    public function views()
    {
        return $this->hasMany(LessonFileView::class);
    }
}
