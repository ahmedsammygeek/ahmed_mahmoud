<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Announcement extends Model
{
    use HasFactory , HasTranslations ;
    public $translatable = ['title' , 'content'];



    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' );
    }


    public function views()
    {
        return $this->hasMany(StudentAnnouncementView::class , 'announcement_id' );
    }


    public function publishedForStudents()
    {
        return $this->hasMany(AnnouncementStudent::class , 'announcement_id');
    }
}
